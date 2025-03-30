<?php 
    session_start();
    if(!isset($_SESSION['email'])){
        header ("location: connexion.php");
        exit();
    }
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
    <title>ZanimoTrip Mon Compte</title>
    <link rel="stylesheet" href="css/monCompte.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
        <!-- Cas de la connexion classique -->
        <?php if(isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="message-con-ok show">
                Bonjour <span id="nomUtilisateur"> <?php if(isset($_SESSION['prenom'])){echo $_SESSION['prenom'];}else{echo "non renseigné";}?></span> !
            </div>
        <?php endif; ?>
        <!-- Cas du nouvel utilisateur -->
        <?php if(isset($_GET['success']) && $_GET['success'] == 'newok'): ?>
            <div class="message-con-ok show">
                Bienvenue <span id="nomUtilisateur"> <?php if(isset($_SESSION['prenom'])){echo $_SESSION['prenom'];}else{echo "non renseigné";}?></span> !
            </div>
        <?php endif; ?>

        <div class="profile-container">
            <h1>Bienvenue sur votre profil !</h1>

            <div class="profile-card">
                <img src="img/blank-picture-profile.png" 
                    alt="photo de profil" class="profile-pic">
                <a href="monCompte.php" class="modify">📸 Changer de photo</a>
            </div>

            <div class="profile-info">
                <h2>Vos informations</h2>
                <p><strong>👤 Nom d'utilisateur :</strong> <span id="nomUtilisateur">
                    <?php if(isset($_SESSION['prenom'])){echo $_SESSION['prenom'];}else{echo "non renseigné";}?></span>    <a href="monCompte.html" class="modify">🖋 Modifier</a></p>
                <p><strong>🔑 Mot de passe :</strong> <a href="monCompte.html" class="modify">🖋 Modifier</a></p>
            </div></br>
            <div class="buttons-nav">
                <form action="panier.php">
                    <button class="button1" type="submit">🛍️ Panier</button>
                </form>
                <form action="logout.php">
                    <button class="button1" type="submit">⬅️ Déconnexion</button>
                </form>
            </div>
        </div>

    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>