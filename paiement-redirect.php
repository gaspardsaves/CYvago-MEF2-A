<?php
include 'session.php';
include 'database.php';

// Vérifier si les données de paiement sont disponibles en session
if (!isset($_SESSION['payment_data'])) {
    header("Location: index.php");
    exit;
}

// Récupérer les données de paiement
$booking_id = $_SESSION['payment_data']['booking_id'];
$montant = $_SESSION['payment_data']['montant'];

$travel_title = $_SESSION['payment_data']['travel_title'];

// Préparation des données pour CYBank
$transaction = "900000000". $booking_id;
$retour = "http://" . $_SERVER['HTTP_HOST'] . "/CYvago-MEF2-A/retourpaiement.php?booking_id=" . $booking_id;

// Obtenir l'API key pour le paiement
require('getapikey.php');
$vendeur = "MEF-2_A";
$api_key = getAPIKey($vendeur);

// Générer la valeur de contrôle pour la page de paiement
$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
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
    <title>Redirection vers la plateforme de paiement - ZanimoTrip</title>
    <link rel="stylesheet" href="css/paiement-redirect.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
    <script src="js/paiement-redirect.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <div class="redirect-container">
        <h1>Redirection vers la plateforme de paiement</h1>
        
        <div class="reservation-details">
            <p><strong>Voyage :</strong> <?= htmlspecialchars($travel_title) ?></p>
            <p><strong>Numéro de réservation :</strong> #<?= htmlspecialchars($booking_id) ?></p>
            <p><strong>Montant à payer :</strong> <?= number_format($montant, 2, ',', ' ') ?> €</p>
        </div>
        
        <p>Vous allez être redirigé automatiquement vers la plateforme de paiement sécurisée.</p>
        <div class="spinner"></div>
        <p>Veuillez patienter...</p>
        
        <!-- Formulaire qui sera soumis automatiquement via JavaScript -->
        <form id="paymentForm" action="https://www.plateforme-smc.fr/cybank/index.php" method="POST">            
            <input type='hidden' name='transaction' value="<?= htmlspecialchars($transaction) ?>">
            <input type='hidden' name='montant' value="<?= htmlspecialchars($montant) ?>">
            <input type='hidden' name='vendeur' value="<?= htmlspecialchars($vendeur) ?>">
            <input type='hidden' name='retour' value="<?= htmlspecialchars($retour) ?>">
            <input type='hidden' name='control' value="<?= htmlspecialchars($control) ?>">

            <div class="manual-button">
                <noscript>
                    <p>Votre navigateur n'exécute pas JavaScript. Veuillez cliquer sur le bouton ci-dessous pour continuer.</p>
                    <button type="submit" class="button1">Continuer vers le paiement</button>
                </noscript>
            </div>
        </form>
    </div>
</body>
</html>