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
    <title>ZanimoTrip CGU</title>
    <link rel="stylesheet" href="css/legal.css">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main class="legal">
        <h1>Conditions Générales d'Utilisation (CGU)</h1>
        <h2>1. Objet</h2>
        <p>Les présentes CGU définissent les règles d’utilisation du site ZanimoTrip.</p>
        <h2>2. Accès au site</h2>
        <p>L’accès au site est gratuit. Certaines fonctionnalités nécessitent une inscription et la création d’un compte utilisateur.</p>
        <h2>3. Obligations de l’utilisateur</h2>
        <p>L’utilisateur s’engage à :</p>
        <ul>
            <li>Fournir des informations exactes lors de l’inscription.</li>
            <li>Ne pas utiliser le site à des fins frauduleuses ou illégales.</li>
            <li>Respecter les droits des autres utilisateurs.</li>
        </ul>
        <h2>4. Responsabilité</h2>
        <p>ZanimoTrip ne peut être tenu responsable des interruptions du service, ni des dommages causés par l’utilisation du site.</p>
        <h2>5. Modification des CGU</h2>
        <p>Nous nous réservons le droit de modifier ces CGU à tout moment. Les utilisateurs seront informés des modifications importantes.</p>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>