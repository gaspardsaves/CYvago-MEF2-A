<?php
include 'session.php';
include 'database.php';

// Récupérer l'ID de réservation et les messages
$booking_id = $_GET['booking_id'] ?? null;
$payment_message = $_SESSION['payment_message'] ?? "Votre paiement a été accepté.";

// Si un ID de réservation est fourni, récupérer les détails
$booking_details = null;
if ($booking_id) {
    $stmt = $database->prepare("
        SELECT b.id, b.departuredate, b.nbrperson, t.title, t.price, t.image, p.montant, p.date
        FROM booking b
        JOIN travel t ON b.travel = t.id
        LEFT JOIN payment p ON p.reservation = b.id
        WHERE b.id = ?
        ORDER BY p.date DESC LIMIT 1
    ");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $booking_details = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Effacer les messages temporaires
unset($_SESSION['payment_success']);
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
    <title>Paiement confirmé - ZanimoTrip</title>
    <link rel="stylesheet" href="css/confirmation.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js<?php echo time(); ?>"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    <main>
        <div class="confirmation-container">
            <div class="confirmation-header">
                <div class="success-icon">✓</div>
                <h1>Paiement confirmé</h1>
                <p><?= htmlspecialchars($payment_message) ?></p>
                <p>Votre réservation a été enregistrée avec succès.</p>
            </div>
            
            <?php if ($booking_details): ?>
            <div class="booking-details">
                <h2>Détails de votre réservation</h2>
                
                <div class="detail-row">
                    <span class="detail-label">Numéro de réservation:</span>
                    <span>#<?= htmlspecialchars($booking_details['id']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Destination:</span>
                    <span><?= htmlspecialchars($booking_details['title']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Date de départ:</span>
                    <span><?= date('d/m/Y', strtotime($booking_details['departuredate'])) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Nombre de personnes:</span>
                    <span><?= htmlspecialchars($booking_details['nbrperson']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Montant payé:</span>
                    <span><?= number_format($booking_details['montant'], 2, ',', ' ') ?> €</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Date de paiement:</span>
                    <span><?= date('d/m/Y à H:i', strtotime($booking_details['date'])) ?></span>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="buttons">
                <a href="accueil.php" class="button1">Retour à l'accueil</a>
                <a href="moncompte.php" class="button1">Voir mes réservations</a>
            </div>
        </div>
    </main> 
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>