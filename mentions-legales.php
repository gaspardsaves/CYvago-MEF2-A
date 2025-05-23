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
    <title>ZanimoTrip Mentions Légales</title>
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
        <h1>Mentions Légales</h1>

        <h2>1. Éditeur du site</h2>
        <p>Le site <strong>ZanimoTrip</strong> est édité par :</p>
        <p><strong>Nom de l’entreprise :</strong> ZanimoTrip SAS</p>
        <p><strong>Siège social :</strong> France</p>
        <p><strong>Directeur de publication :</strong> Les MEF2 A</p>
        <p><strong>Contact :</strong> 📧 <a href="mailto:contact@zanimo-trip.com">contact@zanimo-trip.com</a></p>
    
        <h2>2. Hébergement</h2>
        <p>Le site est hébergé par :</p>
        <p><strong>Nom de l’hébergeur :</strong> CY Tech</p>
    
        <h2>3. Propriété intellectuelle</h2>
        <p>Tous les contenus présents sur le site <strong>ZanimoTrip</strong> (textes, images, logos, vidéos, etc.) sont protégés par le droit d’auteur et la propriété intellectuelle.</p>
        <p>Toute reproduction, modification ou diffusion sans autorisation est interdite.</p>
    
        <h2>4. Protection des données personnelles</h2>
        <p>Le site collecte des informations personnelles dans le cadre de ses services. Pour en savoir plus, consultez notre <a href="confidentialite.php">Politique de Confidentialité</a>.</p>
    
        <h2>5. Responsabilité</h2>
        <p>ZanimoTrip ne saurait être tenu responsable en cas de dysfonctionnement du site, d’erreurs ou d’inexactitudes dans les informations publiées.</p>
    
        <h2>6. Cookies</h2>
        <p>Le site ZanimoTrip utilise des cookies pour améliorer l’expérience utilisateur. Vous pouvez modifier vos préférences via les paramètres de votre navigateur.</p>
    
        <h2>7. Droit applicable</h2>
        <p>Les présentes mentions légales sont soumises au droit français. En cas de litige, les tribunaux français seront seuls compétents.</p>
    
        <h2>8. Contact</h2>
        <p>Pour toute question concernant les mentions légales, vous pouvez nous contacter par email à <a href="mailto:contact@zanimo-trip.com">contact@zanimo-trip.com</a>.</p>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>