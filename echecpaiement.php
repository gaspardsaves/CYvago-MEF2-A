<?php
    echo 'Echec de paiement';
?>

<?php
/*
include 'session.php';
include 'database.php';

$booking_id = $_GET['booking_id'] ?? null;
$payment_error = $_SESSION['payment_error'] ?? false;
$payment_message = $_SESSION['payment_message'] ?? "Votre paiement a été refusé.";

// Effacer les messages temporaires
unset($_SESSION['payment_error']);
unset($_SESSION['payment_message']);


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
    <title>Paiement échoué - ZanimoTrip</title>
    <link rel="stylesheet" href="css/designSite.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js"></script>
    <style>
    </style>
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    
    <main>
        <div class="error-container">
            <div class="error-header">
                <div class="error-icon">✕</div>
                <h1>Paiement échoué</h1>
                <p>Nous n'avons pas pu traiter votre paiement.</p>
            </div>
            
            <div class="error-message">
                <p><?= htmlspecialchars($payment_message) ?></p>
                <p>Votre réservation est enregistrée mais n'est pas encore confirmée. Veuillez réessayer le paiement.</p>
            </div>
            
            <div class="buttons">
                <a href="index.php" class="button1">Retour à l'accueil</a>
                <?php if ($booking_id): ?>
                <a href="paiement.php?booking_id=<?= $booking_id ?>" class="button1">Réessayer le paiement</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
*/
?>