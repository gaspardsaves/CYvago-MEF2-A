
<?php 
    
?>
    <nav class="nav-bar">
        <div class="logo">
            <a href="accueil.php"> <img src="img/ZanimoTripDef.png"> </a>
        </div>
        <div class="buttons-nav">
        
            <form action="presentation.php">
                <button class="button1" type="submit">L'expérience ZanimoTrip</button>
            </form>
            <form action="sejours.php">
                <button class="button1" type="submit">Séjours</button>
            </form>
            <script src="js/mode.js"></script>
            <link rel="stylesheet" href="css/designSite.css">
            <link rel="stylesheet" href="css/mode-clair.css">
            <button id="Clair-sombre" class="button1">
              <p id="text">Clair</p>
            </button>   
            <?php
            if(isset($_SESSION['email'])&&(isset($_SESSION['prenom']))&&(isset($_SESSION['nomdefamille']))&&(isset($_SESSION['role']))&&(isset($_SESSION['MDP']))){
                echo '<form action="moncompte.php"><button class="button1" type="submit">'. htmlspecialchars($_SESSION['prenom']). '</button></form>';
            }
            else{
                echo '<form action="connexion.php"><button class="button1" type="submit">🔐 Connexion</button></form>';
            }
            ?>
            <?php
            if(isset($_SESSION['email'])&&(isset($_SESSION['prenom']))&&(isset($_SESSION['nomdefamille']))&&(isset($_SESSION['role']))&&(isset($_SESSION['MDP']))&&($_SESSION['role'])==0){
            echo '<form action="administrateur.php"><button class="button1" type="submit">Admin</button>';
            }
        ?>
        </div>
    </nav>
