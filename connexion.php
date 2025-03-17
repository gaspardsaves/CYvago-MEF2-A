<!DOCTYPE html>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>
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
    <title>ZanimoTrip Connexion</title>
    <link rel="stylesheet" href="css/formulaire.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main>
        <?php
            if (!isset($_POST['NomUtilisateur']) || !isset($_POST['MotDePasse'])) {            
        ?>
        <div class="container-form">
            <form action="connexion.php" method="post">
                <p style="font-size: 20px;"><b>Se connecter :</b></p><br>
                <label for="NomUtilisateur">Adresse Mail :</label>
                <input type="email" id="NomUtilisateur" name="Mail" placeholder="Champ obligatoire" maxlength="50" required /><br>
                <label for="MotDePasse">Mot de passe :</label>
                <input type="password" id="MotDePasse" name="MotDePasse" maxlength="50" required placeholder="Champ obligatoire"/><br>
                    
                <div class="button-form">
                    <button class="button1" type="submit">Se connecter</button>
                </div>
                <p>Pas encore de compte ? <a href="inscription.php" class="link">S'inscrire</a></p>
                <p>Accès à la page Mon Compte dans l'attente du backend <a href="monCompte.php" class="link">Mon Compte</a></p>
            </form>
        </div>
        <?php
            } else {
                echo "Connexion OK";
            }
        ?>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>

</body>
</html>
