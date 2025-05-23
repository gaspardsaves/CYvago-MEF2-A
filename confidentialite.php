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
    <title>ZanimoTrip Confidentialité</title>
    <link rel="stylesheet" href="css/legal.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main class="legal">
        <h1>Politique de Confidentialité</h1>
        <h2>1. Collecte des données personnelles</h2>
        <p>Nous collectons certaines informations lorsque vous utilisez notre site ZanimoTrip, notamment :</p>
        <ul>
            <li>Nom, prénom, adresse e-mail et numéro de téléphone lors de votre inscription ou réservation.</li>
            <li>Informations de paiement pour les achats effectués.</li>
            <li>Données de navigation via des cookies et technologies similaires.</li>
        </ul>
        <h2>2. Utilisation des données</h2>
        <p>Les données collectées sont utilisées pour :</p>
        <ul>
            <li>Gérer votre compte utilisateur et vos réservations.</li>
            <li>Améliorer votre expérience sur le site.</li>
            <li>Vous envoyer des offres promotionnelles et actualités (avec votre consentement).</li>
        </ul>
        <h2>3. Partage des données</h2>
        <p>Vos informations ne sont jamais vendues à des tiers. Elles peuvent être partagées uniquement avec :</p>
        <ul>
            <li>Nos prestataires de services pour le bon fonctionnement du site.</li>
            <li>Les autorités légales en cas d'obligation juridique.</li>
        </ul>
        <h2>4. Sécurité des données</h2>
        <p>Nous mettons en œuvre des mesures de sécurité avancées pour protéger vos informations personnelles.</p>
        <h2>5. Vos droits</h2>
        <p>Vous avez le droit d’accéder, modifier ou supprimer vos données personnelles. Contactez-nous à <a href="mailto:contact@zanimo-trip.com">contact@zanimo-trip.com</a> pour toute demande.</p>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>