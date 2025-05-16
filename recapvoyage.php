<?php
include 'session.php';
include 'database.php';

// Vérifier si l'utilisateur est connecté
/*
if (!isset($_SESSION['user_id'])) {
    // Stocker les données du formulaire en session pour les récupérer après connexion
    $_SESSION['pending_booking'] = $_POST;
    
    // Rediriger vers la page de connexion
    header('Location: connexion.php?redirect=recapvoyage.php');
    exit;
}*/

// Récupérer les données du formulaire par POST plutôt que GET pour plus de sécurité
$travel_id = filter_input(INPUT_POST, 'travel_id', FILTER_SANITIZE_NUMBER_INT);
$travel_title = filter_input(INPUT_POST, 'travel_title', FILTER_SANITIZE_SPECIAL_CHARS);
$travel_base_price = filter_input(INPUT_POST, 'travel_base_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$total_price = filter_input(INPUT_POST, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$people = filter_input(INPUT_POST, 'people', FILTER_SANITIZE_NUMBER_INT);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);

// Si on reçoit toujours par GET (compatibilité), convertir en variables POST
if (!$travel_id && isset($_GET['id'])) {
    $travel_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $travel_title = filter_input(INPUT_GET, 'destination', FILTER_SANITIZE_SPECIAL_CHARS);
    $travel_base_price = filter_input(INPUT_GET, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total_price = filter_input(INPUT_GET, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $people = filter_input(INPUT_GET, 'people', FILTER_SANITIZE_NUMBER_INT);
    $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
}

// Vérifier si on a les données nécessaires
if (!$travel_id || !$travel_title || !$travel_base_price || !$people || !$date) {
    echo "<div class='error'>Informations de réservation incomplètes.</div>";
    exit;
}

// Collecter toutes les options sélectionnées (où extra_people_X > 0)
$selected_options = [];
foreach ($_POST as $key => $value) {
    if (preg_match('/^extra_people_(\d+)$/', $key, $matches) && intval($value) > 0) {
        $extra_id = $matches[1];
        $num_people = intval($value);
        $selected_options[$extra_id] = $num_people;
    }
}

// Idem pour les données GET si nécessaire
if (empty($selected_options)) {
    foreach ($_GET as $key => $value) {
        if (preg_match('/^extra_people_(\d+)$/', $key, $matches) && intval($value) > 0) {
            $extra_id = $matches[1];
            $num_people = intval($value);
            $selected_options[$extra_id] = $num_people;
        }
    }
}

// Récupérer les détails des options choisies
$option_details = [];
if (!empty($selected_options)) {
    $option_ids = array_keys($selected_options);
    $placeholders = implode(',', array_fill(0, count($option_ids), '?'));
    
    $query = "SELECT e.id, e.title, e.price, s.text as stage_name 
              FROM extra e 
              JOIN stage s ON e.stage = s.id 
              WHERE e.id IN ($placeholders)";
    
    $stmt = $database->prepare($query);
    
    // Créer un tableau de paramètres pour bind_param
    $types = str_repeat('i', count($option_ids));
    $params = array($types);
    foreach ($option_ids as $id) {
        $params[] = $id;
    }
    
    // Appliquer les paramètres à bind_param
    call_user_func_array(array($stmt, 'bind_param'), $params);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $option_details[$row['id']] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'price' => $row['price'],
            'stage_name' => $row['stage_name'],
            'num_people' => $selected_options[$row['id']]
        ];
    }
    $stmt->close();
}

// Récupérer les informations du voyage
$stmt = $database->prepare("SELECT title, text, image, price, nbrdays FROM travel WHERE id = ?");
$stmt->bind_param("i", $travel_id);
$stmt->execute();
$stmt->bind_result($title, $description, $image, $price, $nbrdays);
$stmt->fetch();
$stmt->close();

// Calculer le montant total
$base_total = $price * $people;
$options_total = 0;
foreach ($option_details as $option) {
    $options_total += $option['price'] * $option['num_people'];
}
$total_amount = $base_total + $options_total;

// Si le formulaire est soumis pour confirmer la réservation
if (isset($_POST['confirm_booking']) && $_POST['confirm_booking'] == 1) {
    // Démarrer une transaction
    $database->begin_transaction();
    
    try {
        // Insérer la réservation
        $stmt = $database->prepare("INSERT INTO booking (user, travel, departuredate, nbrperson) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $_SESSION['user_id'], $travel_id, $date, $people);
        $stmt->execute();
        $booking_id = $database->insert_id;
        $stmt->close();
        
        // Insérer les options choisies
        if (!empty($selected_options)) {
            $stmt = $database->prepare("INSERT INTO engagement (booking, extra, nbrperson) VALUES (?, ?, ?)");
            
            foreach ($selected_options as $extra_id => $num_people) {
                $stmt->bind_param("iii", $booking_id, $extra_id, $num_people);
                $stmt->execute();
            }
            
            $stmt->close();
        }
        
        // Valider la transaction
        $database->commit();
        
        // Rediriger vers la page de paiement
        header("Location: reservation.php?booking_id=$booking_id");
        exit;
        
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $database->rollback();
        echo "<div class='error'>Erreur lors de l'enregistrement de la réservation: " . $e->getMessage() . "</div>";
    }
}
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
    <title>ZanimoTrip Récapitulatif</title>
    <link rel="stylesheet" href="css/recapvoyage.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js"></script>
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    <main>
    <div class="recap-container">
            <div class="recap-header">
                <h1>Récapitulatif de votre réservation</h1>
                <p>Veuillez vérifier les détails de votre voyage avant de confirmer</p>
            </div>
            
            <div class="trip-details">
                <div class="trip-image">
                    <?php if (!empty($image)): ?>
                        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($title) ?>">
                    <?php else: ?>
                        <img src="img/activity-default.jpg" alt="Voyage">
                    <?php endif; ?>
                </div>
                
                <div class="trip-info">
                    <h2><?= htmlspecialchars($title) ?></h2>
                    <p><?= htmlspecialchars($description) ?></p>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre de personnes:</span>
                        <span><?= $people ?> <?= $people > 1 ? 'personnes' : 'personne' ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Date de départ:</span>
                        <span><?= date('d/m/Y', strtotime($date)) ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Durée :</span>
                        <span><?= $nbrdays ?> jours</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Prix par personne:</span>
                        <span><?= number_format($price, 2, ',', ' ') ?>€</span>
                    </div>
                </div>
            </div>
            
            <?php if (!empty($option_details)): ?>
                <div class="options-section">
                    <h3>Options sélectionnées</h3>
                    
                    <?php foreach ($option_details as $option): ?>
                        <div class="option-item">
                            <div class="option-details">
                                <div class="option-title"><?= htmlspecialchars($option['title']) ?></div>
                                <div class="option-stage">Étape: <?= htmlspecialchars($option['stage_name']) ?></div>
                                <div class="option-price"><?= number_format($option['price'], 2, ',', ' ') ?>€ par personne</div>
                            </div>
                            <div class="option-quantity">
                                <?= $option['num_people'] ?> <?= $option['num_people'] > 1 ? 'personnes' : 'personne' ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="options-section">
                    <h3>Aucune option sélectionnée</h3>
                    <p>Vous n'avez sélectionné aucune option supplémentaire pour ce voyage.</p>
                </div>
            <?php endif; ?>
            
            <div class="total-section">
                <div class="total-row">
                    <span>Forfait de base (<?= number_format($price, 2, ',', ' ') ?>€ × <?= $people ?> personnes)</span>
                    <span><?= number_format($base_total, 2, ',', ' ') ?>€</span>
                </div>
                
                <?php if ($options_total > 0): ?>
                    <div class="total-row">
                        <span>Options sélectionnées</span>
                        <span><?= number_format($options_total, 2, ',', ' ') ?>€</span>
                    </div>
                <?php endif; ?>
                
                <div class="total-row final">
                    <span>TOTAL</span>
                    <span><?= number_format($total_amount, 2, ',', ' ') ?>€</span>
                </div>
            </div>
            
            <div class="buttons-container">
                <button class="button1" onclick="window.history.back();">Retour</button>
                
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <!-- Transférer toutes les données reçues dans des champs cachés -->
                    <input type="hidden" name="travel_id" value="<?= htmlspecialchars($travel_id) ?>">
                    <input type="hidden" name="travel_title" value="<?= htmlspecialchars($travel_title) ?>">
                    <input type="hidden" name="travel_base_price" value="<?= htmlspecialchars($travel_base_price) ?>">
                    <input type="hidden" name="people" value="<?= htmlspecialchars($people) ?>">
                    <input type="hidden" name="date" value="<?= htmlspecialchars($date) ?>">
                    
                    <?php foreach ($selected_options as $extra_id => $num_people): ?>
                        <input type="hidden" name="extra_people_<?= $extra_id ?>" value="<?= htmlspecialchars($num_people) ?>">
                    <?php endforeach; ?>
                    
                    <input type="hidden" name="confirm_booking" value="1">
                    <button type="submit" class="button1">Confirmer et payer</button>
                </form>
            </div>
        </div>
    </main>
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>