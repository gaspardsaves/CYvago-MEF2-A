<?php 
    include 'session.php';
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
    <title>Séjours</title>
    <link rel="stylesheet" href="css/sejours.css?v=<?php echo time(); ?>">
    <script src="js/tri.js?v=<?php echo time(); ?>" defer></script>
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
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
                $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

                $commande = $database->prepare("SELECT id, title, text, image, price, season FROM travel");
                $commande->execute();
                $result = $commande->get_result();
                $destinations = [];
                while ($row = $result->fetch_assoc()) {
                    $destinations[] = [
                        "id" => $row['id'], 
                        "alt" => $row['title'], 
                        "description" => $row['text'], 
                        "image" => $row['image'],
                        "price" => $row['price'],
                        "season" => $row['season']
                    ];
                }
                $commande->close();

                $found = false;

                foreach ($destinations as $destination) {
                    if ($search === '' || stripos($destination["alt"], $search) !== false || stripos($destination["description"], $search) !== false) {
                        $found = true;
                        echo '
                        <div class="image-interactive" data-title="' . strtolower(htmlspecialchars($destination["alt"])) . '" data-price="' . $destination["price"] . '" data-season="' . strtolower(htmlspecialchars($destination["season"])) . '">
                            <a href="detail.php?destination=' . urlencode($destination["alt"]) . '&id=' . $destination["id"] . '">
                                <img class="sejour" src="' . $destination["image"] . '" alt="' . $destination["alt"] . '" height="200" width="200">
                            </a>
                            <div class="description"><span>' . $destination["description"] . '</span></div>
                        </div>';
                    }
                }

                if (!$found) {
                    echo '<p>Aucune destination ne correspond à votre recherche.</p>';
                }
                ?>
            </div>
            <div class="filtrage">
                <div class="zonedefiltrage">
                    <h2 class="titre">Filtrer en fonction de vos préférences</h2>
                    <div class="titre">Saison du voyage :
                        <select name="Saison">
                            <option value="">Toutes les saisons</option>
                            <option value="printemps">Printemps</option>
                            <option value="ete">Été</option>
                            <option value="automne">Automne</option>
                            <option value="hiver">Hiver</option>
                        </select>
                    </div>
                    <br>
                    <div class="titre">Choisissez une fourchette de prix :
                        <select name="Prix">
                            <option value="">Tous les prix</option>
                            <option value="1000euro-2000euro">1000 &euro; - 2000 &euro;</option>
                            <option value="2001euro-3000euro">2001 &euro; - 3000 &euro;</option>
                            <option value="plus3000euros">> 3000 &euro;</option>
                        </select>
                    </div>
                    <br>
                    <div class="filtre">
                        <div class="titre">Filtrer par pays :</div>
                        <div class="check">
                            <table>
                                <tr>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="Country" value="China">
                                            <span class="slider"></span>
                                        </label>
                                        <label>Chine</label>
                                    </td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" name="Country" value="Australia">
                                            <span class="slider"></span>
                                        </label>
                                        <label>Australie</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="switch">
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
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>