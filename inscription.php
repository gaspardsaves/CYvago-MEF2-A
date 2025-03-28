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
    <link rel="stylesheet" href="css/formulaire.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
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
                <label for="mdp">Mot de passe : </label> <input type="password" name="mdp" required> <br />
                <label for="mdp">Confirmation du Mot de passe : </label> <input type="password" name="verifmdp" required> <br />
                <label for="date"> Date de naissance : </label> <input type="date" name="date" required> <br />
                <label for="tel"> Téléphone : </label> <input type="tel" name="tel" placeholder="05.69.13.00.01" required> <br />

                <div class="button-form">
                    <button class="button1" type="reset">Reset</button>
                    <button class="button1" type="submit">Valider</button>
                </div>
                <p>Déjà un compte ? <a href="connexion.php" class="link">Se connecter</a></p>
                <p>Accès à la page administrateur dans l'attente du backend  <a href="administrateur.php" class="link">Page Administrateur</a></p>
            </form>
        </div>
        
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>

<?php
    //Si vous n'êtes pas sur ma machine changer les coordonnées de connexion à phpmyadmin
    $user = "root";
    $server = "localhost";
    $password = "";
    $DB = "zanimotrip";
    global $db;
    $connexion = new mysqli($server, $user, $password, $DB);
    if ($connexion->connect_error) {
        die("Erreur de connexion: " . $connexion->connect_error);
    }
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
                /*$sqlverif = "SELECT email FROM users WHERE email=:email";
                $verifmail = $db->prepare("SELECT email FROM users WHERE email=:email");
                $verifmail->execute(['email' => $EMAIL]);
                $res = $verifmail->rowCount();
                echo $res;
                if($res==0){*/
                    $options = [
                        'cost' => 12,
                    ];
                    $hashpass = password_hash($MDP, PASSWORD_BCRYPT, $options);
                    $sql = "INSERT INTO users (lastname, firstname, email, password, role) VALUES ('$NOM', '$PRENOM', '$EMAIL', '$hashpass', '$role')";
                    if($connexion->query($sql) == TRUE){
                        header("Location:inscription.php/messages=InscriptionOK");
                            exit();
                    /*}
                    else{
                        echo "echec";
                    }*/
                }
                else {
                    echo "Mail déjà utilisé";
                }
            }
            //FAUT AJOUTER DU FRONT POUR CONNEXION REUSSI
        }
        else{
            //FAUT AJOUTER DU FRONT LORSQUE LA CONFIRMATION DU MDP éCHOUE
            echo "mauvaise confirmation du mdp";
        }
       
    }
  
    $connexion->close()
?>