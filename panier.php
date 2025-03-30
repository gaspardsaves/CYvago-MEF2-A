<?php
include 'session.php';
// Inclusion du fichier contenant la fonction getAPIKey
require('getapikey.php');
// Connexion à la base de données
$database = require('database.php');

$destination = isset($_POST['destination']) ? $_POST['destination'] : 'Voyage inconnu';
$price = isset($_POST['price']) ? $_POST['price'] : '';

$prixOptions = [
    'petit_dej' => 10,
    'assurance' => 25,
    'guide' => 50,
    'menage' => 30,
    'duree' => 100,
    'transport_avion' => 200,
    'transport_train' => 80,
    'chambre_simple' => 70,
    'chambre_double' => 120,
    'chambre_suite' => 200,
    'excursion' => 40,
    'serviceVIP' => 150,
    'activites' => 50
];

$total = 0;
$optionsSelectionnees = [];


foreach ($_POST as $key => $value) {

    if (isset($prixOptions[$key])) {
        $prix = is_numeric($value) ? $value * $prixOptions[$key] : $prixOptions[$key];
        $total += $prix;
        $optionsSelectionnees[] = [
            'nom' => ucfirst(str_replace('_', ' ', $key)), 
            'prix' => $prix
        ];
    }
}


if (isset($_POST['transport']) && isset($prixOptions[$_POST['transport']])) {
    $transport = $_POST['transport'];
    $total += $prixOptions[$transport];
    $optionsSelectionnees[] = [
        'nom' => ucfirst(str_replace('_', ' ', $transport)),
        'prix' => $prixOptions[$transport]
    ];
}

if (isset($_POST['chambre']) && isset($prixOptions[$_POST['chambre']])) {
    $chambre = $_POST['chambre'];
    $total += $prixOptions[$chambre];
    $optionsSelectionnees[] = [
        'nom' => ucfirst(str_replace('_', ' ', $chambre)),
        'prix' => $prixOptions[$chambre]
    ];
}

// Calcul du prix total
$totalPrice = $price + $total;

// Récupération de l'ID de réservation
$booking_id = $_GET['booking_id'] ?? $_POST['booking_id'] ?? null;

if ($booking_id) {
    // Récupération des informations de la réservation et calcul du montant total
    $query = "SELECT b.id, b.nbrperson, t.price, 
             (b.nbrperson * t.price + IFNULL(SUM(e.nbrperson * ex.price), 0)) as montant_total
             FROM booking b
             JOIN travel t ON b.travel = t.id
             LEFT JOIN engagement e ON e.booking = b.id
             LEFT JOIN extra ex ON e.extra = ex.id
             WHERE b.id = ?
             GROUP BY b.id";
    
    $stmt = $database->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservation = $result->fetch_assoc();
    $stmt->close();
    
    if ($reservation) {
        // Génération d'un identifiant de transaction unique
        $transaction = 'ZNT' . time() . rand(1000, 9999);
        $transaction = substr($transaction, 0, 20); // Format alphanumérique
        
        // Formatage du montant au format attendu (point comme séparateur)
        $montant = number_format($totalPrice, 2, '.', '');
        $vendeur = "MEF-2_A";
        $retour = "retourPaiement.php?booking_id=" . $booking_id;
        
        // Vérification si un paiement existe déjà pour cette réservation
        $stmt = $database->prepare("SELECT id FROM payment WHERE reservation = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $payment_exists = $result->num_rows > 0;
        $stmt->close();
        
        // Si aucun paiement n'existe, créer une entrée en attente
        if (!$payment_exists) {
            $stmt = $database->prepare("INSERT INTO payment (reservation, montant, date) VALUES (?, ?, NOW())");
            $stmt->bind_param("id", $booking_id, $montant);
            $stmt->execute();
            $payment_id = $database->insert_id;
            $stmt->close();
        }
        
        // Récupération de la clé API
        $api_key = getAPIKey($vendeur);
        
        // Vérification de la validité de la clé API
        if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
            die("Code vendeur invalide");
        }
        
        // Génération de la valeur de contrôle
        $control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
        ?>
        
        <form action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">
            <input type="hidden" name="transaction" value="<?php echo htmlspecialchars($transaction); ?>">
            <input type="hidden" name="montant" value="<?php echo htmlspecialchars($montant); ?>">
            <input type="hidden" name="vendeur" value="<?php echo htmlspecialchars($vendeur); ?>">
            <input type="hidden" name="retour" value="<?php echo htmlspecialchars($retour); ?>">
            <input type="hidden" name="control" value="<?php echo $control; ?>">
            <input type="submit" value="Valider et payer">
        </form>
        <?php
    } else {
        echo "Réservation introuvable";
    }
} else {
    echo "Aucune réservation spécifiée";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre, favicon et feuilles de style -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <title>ZanimoTrip Panier</title>
    <link rel="stylesheet" href="css/panier.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    <main>
        <div class="container-form">
            <h1>Votre panier pour : <?php echo htmlspecialchars(str_replace('+', ' ', $destination)); ?></h1>
            <div class="price">
                <h2>Prix hors option : <?php echo htmlspecialchars($price. "€"); ?></h2>
            </div>
            <div class="options-container">
                <p>Options sélectionnées :</p>
                <?php if (!empty($optionsSelectionnees)): ?>
                    <div class="options-list">
                        <?php foreach ($optionsSelectionnees as $option): ?>
                            <div><?php echo htmlspecialchars($option['nom']) . " - " . $option['prix'] . "€"; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Aucune option sélectionnée.</p>
                <?php endif; ?>
            </div>

            <p class="total">Total : <?php echo $totalPrice; ?>€</p>

            <div class="button-form">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="booking_id" value="<?php echo isset($_GET['booking_id']) ? $_GET['booking_id'] : ''; ?>">
                    <input type="hidden" name="destination" value="<?php echo htmlspecialchars($destination); ?>">
        
                    <?php 
                    // Transfert des options sélectionnées
                    foreach ($_POST as $key => $value) {
                        if ($key != 'booking_id' && $key != 'destination') {
                            echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                        }
                    }
                    ?>
                    <input type="submit" class="button1" value="Procéder au paiement">
                </form>
            </div>
        </div>
    </main>

    <?php require('phpFrequent/footer.php'); ?>

</body>
</html>