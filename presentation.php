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
    <title>ZanimoTrip Présentation</title>
    <link rel="stylesheet" href="css/presentation.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main>
        <div class="pres-content">
            <h1>🌍 ZanimoTrip – L'Aventure Animalière de Vos Rêves ! 🐾</h1>
            <p>
                Bienvenue chez <strong>ZanimoTrip</strong>, l’agence de voyage dédiée aux passionnés d’animaux et de nature ! 🌿🐾<br>
                Vous rêvez d’explorer des terres sauvages et d’approcher des espèces fascinantes ? Nous créons des <strong>séjours immersifs</strong> pour partir à la rencontre des animaux du monde entier.
            </p>
    
            <h2>🐫 Pourquoi choisir ZanimoTrip ?</h2>
            <ul>
                <li><strong>Expériences authentiques</strong> : Rencontrez des animaux dans leur habitat naturel.</li>
                <li><strong>Éco-responsabilité</strong> : Des voyages respectueux des écosystèmes et des populations locales.</li>
                <li><strong>Des guides passionnés</strong> : Experts animaliers et amoureux du voyage.</li>
            </ul>
    
            <h2>🌎 Nos Destinations Uniques :</h2>
            <ul>
                <li>🐪 <strong>Mongolie</strong> : Partez sur les traces des yaks.</li>
                <li>🐬 <strong>Costa Rica</strong> : Nagez aux côtés des dauphins et découvrez la faune tropicale.</li>
                <li>🦓 <strong>Afrique</strong> : Safari inoubliable à la rencontre des Big Five.</li>
                <li>🐧 <strong>Antarctique</strong> : Observez les manchots dans un décor glacé.</li>
            </ul>
    
            <h2>🌟 Vivez une aventure hors du commun avec ZanimoTrip ! 🌟</h2>
            <p>➡️ <strong>Réservez votre séjour dès aujourd’hui !</strong></p>
            <form action="sejours.php">
                <button class="button1" type="submit">Séjours</button>
            </form>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>