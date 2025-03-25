<?php

session_start();

// Récupérer les informations passées par l'URL
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$description = isset($_GET['description']) ? $_GET['description'] : '';

// Si l'utilisateur soumet le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $_SESSION['destination'] = $_POST['destination'];
    $_SESSION['duree'] = $_POST['duree'];
    $_SESSION['prix'] = $_POST['prix'];
    
    // Rediriger vers le panier.php
    header('Location: panier.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnalisation Voyage</title>
</head>
<body>
    <h1>Personnalisation de votre voyage</h1>

    <form action="personalisationVoyage.php" method="POST">
        <label for="destination">Destination: <?php echo $destination; ?></label><br>
        <label for="description">Description: <?php echo $description; ?></label><br>

        <label for="duree">Durée (en jours):</label>
        <input type="number" name="duree" id="duree" min="1" required><br>

        <label for="prix">Prix:</label>
        <input type="number" name="prix" id="prix" min="100" required><br>

        <input type="hidden" name="destination" value="<?php echo $destination; ?>">

        <input type="submit" value="Ajouter au panier">
    </form>
</body>
</html>
