<?php 
    include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Titre, favicon et feuilles de style -->
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <title>Séjours</title>
    <link rel="stylesheet" href="css/sejours.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main>
    <div class="contenu">
            <div class="offre">
                <?php
                include 'database.php';
                $commande = $database->prepare("SELECT id, title, text, image FROM travel");
                $commande->execute();
                $commande->bind_result($id, $title, $text, $image);

                $destination = [];
                while ($commande->fetch()) {
                    $destination[] = ["id" =>$id, "title" => $title, "text" => $text, "image" => $image];
                }
                $commande->close();
                foreach ($destination as $voyage) {
                    echo '<form action="detail.php" method="post">';
                    echo '<input type="hidden" name="idVoyage" value="'.$voyage["id"].'" >';
                    echo '<input type="image" src="'.$voyage["image"].'" height="200" width="480" alt=" '. $voyage["title"] .'">';
                    echo '</form>';
                    //echo "<button name=\"".$voyage["title"]."\"type=\"button\"><img src=\"".$voyage["image"]."\" height =\"90\" width=\"480\" /></button>";
                }
                ?>
            </div>
            <div class="filtrage">
                <div class="zonedefiltrage">
                    <h2 class="titre">Filtrer en fonction de vos préférences</h2>
                    <div class ="titre">
                        Date : <input type="date" name="date" min="2025-02-13">
                    </div>
                    <br>
                    <div class="titre">Choisissez une fourchette de prix</div>
                        <select name="Prix">
                            <option value="100euro-1000euro">100&euro;-1000&euro;</option>
                            <option value="1000euro-1500euro">1000&euro;-1500&euro;</option>
                            <option value="1500euro-2000euro">1500&euro;-2000&euro;</option>
                            <option value="200euro-2500euro">2000&euro;-2500&euro;</option>
                        </select>
                        <br>
                    <div class="filtre">
                        <div class="titre">Filtrer par pays</div>
                        <div class="check">
                        <table>
                        <tr>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="Country" value="China">
                                    <span class="slider"></span>
                                </label>
                                   <input type="checkbox" name="Country" value="Bresil">
                                    <span class="slider"></span>
                                </label>
                                <label>Brésil</label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="Country" value="Imaginaire">
                                    <span class="slider"></span>
                                </label>
                                <label>Imaginaire</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="Country" value="Nepal">
                                    <span class="slider"></span>
                                </label>
                                <label>Népal</label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="Country" value="Antarctique">
                                    <span class="slider"></span>
                                </label>
                                <label>Antarctique</label>
                            </td>
                        </tr>
                    </table>  
                </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>