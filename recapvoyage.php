<?php
include 'session.php';
include 'database.php';

// Récupérer des données via la méthode POST
$travel_id = filter_input(INPUT_POST, 'travel_id', FILTER_SANITIZE_NUMBER_INT);
$travel_title = filter_input(INPUT_POST, 'travel_title', FILTER_SANITIZE_SPECIAL_CHARS);
$travel_base_price = filter_input(INPUT_POST, 'travel_base_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$total_price = filter_input(INPUT_POST, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$people = filter_input(INPUT_POST, 'people', FILTER_SANITIZE_NUMBER_INT);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);

// Vérification de la présence des données nécessaires
if (!$travel_id || !$travel_title || !$travel_base_price || !$people || !$date) {
    echo "<div class='error'>Informations de réservation incomplètes.</div>";
    exit;
}

// Récupération de toutes les options sélectionnées (c'est-à-dire nombre de personne > 0)
$selected_options = [];
foreach ($_POST as $key => $value) {
    if (preg_match('/^extra_people_(\d+)$/', $key, $matches) && intval($value) > 0) {
        $extra_id = $matches[1];
        $num_people = intval($value);
        $selected_options[$extra_id] = $num_people;
    }
}

// Récupération du détail des options
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

// Récupération des informations du voyage
$stmt = $database->prepare("SELECT title, text, image, price, nbrdays FROM travel WHERE id = ?");
$stmt->bind_param("i", $travel_id);
$stmt->execute();
$stmt->bind_result($title, $description, $image, $price, $nbrdays);
$stmt->fetch();
$stmt->close();

// Application d'une remise de trois pourcent sur le prix pour les clients VIP (role = 2)
$isVIP = isset($_SESSION['role']) && $_SESSION['role'] == 2;
$discountRate = $isVIP ? 0.03 : 0;
// Calcul du montant total sans remise
$base_total = $price * $people;
$options_total = 0;
foreach ($option_details as $option) {
    $options_total += $option['price'] * $option['num_people'];
}
// Calculer le sous-total (avant remise)
$subtotal = $base_total + $options_total;
// Calculer la remise si applicable
$discount = $isVIP ? $subtotal * $discountRate : 0;
// Calculer le total avec remise
$total_amount = $subtotal - $discount;

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
        
        // Préparation des données pour le paiement
        // Transformation du prix au format correct pour le paiement
        $formatted_total = number_format((float)$total_amount, 2, '.', '');
        
        $_SESSION['payment_data'] = [
            'booking_id' => $booking_id,
            'montant' => $formatted_total,
            'travel_title' => $travel_title
        ];
                
        // Rediriger vers la page intermédiaire de paiement
        header("Location: paiement-redirect.php");
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
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
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

                <div class="recap-row">
                    <span>Sous-total</span>
                    <span class="price"><?= number_format($subtotal, 2, ',', ' ') ?>€</span>
                </div>

                <?php if ($isVIP): ?>
                <div class="recap-row discount-row">
                    <span>Remise VIP (3%)</span>
                    <span class="price discount-price">-<?= number_format($discount, 2, ',', ' ') ?>€</span>
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
                    <!-- Enregistrement dans la base de données -->
                    <input type="hidden" name="travel_id" value="<?= htmlspecialchars($travel_id) ?>">
                    <input type="hidden" name="travel_title" value="<?= htmlspecialchars($travel_title) ?>">
                    <input type="hidden" name="travel_base_price" value="<?= htmlspecialchars($travel_base_price) ?>">
                    <input type="hidden" name="people" value="<?= htmlspecialchars($people) ?>">
                    <input type="hidden" name="date" value="<?= htmlspecialchars($date) ?>">
                    <?php foreach ($selected_options as $extra_id => $num_people): ?>
                        <input type="hidden" name="extra_people_<?= $extra_id ?>" value="<?= htmlspecialchars($num_people) ?>">
                    <?php endforeach; ?>
                    
                    <!-- Eléments relatifs au paiement -->
                    <input type='hidden' name='transaction' value="<?= htmlspecialchars($transaction) ?>">
                    <input type='hidden' name='montant' value="<?= number_format($total_amount, 2, '.', '') ?>">
                    <input type='hidden' name='vendeur' value="<?= htmlspecialchars($vendeur) ?>">
                    <input type='hidden' name='retour' value='retour_paiement.php?session=<?= htmlspecialchars($user_id) ?>'>
                    <input type='hidden' name='control' value="<?= htmlspecialchars($control) ?>">
                    
                    <input type="hidden" name="confirm_booking" value="1">
                    <button type="submit" class="button1">Confirmer et payer</button>
                </form>
            </div>
        </div>
    </main>
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>