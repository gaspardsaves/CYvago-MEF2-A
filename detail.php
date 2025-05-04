<?php
include 'session.php';
include 'database.php';

// Récupérer l'ID du voyage depuis l'URL
$id = isset($_GET['id']) ? $_GET['id'] : null;
// Récupérer aussi le nom de la destination pour la compatibilité avec l'ancien code
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';

if (!$id && $destination) {
    // Si on a seulement le nom de la destination, on essaie de récupérer l'ID
    $stmt = $database->prepare("SELECT id FROM travel WHERE title = ?");
    $stmt->bind_param("s", $destination);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();
}

if (!$id) {
    echo "<p>Voyage non trouvé.</p>";
    exit;
}

// Récupérer les informations du voyage
$stmt = $database->prepare("SELECT id, title, text, image, price, nbrdays, season, hotel, imghotel, meal FROM travel WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($travel_id, $title, $description, $image, $price, $nbrdays, $season, $hotel, $hotelImage, $meals);
$stmt->fetch();
$stmt->close();

// Récupérer les étapes et options du voyage
$activities = [];
$stmt = $database->prepare("SELECT stage.id, stage.text, stage.chronology, stage.image, extra.id as extra_id, extra.title as extra_title, extra.price as extra_price 
                           FROM stage 
                           LEFT JOIN extra ON stage.id = extra.stage 
                           WHERE stage.travel = ? 
                           ORDER BY stage.chronology");
$stmt->bind_param("i", $travel_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $activities[] = [
        "name" => $row['text'],
        "image" => $row['image'],
        "id" => $row['id'],
        "extra_id" => $row['extra_id'],
        "extra_title" => $row['extra_title'],
        "extra_price" => $row['extra_price']
    ];
}
$stmt->close();

// Construire l'objet séjour avec les données récupérées
$sejour = [
    "id" => $travel_id,
    "alt" => $title,
    "description" => $description,
    "details" => $description, // Utilisé pour la description longue
    "price" => $price,
    "nbrdays" => $nbrdays,
    "season" => $season,
    "activities" => $activities,
    "imageDetail" => $image,
    "hotel" => $hotel ?: "Hébergement standard", 
    "hotelImage" => $hotelImage ?: "",
    "meals" => $meals ?: "Repas non inclus"
];
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
    <title>Détails du Voyage</title>
    <link rel="stylesheet" href="css/detail.css?v=<?php echo time(); ?>">
    <script type='text/javascript' src='js/updateprice.js'></script>
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <main>
        <h1 class="title-travel">Le voyage <?= htmlspecialchars($sejour['alt']) ?></h1>
        
        <div class="main-container">
            <!-- Colonne principale (3/4) -->
            <section class="left-column">
                <div class="info-card">
                    <?php if (!empty($sejour['imageDetail'])): ?>
                        <img src="<?= $sejour['imageDetail'] ?>" alt="<?= $sejour['alt'] ?>" class="image-detail" />
                    <?php endif; ?>
                    
                    <h2>Description</h2>
                    <p><?= $sejour['details'] ?></p>
                    
                    <h3>Prix hors option : <span class="base-price"><?= $sejour['price'] ?></span>€</h3>
                    <h4>Nombre de jours minimum : <?= $sejour['nbrdays'] ?></h4>
                    <h4>Saison(s) de disponibilité : <?= $sejour['season'] ?></h4>
                </div>
            </section>
            
            <!-- Colonne de droite (1/4) -->
            <section class="right-column">
                <div class="info-card">
                    <h2>Hébergement</h2>
                    <?php if (!empty($sejour['hotelImage'])): ?>
                        <img src="<?= $sejour['hotelImage'] ?>" alt="Hôtel" class="hotel-image" />
                    <?php endif; ?>
                    <p><strong>Hôtel :</strong> <?= htmlspecialchars($sejour['hotel']) ?></p>
                </div>
                
                <div class="info-card">
                    <h2>Restauration</h2>
                    <p><?= htmlspecialchars($sejour['meals']) ?></p>
                </div>
            </section>
            
            <!-- Section des activités (pleine largeur) -->
            <section class="activities-section">
                <h2>Activités proposées</h2>
                
                <form action="personnalisationvoyage.php" method="GET" id="bookingForm">
                    <input type="hidden" name="destination" value="<?= htmlspecialchars($sejour['alt']) ?>">
                    <input type="hidden" name="description" value="<?= htmlspecialchars($sejour['description']) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($sejour['price']) ?>">
                    <input type="hidden" name="id" value="<?= $sejour['id'] ?>">
                    <input type="hidden" name="total_price" id="hiddenTotalPrice" value="<?= $sejour['price'] ?>">
                    
                    <div class="activities-grid">
                        <?php if (!empty($sejour['activities'])): ?>
                            <?php foreach ($sejour['activities'] as $activity): ?>
                                <div class="activity-card">
                                    <?php if (!empty($activity['image'])): ?>
                                        <img src="<?= $activity['image'] ?>" alt="<?= $activity['name'] ?>" />
                                    <?php else: ?>
                                        <img src="img/activity-default.jpg" alt="Activité" />
                                    <?php endif; ?>
                                    
                                    <div class="activity-content">
                                        <div class="activity-name"><?= htmlspecialchars($activity['name']) ?></div>
                                        
                                        <?php if (!empty($activity['extra_id']) && !empty($activity['extra_price'])): ?>
                                            <div class="switch-container">
                                                <span>Option: +<?= $activity['extra_price'] ?>€</span>
                                                <label class="switch">
                                                    <input type="checkbox" name="extra_<?= $activity['extra_id'] ?>" 
                                                           value="1" 
                                                           data-price="<?= $activity['extra_price'] ?>" 
                                                           data-name="<?= htmlspecialchars($activity['name']) ?>" 
                                                           class="option-checkbox">
                                                    <span class="slider"></span>
                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Aucune activité disponible pour ce voyage.</p>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Résumé du prix -->
                    <div class="price-summary">
                        <div class="total-row">
                            <div class="total-label">Forfait de base</div>
                            <div class="total-price base-price-display"><?= $sejour['price'] ?>€</div>
                        </div>
                        
                        <div class="total-row">
                            <div class="total-label">Options sélectionnées</div>
                            <div class="total-price options-price">0€</div>
                        </div>
                        
                        <div class="option-list" id="selectedOptions">
                            <!-- Les options sélectionnées s'afficheront ici -->
                        </div>
                        
                        <div class="total-row">
                            <div class="total-label final-total">TOTAL</div>
                            <div class="total-price final-total" id="finalTotal"><?= $sejour['price'] ?>€</div>
                        </div>
                    </div>
                    
                    <div class="button-cont">
                        <button class="button1" type="submit">Valider mes options et réserver mon séjour</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>