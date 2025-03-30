<?php
    /*
     <?php
     ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>
    */
    if(isset($_POST['Mail'])&&isset($_POST['MotDePasse'])){
        include 'database.php';
        $EMAIL = $_POST['Mail'];
        $MDP = $_POST['MotDePasse'];
        

        if((!empty($EMAIL))&&(!empty($MDP))){
            $verification = $database->prepare("SELECT email FROM users WHERE email=?");
            $verification->bind_param("s", $EMAIL);
            $verification->execute();
            $verification->bind_result($result);
            $verification->fetch();
            $verification->close();
            var_dump($result);
            if($result==true){
                $verification = $database->prepare("SELECT firstname, lastname, password, role FROM users WHERE email=?");
                $verification->bind_param("s", $EMAIL);
                $verification->execute();
                $verification->bind_result($prenom, $nomdefamille, $result, $role);
                $verification->fetch();
                $verification->close();
                if(password_verify($MDP, $result)){
                    echo "Connexion OK";
                    session_start();
                    $_SESSION['email'] = $EMAIL;
                    $_SESSION['prenom'] = $prenom;
                    $_SESSION['nomdefamille'] = $nomdefamille;
                    $_SESSION['MDP'] = $result;
                    $_SESSION['role'] = $role;
                    header("Location: monCompte.php?success=true");
                }
                else{
                    header("Location: connexion.php?error=password");
                    exit();
                }
            }
            else{
                header("Location: inscription.php?error=user");
                exit();
            }
        }
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
    <title>ZanimoTrip Connexion</title>
    <!-- <link rel="stylesheet" href="css/formulaire.css"> -->
    <link rel="stylesheet" href="css/formulaire.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main>
        <!-- Cas de la déconnexion -->
        <?php if(isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
            <div class="message-decon-ok show">
                Vous avez été déconnecté avec succès.
            </div>
        <?php endif; ?>
        <!-- Cas du mauvais mot de passe -->
        <?php if(isset($_GET['error']) && $_GET['error'] == 'password'): ?>
            <div class="message-error show">
                Le mot de passe ne correspond pas.
            </div>
        <?php endif; ?>
        <!-- Cas de l'utilisateur déjà inscrit -->
        <?php if(isset($_GET['error']) && $_GET['error'] == 'alreadyUser'): ?>
        <div class="message-decon-ok show">
            Vous êtes déjà inscrit, connectez-vous ici.
        </div>
        <?php endif; ?>
        <div class="container-form">
            <form action="" method="post">
                <p style="font-size: 20px;"><b>Se connecter :</b></p><br>
                <label for="AdresseMail">Adresse Mail :</label>
                <input type="email" id="AdresseMail" name="Mail" placeholder="Champ obligatoire" maxlength="50" required /><br>
                <label for="MotDePasse">Mot de passe :</label>
                <input type="password" id="MotDePasse" name="MotDePasse" maxlength="50" required placeholder="Champ obligatoire"/><br>
                <div class="button-form">
                    <button class="button1" type="submit">Se connecter</button>
                </div>
                <p>Pas encore de compte ? <a href="inscription.php" class="link">S'inscrire</a></p>
            </form>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>

</body>
</html>

