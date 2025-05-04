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
    <title>ZanimoTrip Accueil</title>
    <link rel="stylesheet" href="css/accueil.css">
    <script src="js/mode.js"></script>
    <link rel="stylesheet" href="css/mode-clair.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <div class="container-form">
        <button id="Clair-sombre" class="button1">
              <p id="text">Clair</p>
        </button>   
        </div>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
    <script src="js/mode.js"></script>
</body>
</html>