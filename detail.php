<?php
include 'session.php';
include 'database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Stocker les données du formulaire en session pour les récupérer après connexion
    $_SESSION['pending_booking'] = $_POST;
    
    // Rediriger vers la page de connexion
    header("Location: connexion.php?redirect=connexion.php");
    exit;
}

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
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script type='text/javascript' src='js/updateprice.js?v=<?php echo time(); ?>'></script>
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
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
                    <h4>Saison(s) recommandée(s) : <?= $sejour['season'] ?></h4>
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
            
            <section class="base-info">
                    
            </section>

            <!-- Section de personnalisation des étapes et options (pleine largeur) -->
            <section class="activities-section">
                <h2>Personnalisez votre voyage</h2>
                
                <form action="recapvoyage.php" method="POST" id="bookingForm">
                    <input type="hidden" name="destination" value="<?= htmlspecialchars($sejour['alt']) ?>">
                    <input type="hidden" name="description" value="<?= htmlspecialchars($sejour['description']) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($sejour['price']) ?>">
                    <input type="hidden" name="id" value="<?= $sejour['id'] ?>">
                    <input type="hidden" name="total_price" id="hiddenTotalPrice" value="<?= $sejour['price'] ?>">
                    <input type="hidden" name="travel_id" value="<?= $sejour['id'] ?>">
                    <input type="hidden" name="travel_title" value="<?= htmlspecialchars($sejour['alt']) ?>">
                    <input type="hidden" name="travel_base_price" value="<?= $sejour['price'] ?>">
                    <input type="hidden" name="travel_duration" value="<?= $sejour['nbrdays'] ?>">
                    
                    <div class="booking-details">
                        <div class="booking-row">
                            <label for="people">Nombre de personnes pour le voyage :</label>
                            <div class="select-container">
                                <select id="people" name="people" required>
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?> <?= $i > 1 ? 'personnes' : 'personne' ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="booking-row">
                            <label for="date">Date de départ :</label>
                            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <h3>Étapes de votre voyage</h3>
                    
                    <?php
                    // Regrouper les activités par ID d'étape
                    $stages = [];
                    foreach ($sejour['activities'] as $activity) {
                        $stageId = $activity['id'];
                        
                        if (!isset($stages[$stageId])) {
                            $stages[$stageId] = [
                                'name' => $activity['name'],
                                'image' => $activity['image'],
                                'options' => []
                            ];
                        }
                        
                        if (!empty($activity['extra_id']) && !empty($activity['extra_price'])) {
                            $stages[$stageId]['options'][] = [
                                'extra_id' => $activity['extra_id'],
                                'extra_title' => $activity['extra_title'],
                                'extra_price' => $activity['extra_price']
                            ];
                        }
                    }
                    ?>
                    
                    <div class="stages-container">
                        <?php foreach ($stages as $stageId => $stage): ?>
                            <div class="stage-card">
                                <div class="stage-header">
                                    <h4><?= htmlspecialchars($stage['name']) ?></h4>
                                </div>
                                
                                <div class="stage-content">
                                    <div class="stage-image-container">
                                        <?php if (!empty($stage['image'])): ?>
                                            <img src="<?= $stage['image'] ?>" alt="<?= htmlspecialchars($stage['name']) ?>" class="stage-image" />
                                        <?php else: ?>
                                            <img src="img/activity-default.jpg" alt="Activité" class="stage-image" />
                                        <?php endif; ?>
                                        <div class="stage-included">
                                            <span class="included-tag">Inclus dans le forfait</span>
                                        </div>
                                    </div>
                                    
                                    <?php if (!empty($stage['options'])): ?>
                                        <div class="options-container">
                                            <h5>Options disponibles pour cette étape :</h5>
                                            
                                            <?php foreach ($stage['options'] as $option): ?>
                                                <div class="option-item">
                                                    <div class="option-info">
                                                        <span class="option-title"><?= htmlspecialchars($option['extra_title']) ?></span>
                                                        <span class="option-description">
                                                            <?= !empty($option['extra_description']) ? htmlspecialchars($option['extra_description']) : 'Option supplémentaire' ?>
                                                        </span>
                                                        <span class="option-price">+<?= $option['extra_price'] ?>€/pers.</span>
                                                    </div>
                                                    <div class="option-controls">
                                                        <div class="option-people">
                                                            <select name="extra_people_<?= $option['extra_id'] ?>" 
                                                                    class="people-select" 
                                                                    data-extra-id="<?= $option['extra_id'] ?>"
                                                                    data-price="<?= $option['extra_price'] ?>">
                                                                <option value="0">0 pers.</option>
                                                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                                                    <option value="<?= $i ?>"><?= $i ?> pers.</option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="no-options">
                                            <p>Aucune option disponible pour cette étape</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Résumé du prix -->
                    <div class="price-summary">
                        <div class="total-row">
                            <div class="total-label">Forfait de base <span id="perPersonPrice" class="per-person-note"></span></div>
                            <div class="total-price base-price-display"><?= $sejour['price'] ?>€</div>
                        </div>
                        
                        <div class="total-row">
                            <div class="total-label">Options personnalisées</div>
                            <div class="total-price options-price">0€</div>
                        </div>
                        
                        <div class="option-list" id="selectedOptions">
                            <!-- Les options sélectionnées s'afficheront ici en détail -->
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