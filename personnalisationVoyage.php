<?php 
    include 'session.php';
?>
<?php

$destination = isset($_GET['destination']) ? $_GET['destination'] : 'Aucune destination';
$description = isset($_GET['description']) ? $_GET['description'] : 'Aucune description';


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
    <title>Personnalisation du Voyage</title>
    <link rel="stylesheet" href="css/personnalisation.css">
</head>
<body>
    <?php require('phpFrequent/navbar.php'); ?>
    
    <main>
        <div class="container-form">
            <h1>Personnalisez votre voyage : <?php echo htmlspecialchars($destination); ?></h1>
            <p><?php echo htmlspecialchars($description); ?></p>
            
            
            <form method="POST" action="panier.php">
                
                <label><input type="checkbox" name="petit_dej"> Petit Déjeuner - 10€</label>
                <label><input type="checkbox" name="assurance"> Assurance voyage - 25€</label>
                <label><input type="checkbox" name="guide"> Guide touristique - 50€</label>
                <label><input type="checkbox" name="menage"> Service de ménage - 30€</label>
                
                <label>Nombre de jours supplémentaires :
                    <select name="duree">
                        <option value="0">0 jour</option>
                        <option value="1">1 jour - 100€</option>
                        <option value="2">2 jours - 200€</option>
                        <option value="3">3 jours - 275€</option>
                    </select>
                </label>
                
                <label>Transport :
                    <select name="transport">
                        <option value="transport_avion">Avion - 200€</option>
                        <option value="transport_train">Train - 80€</option>
                    </select>
                </label>
                
                <label>Type de chambre :
                    <select name="chambre">
                        <option value="chambre_simple">Chambre simple - 70€</option>
                        <option value="chambre_double">Chambre double - 120€</option>
                        <option value="chambre_suite">Suite - 200€</option>
                    </select>
                </label>
                
                <label><input type="checkbox" name="excursion"> Excursion - 40€</label>
                <label><input type="checkbox" name="serviceVIP"> Service VIP - 150€</label>
                <label><input type="checkbox" name="activites"> Activités supplémentaires - 50€</label>
                
                
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                
                
                <input type="hidden" name="destination" value="<?php echo urlencode($destination); ?>">
                <input type="hidden" name="description" value="<?php echo urlencode($description); ?>">
                
                <div class="button-form">
                    <button type="submit" class="button1">Valider les options</button>
                </div>
            </form>
        </div>
    </main>
    
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
