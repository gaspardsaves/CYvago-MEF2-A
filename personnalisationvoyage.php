<?php 
    include 'session.php';
?>
<?php

$destination = isset($_GET['destination']) ? $_GET['destination'] : 'Aucune destination';
$description = isset($_GET['description']) ? $_GET['description'] : 'Aucune description';
$price = isset($_GET['price']) ? $_GET['price'] : '';

$sejour = [
    'alt' => $destination,
    'description' => $description,
    'price' => $price,
];

$prixOptions = [
    'petit_dej' => 10,
    'assurance' => 25,
    'guide' => 50,
    'menage' => 30,
    'duree' => 100,
    'transport_avion' => 200,
    'transport_train' => 80,
    'chambre_simple' => 70,
    'chambre_double' => 120,
    'chambre_suite' => 200,
    'excursion' => 40,
    'serviceVIP' => 150,
    'activites' => 50
];

$total = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (isset($prixOptions[$key])) {
            $total += is_numeric($value) ? $value * $prixOptions[$key] : $prixOptions[$key];
        }
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
    <title>ZanimoTrip Personnalisation</title>
    <link rel="stylesheet" href="css/formulaire.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <main>
        <div class="container-form">        
            <form method="POST" action="panier.php">
                <h1>Personnalisez votre voyage <?php echo htmlspecialchars($destination); ?></h1>
                <p><?php echo htmlspecialchars($description); ?></p>
                
                <label><input type="checkbox" name="petit_dej"> Petit Déjeuner - 10€</label> <br />
                <label><input type="checkbox" name="assurance"> Assurance voyage - 25€</label> <br />
                <label><input type="checkbox" name="guide"> Guide touristique - 50€</label> <br />
                <label><input type="checkbox" name="menage"> Service de ménage - 30€</label> <br />
                
                <label>Nombre de jours supplémentaires :
                    <select name="duree">
                        <option value="0">0 jour</option>
                        <option value="1">1 jour - 100€</option>
                        <option value="2">2 jours - 200€</option>
                        <option value="3">3 jours - 275€</option>
                    </select>
                </label> <br />
                
                <label>Transport :
                    <select name="transport">
                        <option value="transport_avion">Avion - 200€</option>
                        <option value="transport_train">Train - 80€</option>
                    </select>
                </label> <br />
                
                <label>Type de chambre :
                    <select name="chambre">
                        <option value="chambre_simple">Chambre simple - 70€</option>
                        <option value="chambre_double">Chambre double - 120€</option>
                        <option value="chambre_suite">Suite - 200€</option>
                    </select>
                </label> <br />
                
                <label><input type="checkbox" name="excursion"> Excursion - 40€</label> <br />
                <label><input type="checkbox" name="serviceVIP"> Service VIP - 150€</label> <br />
                <label><input type="checkbox" name="activites"> Activités supplémentaires - 50€</label> <br />
                
                
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                
                
                <input type="hidden" name="destination" value="<?php echo urlencode($destination); ?>">
                <input type="hidden" name="description" value="<?php echo urlencode($description); ?>">
                <input type="hidden" name="price" value="<?php echo urlencode($price); ?>">
                <div class="button-form">
                    <button type="submit" class="button1">Valider les options</button>
                </div>
            </form>
        </div>
    </main>
    
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
