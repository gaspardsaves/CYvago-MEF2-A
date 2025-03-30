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
                $search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

                $sejours = [
                    ["image" => "img/Desert.webp", "alt" => "Desert", "description" => "Partez pour une aventure inoubliable à dos de chameau à travers des paysages désertiques."],
                    ["image" => "img/Pingouin.webp", "alt" => "Antarctique", "description" => "Partez à la découverte en Antarctique, où les pingouins règnent en maîtres !"],
                    ["image" => "img/Africa.jpg", "alt" => "Africa", "description" => "Plongez au cœur de la savane africaine pour un safari inoubliable !"],
                    ["image" => "img/Dauphin3.jpg", "alt" => "Costa Rica", "description" => "Partez pour une aventure magique au cœur des océans et nagez aux côtés de dauphins joueurs."],
                    ["image" => "img/Panda2.jpg", "alt" => "Chine", "description" => "Partez à la découverte des paysages enchanteurs de la Chine et observez de près les adorables pandas."],
                    ["image" => "img/Licorne.webp", "alt" => "Licorne", "description" => "Plongez dans un monde féerique où des licornes majestueuses errent à travers des prairies enchantées."],
                    ["image" => "img/Yeti.jpg", "alt" => "Everest", "description" => "Embarquez pour une aventure palpitante à la recherche du légendaire Yéti dans l'Himalaya."],
                    ["image" => "img/Dragon2.jpg", "alt" => "Dragon", "description" => "Envolez-vous pour une aventure épique à dos de dragon dans un monde fantastique."],
                    ["image" => "img/Capybara.avif", "alt" => "Capybara", "description" => "Partez à la rencontre des capybaras en Amérique du Sud."],
                    ["image" => "img/Kangourou.jpg", "alt" => "Australie", "description" => "Explorez l’outback australien et rencontrez des kangourous dans leur habitat naturel !"],
                    ["image" => "img/Yaks.jpeg", "alt" => "Mongolie", "description" => "Partez à l'aventure dans les majestueuses montagnes chinoises à dos de yak !"],
                    ["image" => "img/chewbacca.jpg", "alt" => "Chewbacca", "description" => "Passez une journée inoubliable aux côtés de Chewbacca, le Wookiee légendaire."]
                ];

                $found = false;

                foreach ($sejours as $sejour) {
                    if ($search === '' || stripos($sejour["alt"], $search) !== false || stripos($sejour["description"], $search) !== false) {
                        $found = true;
                        echo '
                        <div class="image-interactive">
                            <a href="vueDetaillee.php?destination=' . urlencode($sejour["alt"]) .'">;
                                <img class="sejour" src="' . $sejour["image"] . '" alt="' . $sejour["alt"] . '" height="200" width="200">
                            </a>
                            <div class="description"><span>' . $sejour["description"] . '</span></div>
                            <a href="personnalisationVoyage.php?destination=' . urlencode($sejour["alt"]) . '&description=' . urlencode($sejour["description"]) .'" class="lien-blanc">Personnalisation</a>
                        </div>';
                    }
                }

                if (!$found) {
                    echo '<p>Aucun séjour ne correspond à votre recherche.</p>';
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
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>  