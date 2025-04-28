<?php
    include "database.php";
    include "session.php";
    $idVoyage = $_POST["idVoyage"];
    if(isset($_SESSION['email'])){
        $commande = $database->prepare("SELECT title, text, image, price, nbrdays FROM travel WHERE id=?");
        $commande->bind_param("s", $idVoyage);
        $commande->execute();
        $commande->bind_result($title, $text, $image, $price, $nbrdays);
        $commande->fetch();
        $commande->close();
    }
    else{
        header("Location: connexion.php"); 
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sejours.css">
    <!-- Titre, favicon et feuilles de style -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <title>Détails du Voyage</title>
    
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <main>
        <form action="reservation.php" method="post">
            <h1 class="title-travel">Le voyage <?= htmlspecialchars($title) ?></h1>
            <div class="contenu">
                <div class="detail-voyage">
                    <?php if (!empty($image)): ?>
                        <img src="<?= $image ?>" alt="<?= $title ?>" class="image-detail" />
                    <?php endif; ?>
                    <div class="info-voyage">
                        <h2> Description</h2>
                        <p><?= $text ?></p>
                        
                        <h2>Prix (en €): <?= $price ?></h2>
                        <h2>Dates Disponibles: <?= $nbrdays?></h2>
                        <label for="Nbpersonne">Nombre de personnes :</label>
                        <input type="number" name="Nbpersonne" min="1" max="5" required /><br>
                        <label for="date">Date de depart:</label>
                        <input type="date" id="depart" name="datededepart"><br>
                        <label for="date">Date de fin:</label>
                        <input type="date" id="fin" name="datededefin">                      
                        <div class="button-form">
                    </div>
                        <ul>
                            
                        </ul>
                    </div>
                </div>

            <div class="Option">
                    <h1>Les options</h1>
                    <?php
                        if(isset($_POST['idVoyage'])){
                            $commande = $database->prepare("SELECT stage.text, stage.chronology, stage.image, extra.id, extra.price FROM stage INNER JOIN extra ON stage.id = extra.stage WHERE stage.travel = ? ORDER BY stage.chronology");
                            $commande->bind_param("s", $idVoyage);
                            $commande->execute();
                            $commande->bind_result($textoption, $chronology, $image, $idExtra, $extraprice);
                            $extras = [];
                            while($commande->fetch()){
                                $extras[] = ["id"=>$idExtra, "text"=>$textoption, "image"=>$image, "price"=>$extraprice];
                            }
                            $commande->close();
                            
                            foreach($extras as $extra){
                                echo '<img class="option" src="'.$extra["image"].'" height="200" width="480"</br></br>';
                                echo '<input type="checkbox" name="extra'.$extra["id"].'"><label for="extra'.$extra["id"].'">'.$extra["text"].'. Prix (en €): '.$extra["price"].'</label>';
                            }
                        }
                        else{
                            echo "Pas d'option";
                        }
                    ?>
                    <br/><button class="button1" type="reset">Reset</button>
                    <button class="button1" type="submit">Valider</button>
            </div>
        </form>
    </main>

    <?php require('phpFrequent/footer.php'); 
    ?>
</body>
</html>