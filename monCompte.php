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
    <title>ZanimoTrip Mon Compte</title>
    <link rel="stylesheet" href="css/monCompte.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
        <div class="profile-container">
            <h1>Bienvenue sur votre profil !</h1>

            <div class="profile-card">
                <img src="img/blank-picture-profile.png" 
                    alt="photo de profil" class="profile-pic">
                <a href="monCompte.php" class="modify">📸 Changer de photo</a>
            </div>

            <div class="profile-info">
                <h2>Vos informations</h2>
                <p><strong>👤 Nom d'utilisateur :</strong> <span id="nomUtilisateur">Non renseigné</span>    <a href="monCompte.html" class="modify">🖋 Modifier</a></p>
                <p><strong>🔑 Mot de passe :</strong> <span id="motDePasse">Non renseigné</span>    <a href="monCompte.html" class="modify">🖋 Modifier</a></p>
            </div></br>
            <form action="connexion.php">
                <button class="button1" type="submit">⬅️ Retour à la page de connexion</button>
            </form>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>