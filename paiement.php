<?php
include 'session.php';
include 'database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php?redirect=paiement.php");
    exit;
}

// Récupérer l'ID de réservation
$booking_id = $_POST['booking_id'] ?? null;
if (!$booking_id) {
    echo "<div class='error'>Identifiant de réservation manquant.</div>";
    exit;
}

// Vérifier que la réservation existe et appartient à l'utilisateur
$stmt = $database->prepare("
    SELECT b.id, b.nbrperson, t.title, t.price, t.image, b.departuredate
    FROM booking b
    JOIN travel t ON b.travel = t.id
    WHERE b.id = ? AND b.user = ?
");
$stmt->bind_param("ii", $booking_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='error'>Réservation non trouvée ou non autorisée.</div>";
    exit;
}

$booking = $result->fetch_assoc();
$stmt->close();

// Calculer le montant total
$base_price = $booking['price'] * $booking['nbrperson'];
$options_total = 0;

// Récupérer les options de la réservation
$stmt = $database->prepare("
    SELECT e.extra, e.nbrperson, ex.price, ex.title 
    FROM engagement e
    JOIN extra ex ON e.extra = ex.id
    WHERE e.booking = ?
");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

$options = [];
while ($option = $result->fetch_assoc()) {
    $options[] = $option;
    $options_total += $option['price'] * $option['nbrperson'];
}
$stmt->close();

// Préparer les données pour le paiement
// Application d'une remise de trois pourcent sur le prix pour les clients VIP (role = 2)
$isVIP = isset($_SESSION['role']) && $_SESSION['role'] == 2;
$discountRate = $isVIP ? 0.03 : 0;

// Calculer le sous-total (avant remise)
$subtotal = $base_price + $options_total;

// Calculer la remise si applicable
$discount = $isVIP ? $subtotal * $discountRate : 0;

// Calculer le total avec remise
$total_amount = $subtotal - $discount;

// Transformation du prix au format correct pour le paiement
$montant = number_format((float)$total_amount, 2, '.', '');

// Pour débogage (à retirer en production)
// error_log("Paiement - Détails : base_price=$base_price, options_total=$options_total, subtotal=$subtotal, discount=$discount, total_amount=$total_amount, montant=$montant");

$transaction = "900000000". $booking_id;
$retour = "http://" . $_SERVER['HTTP_HOST'] . "/CYvago-MEF2-A/retourpaiement.php?booking_id=" . $booking_id;

// Obtenir l'API key pour le paiement
require('getapikey.php');
$vendeur = "MEF-2_A";
$api_key = getAPIKey($vendeur);

// Générer la valeur de contrôle pour la page de paiement
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");

// Stockage dans la session pour la page de redirection
$_SESSION['payment_data'] = [
    'booking_id' => $booking_id,
    'montant' => $montant,
    'travel_title' => $booking['title'],
    'is_vip' => $isVIP,
    'discount' => $discount,
    'subtotal' => $subtotal
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <title>Paiement - ZanimoTrip</title>
    <link rel="stylesheet" href="css/paiement.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <main>
        <div class="payment-container">
            <div class="payment-header">
                <h1>Finaliser votre paiement</h1>
                <p>Veuillez vérifier les détails de votre réservation et procéder au paiement</p>
            </div>
            
            <div class="booking-summary">
                <div class="booking-image">
                    <img src="<?= htmlspecialchars($booking['image']) ?>" alt="<?= htmlspecialchars($booking['title']) ?>">
                </div>
                
                <div class="booking-info">
                    <h2><?= htmlspecialchars($booking['title']) ?></h2>
                    
                    <div class="info-row">
                        <span class="info-label">Numéro de réservation:</span>
                        <span>#<?= htmlspecialchars($booking['id']) ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Date de départ:</span>
                        <span><?= date('d/m/Y', strtotime($booking['departuredate'])) ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre de personnes:</span>
                        <span><?= htmlspecialchars($booking['nbrperson']) ?></span>
                    </div>
                </div>
            </div>
            
            <div class="payment-details">
                <h3>Détail de votre commande</h3>
                
                <div class="price-breakdown">
                    <div class="price-row">
                        <div class="price-label">Forfait de base (<?= number_format($booking['price'], 2, ',', ' ') ?>€ × <?= $booking['nbrperson'] ?> personnes)</div>
                        <div class="price-value"><?= number_format($base_price, 2, ',', ' ') ?>€</div>
                    </div>
                    
                    <?php if (!empty($options)): ?>
                    <div class="price-row">
                        <div class="price-label">Options sélectionnées:</div>
                        <div class="price-value"><?= number_format($options_total, 2, ',', ' ') ?>€</div>
                    </div>
                    
                    <div class="options-detail">
                        <?php foreach ($options as $option): ?>
                        <div class="option-item">
                            <div class="option-name"><?= htmlspecialchars($option['title']) ?> (<?= $option['nbrperson'] ?> pers.)</div>
                            <div class="option-price"><?= number_format($option['price'] * $option['nbrperson'], 2, ',', ' ') ?>€</div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="price-row subtotal-row">
                        <div class="price-label">Sous-total</div>
                        <div class="price-value"><?= number_format($subtotal, 2, ',', ' ') ?>€</div>
                    </div>
                    
                    <?php if ($isVIP): ?>
                    <div class="price-row discount-row">
                        <div class="price-label">Remise VIP (3%)</div>
                        <div class="price-value">-<?= number_format($discount, 2, ',', ' ') ?>€</div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="price-row total-row">
                        <div class="price-label">TOTAL</div>
                        <div class="price-value"><?= number_format($total_amount, 2, ',', ' ') ?>€</div>
                    </div>
                </div>
            </div>
            
            <div class="payment-form">
                <div class="secure-payment-notice">
                    <img src="img/secure-payment.svg" alt="Paiement sécurisé" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\'><path fill=\'%23e9b52f\' d=\'M12 1a9 9 0 0 0-9 9v4c0 .55.45 1 1 1h1v-4a7 7 0 1 1 14 0v4h1c.55 0 1-.45 1-1v-4a9 9 0 0 0-9-9zm-4 10h2v6H8v-6zm6 0h2v6h-2v-6z\'/></svg>'">
                    <p>Toutes vos informations bancaires sont protégées par un système de paiement sécurisé.</p>
                </div>
                
                <form id="paymentForm" action="paiement-redirect.php" method="POST">            
                    <button type="submit" class="button1">Procéder au paiement</button>
                </form>
            </div>
            
            <div class="payment-info">
                <p>En cliquant sur "Procéder au paiement", vous serez redirigé vers notre plateforme de paiement sécurisée.</p>
                <p>Votre réservation ne sera confirmée qu'après validation du paiement.</p>
            </div>
        </div>
    </main>
    
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>