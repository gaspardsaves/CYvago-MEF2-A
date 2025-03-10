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
    <link rel="stylesheet" href="css/sejours.css">
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
                <div class="image-interactive">
                    <img class="sejour" src="img/Desert.webp" alt="Desert" height="200" width="200">
                    <div class="description">Partez pour une aventure inoubliable à dos de chameau à travers des paysages désertiques à couper le souffle. Traversez des dunes dorées sous un ciel infini, profitez du silence apaisant du désert et découvrez la culture nomade autour d’un thé traditionnel.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Pingouin.webp" alt="Antarctique" height="200" width="200">
                    <div class="description">Partez à la découverte en Antarctique, où les pingouins règnent en maîtres ! Explorez des paysages enneigés spectaculaires, observez ces adorables oiseaux glisser sur la glace et plonger dans les eaux cristallines.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Africa.jpg" alt="Africa" height="200" width="200">
                    <div class="description">Plongez au cœur de la savane africaine pour un safari inoubliable ! Partez à la rencontre des lions majestueux, des éléphants imposants, des girafes élégantes et des troupeaux de zèbres sous un ciel doré.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Dauphin3.jpg" alt="Costa Rica" height="200" width="200">
                    <div class="description">Partez pour une aventure magique au cœur des océans et nagez aux côtés de dauphins joueurs dans des eaux cristallines. Observez-les sauter et danser avec les vagues sous un soleil éclatant. Une expérience inoubliable entre nature, liberté et émerveillement marin.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Panda2.jpg" alt="Chine" height="200" width="200">
                    <div class="description">Partez à la découverte des paysages enchanteurs de la Chine et observez de près les adorables pandas dans leur habitat naturel. Explorez des forêts de bambous verdoyantes, visitez des sanctuaires dédiés à leur préservation et vivez une expérience unique au cœur de la nature.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Licorne.webp" alt="Licorne" height="200" width="200">
                    <div class="description">Plongez dans un monde féerique où des licornes majestueuses errent à travers des prairies enchantées. Vivez une aventure magique au milieu de paysages féeriques, entre forêts mystiques et rivières étincelantes, aux côtés de ces créatures légendaires.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Yeti.jpg" alt="Everest" height="200" width="200">
                    <div class="description">Embarquez pour une aventure palpitante à la recherche du légendaire Yéti dans les montagnes himalayennes. Explorez des sentiers enneigés, découvrez des paysages à couper le souffle et suivez les mystères de la créature mythique au cœur de la neige et des brumes.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Dragon2.jpg" alt="Dragon" height="200" width="200">
                    <div class="description">Envolez-vous pour une aventure épique à dos de dragon, traversant des cieux infinis et des paysages fantastiques ! Explorez des montagnes majestueuses, des forêts mystiques et des vallées cachées, tout en ressentant la puissance et la liberté de votre compagnon légendaire.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Capybara.avif" alt="Capybara" height="200" width="200">
                    <div class="description">Partez à l’aventure dans les marais et rivières d’Amérique du Sud pour rencontrer les adorables capybaras ! Observez ces paisibles rongeurs se prélasser au soleil, nager en groupe et interagir avec d’autres animaux exotiques. Une immersion unique au cœur de la nature sauvage</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Kangourou.jpg" alt="Australie" height="200" width="200">
                    <div class="description">Venez explorer l’outback australien et rencontrer des kangourous dans leur habitat naturel ! Sautez d’une aventure à l’autre à travers des paysages sauvages.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/Yaks.jpeg" alt="Mongolie" height="200" width="200">
                    <div class="description">Partez à l'aventure dans les majestueuses montagnes chinoises à dos de yak ! Traversez des paysages spectaculaires, entre pics enneigés et vallées verdoyantes, et découvrez la culture locale au rythme de ces animaux puissants.</div>
                </div>
                <div class="image-interactive">
                    <img class="sejour" src="img/chewbacca.jpg" alt="Chewbaca" height="200" width="200">
                    <div class="description">Passez une journée inoubliable aux côtés de Chewbacca, le Wookiee le plus fiable de la galaxie, en train de gérer des portefeuilles d'investissement ! Il vous guide à travers des stratégies financières intergalactiques, et en offrant une expérience unique de gestion de patrimoine.</div>
                </div>
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
                                <label>Antartique</label>
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