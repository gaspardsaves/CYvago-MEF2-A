<?php 

$destination = isset($_GET['destination']) ? $_GET['destination'] : '';

$sejours = [
    "Desert" => [
        "image" => "img/trav/desert2.jpg",
        "alt" => "Desert",
        "description" => "Partez pour une aventure inoubliable à dos de chameau à travers des paysages désertiques.",
        "details" => "Explorez les vastes étendues du désert et admirez les magnifiques dunes. C'est une expérience unique de randonnée à dos de chameau, avec des nuits passées sous un ciel étoilé.",
        "price" => "1200",
        "dates" => "Juin - Août",
        "activities" => [
            ["name" => "Randonnée à dos de chameau", "image" => "img/trav/randoChameau.jpg"],
            ["name" => "Nuit sous tente", "image" => "img/trav/nuitTenteDesert.jpg"],
            ["name" => "Photographie du désert", "image" => "img/trav/photographieDesert.png"],
            ["name" => "Exploration des oasis", "image" => "img/trav/exploOasis.jpg"]
        ],
        "imageDetail" => "img/trav/desert2.jpg",
        "hotel" => "Hôtel Sahara Lux", 
        "hotelImage" => "img/trav/HotelDesert.jpg",
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Antarctique" => [
        "image" => "img/trav/Antarctique.jpg",
        "alt" => "Antarctique",
        "description" => "Partez à la découverte en Antarctique, où les pingouins règnent en maîtres !",
        "details" => "L'Antarctique est un lieu magique où la faune est incroyable. Vous verrez des colonies de pingouins, des paysages glacés, et vivrez des aventures exceptionnelles.",
        "price" => "2500",
        "dates" => "Décembre - Mars",
        "activities" => [
            ["name" => "Observation des pingouins", "image" => "img/trav/observationPingouin.jpg"],
            ["name" => "Excursions en bateau", "image" => "img/trav/excursionBateau.jpg"],
            ["name" => "Visites de stations scientifiques", "image" => "img/trav/stationScientifiques.jpeg"]
        ],
        "imageDetail" => "img/trav/Antarctique.jpg",
        "hotel" => "Polar Lodge", 
        "hotelImage" => "img/trav/HotelAntarctique.jpg",
        "meals" => "Tous les repas inclus"
    ],
    "Africa" => [
        "image" => "img/trav/afrique.jpg",
        "alt" => "Africa",
        "description" => "Plongez au cœur de la savane africaine pour un safari inoubliable !",
        "details" => "Venez découvrir les majestueux animaux de la savane, des lions aux éléphants. C'est un voyage au plus près de la nature dans un environnement spectaculaire.",
        "price" => "1800",
        "dates" => "Juillet - Septembre",
        "activities" => [
            ["name" => "Safari en jeep", "image" => "img/trav/safariJeep.jpeg"],
            ["name" => "Visites de réserves naturelles", "image" => "img/trav/visiteReserve.jpeg"],
            ["name" => "Nuit sous les étoiles", "image" => "img/trav/NuitEtoile.jpeg"]
        ],
        "imageDetail" => "img/trav/afrique.jpg",
        "hotel" => "Safari Lodge", 
        "hotelImage" => "img/trav/HotelAfrique.jpg",
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Costa Rica" => [
        "image" => "img/Dauphin3.jpg",
        "alt" => "Costa Rica",
        "description" => "Partez pour une aventure magique au cœur des océans et nagez aux côtés de dauphins joueurs.",
        "details" => "Le Costa Rica vous offre une expérience unique en mer, avec des dauphins, des plages et des paysages à couper le souffle.",
        "price" => "2200",
        "dates" => "Mai - Août",
        "activities" => "Nage avec les dauphins, exploration sous-marine, visites de plages exotiques.",
        "imageDetail" => "", 
        "hotel" => "Costa Rica Resort", 
        "hotelImage" => "", 
        "meals" => "Petit déjeuner inclus"
    ],
    "Chine" => [
        "image" => "img/Panda2.jpg",
        "alt" => "Chine",
        "description" => "Partez à la découverte des paysages enchanteurs de la Chine et observez de près les adorables pandas.",
        "details" => "Rencontrez les pandas géants dans leur habitat naturel et explorez la culture chinoise.",
        "price" => "2100",
        "dates" => "Septembre - Novembre",
        "activities" => "Visite de réserves de pandas, exploration de la Grande Muraille.",
        "imageDetail" => "", 
        "hotel" => "China Grand Hotel", 
        "hotelImage" => "",
        "meals" => "Tous les repas inclus"
    ],
    "Licorne" => [
        "image" => "img/Licorne.webp",
        "alt" => "Licorne",
        "description" => "Plongez dans un monde féerique où des licornes majestueuses errent à travers des prairies enchantées.",
        "details" => "Un voyage féérique où vous vivrez une expérience magique au milieu de créatures mythiques.",
        "price" => "3500",
        "dates" => "Mars - Mai",
        "activities" => "Promenades dans les prairies, rencontres avec les licornes.",
        "imageDetail" => "",
        "hotel" => "Enchanted Resort", 
        "hotelImage" => "", 
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Everest" => [
        "image" => "img/Yeti.jpg",
        "alt" => "Everest",
        "description" => "Embarquez pour une aventure palpitante à la recherche du légendaire Yéti dans l'Himalaya.",
        "details" => "Escaladez les pentes de l'Everest et explorez la légende du Yéti à travers des paysages majestueux.",
        "price" => "3000",
        "dates" => "Septembre - Novembre",
        "activities" => "Expéditions, exploration du sommet, recherche du Yéti.",
        "imageDetail" => "", 
        "hotel" => "Everest Base Camp Hotel", 
        "hotelImage" => "", 
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Dragon" => [
        "image" => "img/Dragon2.jpg",
        "alt" => "Dragon",
        "description" => "Envolez-vous pour une aventure épique à dos de dragon dans un monde fantastique.",
        "details" => "Un voyage fantastique où vous partirez à la recherche de dragons et vivrez des aventures magiques.",
        "price" => "5000€",
        "dates" => "Janvier - Février",
        "activities" => "Vols à dos de dragon, explorations dans un monde magique.",
        "imageDetail" => "",
        "hotel" => "Dragon’s Nest Hotel", 
        "hotelImage" => "", 
        "meals" => "Tous les repas inclus"
    ],
    "Capybara" => [
        "image" => "img/Capybara.avif",
        "alt" => "Capybara",
        "description" => "Partez à la rencontre des capybaras en Amérique du Sud.",
        "details" => "Découvrez ces animaux fascinants dans leur habitat naturel en Amérique du Sud.",
        "price" => "1500",
        "dates" => "Juin - Septembre",
        "activities" => "Observation des capybaras, exploration de la jungle.",
        "imageDetail" => "", 
        "hotel" => "Jungle Resort", 
        "hotelImage" => "", 
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Australie" => [
        "image" => "img/Kangourou.jpg",
        "alt" => "Australie",
        "description" => "Explorez l’outback australien et rencontrez des kangourous dans leur habitat naturel !",
        "details" => "Aventurez-vous dans l'outback australien et observez les kangourous en liberté.",
        "price" => "1900",
        "dates" => "Décembre - Février",
        "activities" => "Randonnée, rencontre avec la faune australienne.",
        "imageDetail" => "", 
        "hotel" => "Outback Lodge", 
        "hotelImage" => "", 
        "meals" => "Petit déjeuner inclus"
    ],
    "Mongolie" => [
        "image" => "img/Yaks.jpeg",
        "alt" => "Mongolie",
        "description" => "Partez à l'aventure dans les majestueuses montagnes chinoises à dos de yak !",
        "details" => "Explorez les montagnes de Mongolie, une expérience unique à dos de yak.",
        "price" => "2200",
        "dates" => "Mai - Juillet",
        "activities" => "Randonnée à dos de yak, exploration des montagnes.",
        "imageDetail" => "", 
        "hotel" => "Mongolian Lodge", 
        "hotelImage" => "", 
        "meals" => "Petit déjeuner et dîner inclus"
    ],
];


if (array_key_exists($destination, $sejours)) {
    $sejour = $sejours[$destination];
} else {
    echo "<p>Voyage non trouvé.</p>";
    exit;
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
    <link rel="stylesheet" href="css/vueDetaillee.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <main>
        <h1 class="title-travel">Le voyage <?= htmlspecialchars($sejour['alt']) ?></h1>
        <div class="contenu">
            <div class="detail-voyage">
                <?php if (!empty($sejour['imageDetail'])): ?>
                    <img src="<?= $sejour['imageDetail'] ?>" alt="<?= $sejour['alt'] ?>" class="image-detail" />
                <?php endif; ?>
                <div class="info-voyage">
                    <h2> Description</h2>
                    <p><?= $sejour['details'] ?></p>
                    
                    <h3>Prix (en €): <?= $sejour['price'] ?></h3>
                    <h4>Dates Disponibles: <?= $sejour['dates'] ?></h4>
                    
                    <h4>Activités proposées:</h4>
                    <ul>
                        <?php if (!empty($sejour['activities']) && is_array($sejour['activities'])): ?>
                            <?php foreach ($sejour['activities'] as $activity): ?>
                                <li>
                                    <img src="<?= $activity['image'] ?>" alt="<?= $activity['name'] ?>" class="activity-image"/>
                                    <?= htmlspecialchars($activity['name']) ?>
                                </li>
                            <?php endforeach; ?>
                        <?php elseif (!empty($sejour['activities'])): ?>
                            <?php foreach (explode(", ", $sejour['activities']) as $activity): ?>
                                <li><?= htmlspecialchars($activity) ?></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="hotel-section">
                <h2>Hébergement</h2>
                <?php if (!empty($sejour['hotelImage'])): ?>
                    <img src="<?= $sejour['hotelImage'] ?>" alt="Hôtel" class="hotel-image" />
                <?php endif; ?>
                <p><strong>Hôtel:</strong> <?= htmlspecialchars($sejour['hotel']) ?></p>
            </div>

            <div class="meals-section">
                <h2>Restauration</h2>
                <p><?= htmlspecialchars($sejour['meals']) ?></p>
            </div>
        </div>
        <div class="button-cont">
            <form action="personnalisationVoyage.php" method="GET">
                <input type="hidden" name="destination" value="<?= htmlspecialchars($sejour['alt']) ?>">
                <input type="hidden" name="description" value="<?= htmlspecialchars($sejour['description']) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($sejour['price']) ?>">
                <button class="button1" type="submit">Personnaliser et réserver ce séjour</button>
            </form>
        </div>
    </main>

    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
