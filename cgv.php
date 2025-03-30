<?php 
    include 'session.php';
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
    <title>ZanimoTrip CGV</title>
    <link rel="stylesheet" href="css/legal.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main class="legal">
        <h1>Conditions Générales de Vente (CGV)</h1>
        <h2>1. Objet</h2>
        <p>Les présentes CGV régissent la vente de séjours et expériences proposées par ZanimoTrip.</p>
        <h2>2. Réservations et paiements</h2>
        <ul>
            <li>Toute réservation doit être effectuée via notre site web.</li>
            <li>Le paiement est exigé au moment de la réservation, sauf mention contraire.</li>
            <li>Les moyens de paiement acceptés sont : carte bancaire, PayPal et virement bancaire.</li>
        </ul>
        <h2>3. Annulation et remboursement</h2>
        <ul>
            <li>Annulation gratuite jusqu’à 14 jours avant le début du séjour.</li>
            <li>50% du montant est retenu pour toute annulation entre 14 et 7 jours avant le départ.</li>
            <li>Aucun remboursement en cas d’annulation à moins de 7 jours du départ.</li>
        </ul>
        <h2>4. Responsabilité</h2>
        <p>Nous ne sommes pas responsables des incidents survenant pendant le séjour, sauf en cas de faute grave de notre part.</p>
        <h2>5. Droit applicable</h2>
        <p>Les présentes CGV sont soumises au droit français. En cas de litige, les tribunaux français seront compétents.</p>
        <p>📧 Pour toute question, contactez-nous à <a href="mailto:contact@zanimo-trip.com">contact@zanimo-trip.com</a>.</p>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>