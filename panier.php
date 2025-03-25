<?php
session_start();

// Récupérer les informations du panier depuis la session
$destination = isset($_SESSION['destination']) ? $_SESSION['destination'] : '';
$duree = isset($_SESSION['duree']) ? $_SESSION['duree'] : '';
$prix = isset($_SESSION['prix']) ? $_SESSION['prix'] : '';

if (!$destination) {
    echo 'Votre panier est vide.';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <h1>Récapitulatif de votre panier</h1>

    <p><strong>Destination:</strong> <?php echo $destination; ?></p>
    <p><strong>Durée:</strong> <?php echo $duree; ?> jours</p>
    <p><strong>Prix:</strong> <?php echo $prix; ?>€</p>

    <a href="personalisationVoyage.php?destination=<?php echo urlencode($destination); ?>&description=<?php echo urlencode($description); ?>">Modifier votre voyage</a>

    <!-- Ajouter un lien vers la page de paiement -->
    <a href="paiement.php">Passer à la page de paiement</a>
</body>
</html>

