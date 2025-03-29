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
        "imageDetail" => "img/desert-detail.jpg"
    ],
    "Antarctique" => [
        "image" => "img/Pingouin.webp",
        "alt" => "Antarctique",
        "description" => "Partez à la découverte en Antarctique, où les pingouins règnent en maîtres !",
        "details" => "L'Antarctique est un lieu magique où la faune est incroyable. Vous verrez des colonies de pingouins, des paysages glacés, et vivrez des aventures exceptionnelles.",
        "price" => "2500€",
        "dates" => "Décembre - Mars",
        "activities" => "Observation des pingouins, excursions en bateau, visites de stations scientifiques.",
        "imageDetail" => "img/antarctica-detail.jpg"
    ],
    "Africa" => [
        "image" => "img/Africa.jpg",
        "alt" => "Africa",
        "description" => "Plongez au cœur de la savane africaine pour un safari inoubliable !",
        "details" => "Venez découvrir les majestueux animaux de la savane, des lions aux éléphants. C'est un voyage au plus près de la nature dans un environnement spectaculaire.",
        "price" => "1800€",
        "dates" => "Juillet - Septembre",
        "activities" => "Safari en jeep, visites de réserves naturelles, nuit sous les étoiles.",
        "imageDetail" => "img/africa-detail.jpg"
    ]
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
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <title>Détails du Voyage</title>
    <link rel="stylesheet" href="css/sejours.css">
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    
    <main>
        <div class="contenu">
            <h1>Vue détaillée du voyage: <?= htmlspecialchars($sejour['alt']) ?></h1>
            <div class="detail-voyage">
                <img src="<?= $sejour['imageDetail'] ?>" alt="<?= $sejour['alt'] ?>" class="image-detail" />
                <div class="info-voyage">
                    <h2>Description</h2>
                    <p><?= $sejour['details'] ?></p>
                    
                    <h3>Prix: <?= $sejour['price'] ?></h3>
                    <h4>Dates Disponibles: <?= $sejour['dates'] ?></h4>
                    
                    <h4>Activités proposées:</h4>
                    <ul>
                        <?php
                        // Afficher les activités
                        $activities = explode(", ", $sejour['activities']);
                        foreach ($activities as $activity) {
                            echo "<li>$activity</li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <br>
            <a href="sejours.php" class="btn-back">Retour aux séjours</a>
        </div>
    </main>

    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
