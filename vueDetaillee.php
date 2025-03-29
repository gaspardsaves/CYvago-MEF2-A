<?php 
// Récupérer le paramètre 'destination' depuis l'URL
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';

// Définir les informations des voyages
$sejours = [
    "Desert" => [
        "image" => "img/Desert.webp",
        "alt" => "Desert",
        "description" => "Partez pour une aventure inoubliable à dos de chameau à travers des paysages désertiques.",
        "details" => "Explorez les vastes étendues du désert et admirez les magnifiques dunes. C'est une expérience unique de randonnée à dos de chameau, avec des nuits passées sous un ciel étoilé.",
        "price" => "1200€",
        "dates" => "Juin - Août",
        "activities" => "Randonnée à dos de chameau, nuit sous tente, photographie du désert, exploration des oasis.",
        "imageDetail" => "img/desert-detail.jpg",
        "hotel" => "Hôtel Sahara Lux", 
        "hotelImage" => "img/hotel-desert.jpg",
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Antarctique" => [
        "image" => "img/Pingouin.webp",
        "alt" => "Antarctique",
        "description" => "Partez à la découverte en Antarctique, où les pingouins règnent en maîtres !",
        "details" => "L'Antarctique est un lieu magique où la faune est incroyable. Vous verrez des colonies de pingouins, des paysages glacés, et vivrez des aventures exceptionnelles.",
        "price" => "2500€",
        "dates" => "Décembre - Mars",
        "activities" => "Observation des pingouins, excursions en bateau, visites de stations scientifiques.",
        "imageDetail" => "img/antarctica-detail.jpg",
        "hotel" => "Polar Lodge", 
        "hotelImage" => "img/hotel-antarctique.jpg",
        "meals" => "Tous les repas inclus"
    ],
    "Africa" => [
        "image" => "img/Africa.jpg",
        "alt" => "Africa",
        "description" => "Plongez au cœur de la savane africaine pour un safari inoubliable !",
        "details" => "Venez découvrir les majestueux animaux de la savane, des lions aux éléphants. C'est un voyage au plus près de la nature dans un environnement spectaculaire.",
        "price" => "1800€",
        "dates" => "Juillet - Septembre",
        "activities" => "Safari en jeep, visites de réserves naturelles, nuit sous les étoiles.",
        "imageDetail" => "img/africa-detail.jpg",
        "hotel" => "Safari Lodge", 
        "hotelImage" => "img/hotel-africa.jpg",
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Costa Rica" => [
        "image" => "img/Dauphin3.jpg",
        "alt" => "Costa Rica",
        "description" => "Partez pour une aventure magique au cœur des océans et nagez aux côtés de dauphins joueurs.",
        "details" => "Le Costa Rica vous offre une expérience unique en mer, avec des dauphins, des plages et des paysages à couper le souffle.",
        "price" => "2200€",
        "dates" => "Mai - Août",
        "activities" => "Nage avec les dauphins, exploration sous-marine, visites de plages exotiques.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Costa Rica Resort", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Petit déjeuner inclus"
    ],
    "Chine" => [
        "image" => "img/Panda2.jpg",
        "alt" => "Chine",
        "description" => "Partez à la découverte des paysages enchanteurs de la Chine et observez de près les adorables pandas.",
        "details" => "Rencontrez les pandas géants dans leur habitat naturel et explorez la culture chinoise.",
        "price" => "2100€",
        "dates" => "Septembre - Novembre",
        "activities" => "Visite de réserves de pandas, exploration de la Grande Muraille.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "China Grand Hotel", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Tous les repas inclus"
    ],
    "Licorne" => [
        "image" => "img/Licorne.webp",
        "alt" => "Licorne",
        "description" => "Plongez dans un monde féerique où des licornes majestueuses errent à travers des prairies enchantées.",
        "details" => "Un voyage féérique où vous vivrez une expérience magique au milieu de créatures mythiques.",
        "price" => "3500€",
        "dates" => "Mars - Mai",
        "activities" => "Promenades dans les prairies, rencontres avec les licornes.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Enchanted Resort", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Everest" => [
        "image" => "img/Yeti.jpg",
        "alt" => "Everest",
        "description" => "Embarquez pour une aventure palpitante à la recherche du légendaire Yéti dans l'Himalaya.",
        "details" => "Escaladez les pentes de l'Everest et explorez la légende du Yéti à travers des paysages majestueux.",
        "price" => "3000€",
        "dates" => "Septembre - Novembre",
        "activities" => "Expéditions, exploration du sommet, recherche du Yéti.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Everest Base Camp Hotel", 
        "hotelImage" => "", // Supprimé l'image
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
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Dragon’s Nest Hotel", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Tous les repas inclus"
    ],
    "Capybara" => [
        "image" => "img/Capybara.avif",
        "alt" => "Capybara",
        "description" => "Partez à la rencontre des capybaras en Amérique du Sud.",
        "details" => "Découvrez ces animaux fascinants dans leur habitat naturel en Amérique du Sud.",
        "price" => "1500€",
        "dates" => "Juin - Septembre",
        "activities" => "Observation des capybaras, exploration de la jungle.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Jungle Resort", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Petit déjeuner et dîner inclus"
    ],
    "Australie" => [
        "image" => "img/Kangourou.jpg",
        "alt" => "Australie",
        "description" => "Explorez l’outback australien et rencontrez des kangourous dans leur habitat naturel !",
        "details" => "Aventurez-vous dans l'outback australien et observez les kangourous en liberté.",
        "price" => "1900€",
        "dates" => "Décembre - Février",
        "activities" => "Randonnée, rencontre avec la faune australienne.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Outback Lodge", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Petit déjeuner inclus"
    ],
    "Mongolie" => [
        "image" => "img/Yaks.jpeg",
        "alt" => "Mongolie",
        "description" => "Partez à l'aventure dans les majestueuses montagnes chinoises à dos de yak !",
        "details" => "Explorez les montagnes de Mongolie, une expérience unique à dos de yak.",
        "price" => "2200€",
        "dates" => "Mai - Juillet",
        "activities" => "Randonnée à dos de yak, exploration des montagnes.",
        "imageDetail" => "", // Supprimé l'image
        "hotel" => "Mongolian Lodge", 
        "hotelImage" => "", // Supprimé l'image
        "meals" => "Petit déjeuner et dîner inclus"
    ],
];

// Vérifier si la destination existe dans l'array
if (array_key_exists($destination, $sejours)) {
    $sejour = $sejours[$destination];
} else {
    // Si la destination n'existe pas, afficher une erreur
    echo "<p>Voyage non trouvé.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sejours.css">
    <title>Détails du Voyage</title>
    <link rel="stylesheet" href="css/vueDetaillee.css">
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    
    <main>
        <div class="contenu">
            <h1>Vue détaillée du voyage: <?= htmlspecialchars($sejour['alt']) ?></h1>
            <div class="detail-voyage">
                <?php if ($sejour['imageDetail']): ?>
                    <img src="<?= $sejour['imageDetail'] ?>" alt="<?= $sejour['alt'] ?>" class="image-detail" />
                <?php endif; ?>
                <div class="info-voyage">
                    <h2>Description</h2>
                    <p><?= $sejour['details'] ?></p>
                    
                    <h3>Prix: <?= $sejour['price'] ?></h3>
                    <h4>Dates Disponibles: <?= $sejour['dates'] ?></h4>
                    
                    <h4>Activités proposées:</h4>
                    <ul>
                        <?php
                        $activities = explode(", ", $sejour['activities']);
                        foreach ($activities as $activity) {
                            echo "<li>$activity</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="hotel-section">
                <h2>Hébergement</h2>
                <?php if ($sejour['hotelImage']): ?>
                    <img src="<?= $sejour['hotelImage'] ?>" alt="Hôtel" class="hotel-image" />
                <?php endif; ?>
                <p><strong>Hôtel:</strong> <?= $sejour['hotel'] ?></p>
            </div>

            <div class="meals-section">
                <h2>Restauration</h2>
                <p><?= $sejour['meals'] ?></p>
            </div>

            <br>
            <a href="sejours.php" class="btn-back">Retour aux séjours</a>
        </div>
    </main>

    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
