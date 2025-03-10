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
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main>
        <article>
            <h1 class="slogan">L'aventure au plus près des animaux !</h1>
        </article>
        <div class="video-container">
            <video class="video-background" autoplay loop muted>
                <source src="clipZanimoTrip.mp4" type="video/mp4">
                Votre navigateur ne supporte pas les vidéos.
            </video>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>