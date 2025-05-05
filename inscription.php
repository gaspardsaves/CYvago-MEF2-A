<?php
    include 'session.php';
    include 'database.php';
    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        $PRENOM = $_POST["prenom"];
        $EMAIL = $_POST["mail"];
        $NOM = $_POST["nom"];
        $DATE = $_POST["date"];
        $TEL = $_POST["tel"];
        $MDP = $_POST["mdp"];
        $VERIFMDP = $_POST["verifmdp"];
        $role = 1;
        if($MDP==$VERIFMDP){
            if((!empty($PRENOM))&&(!empty($NOM))&&(!empty($EMAIL))&&(!empty($MDP))&&($MDP==$VERIFMDP)){ 
                $sqlverif = "SELECT email FROM users WHERE email=:email";
                $verifmail = $database->prepare("SELECT email FROM users WHERE email=?");
                $verifmail->bind_param("s", $EMAIL);
                $verifmail->execute();
                $verifmail->store_result();
                $res = $verifmail->num_rows;
                $verifmail->close();
                if($res==0){
                    $options = [
                        'cost' => 12,
                    ];
                    $hashpass = password_hash($MDP, PASSWORD_BCRYPT, $options);
                    $sql = "INSERT INTO users (lastname, firstname, email, password, role) VALUES ('$NOM', '$PRENOM', '$EMAIL', '$hashpass', '$role')";
                    if($database->query($sql) == TRUE){
                        // Création d'une session pour le nouvel utilisateur
                            $_SESSION['email'] = $EMAIL;
                            $_SESSION['prenom'] = $PRENOM;
                            $_SESSION['nom'] = $NOM;
                            $_SESSION['role'] = $role;
                            // Redirection dans le profil de ce nouvel utilisateur
                            header("Location:monCompte.php?success=newok");
                            exit();
                        }
                    else{
                        header("Location:inscription.php?success=no");
                        exit();
                    }
                }
                else {
                    header("Location:connexion.php?error=alreadyUser");
                    exit();
                }
            }
        }
        else{
            header("Location:inscription.php?error=mdp");
            exit();
        }
        
    }
    if (isset($database)) {
        $database->close();
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
    <title>ZanimoTrip Inscription</title>
    <link rel="stylesheet" href="css/formulaire.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
        <!-- Cas de l'utilisateur non inscrit provenant de connexion -->
        <?php if(isset($_GET['error']) && $_GET['error'] == 'user'): ?>
            <div class="message-error show">
                Il n'y a pas de compte associé à ce mail.
            </div>
        <?php endif; ?>
        <!-- Cas de l'échec de création -->
        <?php if(isset($_GET['success']) && $_GET['success'] == 'no'): ?>
        <div class="message-error show">
            Echec de la création de compte. Réessayez.
        </div>
        <!-- Cas de la mauvaise confirmation de mot de passe -->
        <?php endif; ?>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'mdp'): ?>
        <div class="message-error show">
            Les mots de passe ne correspondent pas. Essayez à nouveau.
        </div>
        <?php endif; ?>
        <div class="container-form">
            <form action="" method="POST">
                <p style="font-size: 20px;"><b> S'inscrire:</b></p>
                <p>
                    <input type="radio" name="pres" value="mademoiselle" /> Mademoiselle
                    <input type="radio" name="pres" value="madame"/> Madame
                    <input type="radio" name="pres" value="monsieur"/> Monsieur <br />
                </p>
                <label for="prenom"> Prénom : </label> <input type="text" name="prenom" placeholder="Philippe" maxlength="50" required> <br />
                <label for="nom"> Nom(s) : </label> <input type="text" name="nom" placeholder="DUPONT" maxlength="50" required> <br />
                <label for="mail"> Adresse mail : </label> <input type="email" name="mail" placeholder="xavier.dupont@mail.com" required> <br />
                <div id="emailError" class="error-message"></div> <!-- Message d'erreur pour l'email -->

                <label for="mdp">Mot de passe : </label> <input type="password" name="mdp" placeholder="Mot de passe" required> <br />
                <div id="passwordError" class="error-message"></div> <!-- Message d'erreur pour le mot de passe -->
            
                <label for="mdp">Confirmation du mot de passe : </label> <input type="password" name="verifmdp" placeholder="Mot de passe" required> <br />
                <div id="confirmPasswordError" class="error-message"></div> <!-- Message d'erreur pour la confirmation du mot de passe -->
                
                <label for="date"> Date de naissance : </label> <input type="date" name="date" required> <br />
                <label for="tel"> Téléphone : </label> <input type="tel" name="tel" placeholder="05.69.13.00.01" required> <br />

                <div class="button-form">
                    <button class="button1" type="reset">Reset</button>
                    <button class="button1" type="submit">Valider</button>
                </div>
                <p>Déjà un compte ? <a href="connexion.php" class="link">Se connecter</a></p>
            </form>
        </div>
        
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
    <script src="js/formValidation.js"></script>
</body>
</html>