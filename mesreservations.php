<?php
include 'session.php';
include 'database.php';

// Redirection si l'utilisateur n'est pas connecté
if(!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer toutes les réservations de l'utilisateur
$stmt = $database->prepare("
    SELECT 
        b.id, 
        b.departuredate, 
        b.nbrperson, 
        b.status,
        t.id as travel_id, 
        t.title, 
        t.image, 
        t.price,
        t.nbrdays,
        MAX(p.date) as payment_date,
        MAX(p.status) as payment_status
    FROM booking b
    JOIN travel t ON b.travel = t.id
    LEFT JOIN payment p ON b.id = p.reservation
    WHERE b.user = ?
    GROUP BY b.id
    ORDER BY b.departuredate DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$reservations = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Récupérer les options pour chaque réservation
$bookingOptions = [];
if (!empty($reservations)) {
    foreach ($reservations as $reservation) {
        $stmt = $database->prepare("
            SELECT 
                e.nbrperson,
                ex.title as option_title,
                ex.price as option_price
            FROM engagement e
            JOIN extra ex ON e.extra = ex.id
            WHERE e.booking = ?
        ");
        $stmt->bind_param("i", $reservation['id']);
        $stmt->execute();
        $optionsResult = $stmt->get_result();
        $bookingOptions[$reservation['id']] = $optionsResult->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }
}

// Fonction pour calculer le prix total d'une réservation
function calculateTotalPrice($reservation, $options = []) {
    $basePrice = $reservation['price'] * $reservation['nbrperson'];
    $optionsTotal = 0;
    
    foreach ($options as $option) {
        $optionsTotal += $option['option_price'] * $option['nbrperson'];
    }
    
    // Appliquer la remise VIP si nécessaire
    $isVIP = isset($_SESSION['role']) && $_SESSION['role'] == 0;
    $discount = $isVIP ? ($basePrice + $optionsTotal) * 0.03 : 0;
    
    return $basePrice + $optionsTotal - $discount;
}

// Déterminer le statut de paiement
function getPaymentStatus($reservation) {
    if ($reservation['payment_status'] === 'accepted') {
        return [
            'status' => 'Payée',
            'class' => 'status-paid',
            'icon' => '✅'
        ];
    } else if ($reservation['payment_status'] === 'denied') {
        return [
            'status' => 'Paiement refusé',
            'class' => 'status-refused',
            'icon' => '❌'
        ];
    } else {
        return [
            'status' => 'En attente de paiement',
            'class' => 'status-pending',
            'icon' => '⏳'
        ];
    }
}
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
    <title>Mes Réservations - ZanimoTrip</title>
    <link rel="stylesheet" href="css/mesreservations.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <!-- Barre de navigation -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <main>
        <div class="reservations-container">
            <h1>Mes Réservations</h1>
            
            <?php if(isset($_SESSION['cancel_success'])): ?>
                <div class="success-message">
                    <span class="success-icon">✓</span>
                    <?= htmlspecialchars($_SESSION['cancel_success']) ?>
                    <?php unset($_SESSION['cancel_success']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['cancel_error'])): ?>
                <div class="error-message">
                    <span class="error-icon">✗</span>
                    <?= htmlspecialchars($_SESSION['cancel_error']) ?>
                    <?php unset($_SESSION['cancel_error']); ?>
                </div>
            <?php endif; ?>

            <?php if(empty($reservations)): ?>
                <div class="no-reservations">
                    <p>Vous n'avez pas encore effectué de réservation.</p>
                    <a href="index.php" class="button1">Découvrir nos voyages</a>
                </div>
            <?php else: ?>
            
                <div class="reservations-list">
                    <?php foreach($reservations as $reservation): ?>
                        <?php 
                            $options = $bookingOptions[$reservation['id']] ?? [];
                            $totalPrice = calculateTotalPrice($reservation, $options);
                            $paymentStatus = getPaymentStatus($reservation);
                            $departureDate = new DateTime($reservation['departuredate']);
                            $isPast = $departureDate < new DateTime();
                        ?>
                        
                        <div class="reservation-card <?= $isPast ? 'past-reservation' : '' ?>">
                            <div class="reservation-header">
                                <div class="reservation-id">Réservation #<?= $reservation['id'] ?></div>
                                <div class="reservation-status <?= $paymentStatus['class'] ?>">
                                    <?= $paymentStatus['icon'] ?> <?= $paymentStatus['status'] ?>
                                </div>
                            </div>
                            
                            <div class="reservation-content">
                                <div class="travel-image">
                                    <img src="<?= htmlspecialchars($reservation['image']) ?>" alt="<?= htmlspecialchars($reservation['title']) ?>">
                                </div>
                                
                                <div class="travel-details">
                                    <h2><?= htmlspecialchars($reservation['title']) ?></h2>
                                    
                                    <div class="travel-info">
                                        <p><strong>Date de départ:</strong> <?= date_format($departureDate, 'd/m/Y') ?></p>
                                        <p><strong>Durée:</strong> <?= $reservation['nbrdays'] ?> jours</p>
                                        <p><strong>Nombre de personnes:</strong> <?= $reservation['nbrperson'] ?></p>
                                    </div>
                                    
                                    <?php if(!empty($options)): ?>
                                        <div class="options-section">
                                            <h3>Options sélectionnées:</h3>
                                            <ul>
                                                <?php foreach($options as $option): ?>
                                                    <li>
                                                        <?= htmlspecialchars($option['option_title']) ?> 
                                                        (<?= $option['nbrperson'] ?> pers.) - 
                                                        <?= number_format($option['option_price'] * $option['nbrperson'], 2, ',', ' ') ?> €
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="price-section">
                                        <div class="price-total">
                                            <strong>Prix total:</strong>
                                            <span><?= number_format($totalPrice, 2, ',', ' ') ?> €</span>
                                        </div>
                                        
                                        <?php if(($paymentStatus['status'] === 'En attente de paiement' || $paymentStatus['status'] === 'Paiement refusé') && !$isPast): ?>
                                            <form action="paiement.php" method="POST">
                                                <input type="hidden" name="booking_id" value="<?= $reservation['id'] ?>">
                                                <button type="submit" class="button1">
                                                    <?= $paymentStatus['status'] === 'Paiement refusé' ? 'Réessayer le paiement' : 'Payer maintenant' ?>
                                                </button>
                                            </form>
                                        <?php elseif($paymentStatus['status'] === 'Payée'): ?>
                                            <div class="payment-info">
                                                <p>Payée le <?= date('d/m/Y', strtotime($reservation['payment_date'])) ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="reservation-actions">
                                <form action="detail.php?id=<?= $reservation['travel_id'] ?>" method="POST">
                                    <button type="submit" class="button1">Voir le séjour</button>
                                </form>
                                <?php if(!$isPast && $paymentStatus['status'] !== 'Payée'): ?>
                                    <form action="cancelbooking.php?id=<?= $reservation['id'] ?>" method="POST">
                                        <input type="hidden" name="booking_id" value="<?= $reservation['id'] ?>">
                                        <button type="submit" class="button1">Annuler la réservation</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="back-button">
                    <form action="moncompte.php" method="POST">
                        <button type="submit" class="button1">← Retour à mon compte</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>
    
    <!-- Pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>