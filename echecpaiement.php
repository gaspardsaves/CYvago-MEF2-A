<?php
include 'session.php';
include 'database.php';

$booking_id = $_GET['booking_id'] ?? null;
$payment_message = $_SESSION['payment_message'] ?? "Votre paiement a été refusé.";
// Effacer les messages temporaires
unset($_SESSION['payment_error']);
unset($_SESSION['payment_message']);
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
    <title>Paiement échoué - ZanimoTrip</title>
    <link rel="stylesheet" href="css/echecpaiement.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js<?php echo time(); ?>"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    <main>
        <div class="error-container">
            <div class="error-header">
                <div class="error-icon">✕</div>
                <h1>Paiement échoué</h1>
                <p>Nous n'avons pas pu traiter votre paiement.</p>
            </div>
            
            <div class="error-message">
                <p><?= htmlspecialchars($payment_message) ?></p>
                <p>Votre réservation est enregistrée mais n'est pas encore confirmée.</p>
                <p>Vous pouvez réessayer le paiement maintenant ou plus tard depuis votre espace personnel.</p>
            </div>
            
            <div class="buttons">
                <form action="accueil.php">
                    <button class="button1" type="submit">Retour à l'accueil</button>
                </form>
                <?php if ($booking_id): ?>
                    <form action="paiement.php" method="POST">
                        <input type='hidden' name='booking_id' value="<?= htmlspecialchars($booking_id) ?>">
                        <button class="button1" type="submit">Réessayer le paiement</button>
                    </form>
                <?php endif; ?>
                <form action="mesreservations.php">
                    <button class="button1" type="submit">Voir mes réservations</button>
                </form>
            </div>
        </div>
    </main>
    
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>