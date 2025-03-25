<?php

$destination = isset($_POST['destination']) ? $_POST['destination'] : 'Voyage inconnu';


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
$optionsSelectionnees = [];


foreach ($_POST as $key => $value) {

    if (isset($prixOptions[$key])) {
        $prix = is_numeric($value) ? $value * $prixOptions[$key] : $prixOptions[$key];
        $total += $prix;
        $optionsSelectionnees[] = [
            'nom' => ucfirst(str_replace('_', ' ', $key)), 
            'prix' => $prix
        ];
    }
}


if (isset($_POST['transport']) && isset($prixOptions[$_POST['transport']])) {
    $transport = $_POST['transport'];
    $total += $prixOptions[$transport];
    $optionsSelectionnees[] = [
        'nom' => ucfirst(str_replace('_', ' ', $transport)),
        'prix' => $prixOptions[$transport]
    ];
}

if (isset($_POST['chambre']) && isset($prixOptions[$_POST['chambre']])) {
    $chambre = $_POST['chambre'];
    $total += $prixOptions[$chambre];
    $optionsSelectionnees[] = [
        'nom' => ucfirst(str_replace('_', ' ', $chambre)),
        'prix' => $prixOptions[$chambre]
    ];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - ZanimoTrip</title>
    <link rel="stylesheet" href="css/panier.css">
</head>
<body>

    <?php require('phpFrequent/navbar.php'); ?>

    <main>
        <div class="container-form">
            <h1>Votre panier pour : <?php echo htmlspecialchars($destination); ?></h1>

            <div class="options-container">
                <p>Options sélectionnées :</p>
                <?php if (!empty($optionsSelectionnees)): ?>
                    <div class="options-list">
                        <?php foreach ($optionsSelectionnees as $option): ?>
                            <div><?php echo htmlspecialchars($option['nom']) . " - " . $option['prix'] . "€"; ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>Aucune option sélectionnée.</p>
                <?php endif; ?>
            </div>

            <p class="total">Total : <?php echo $total; ?>€</p>

            <div class="button-form">
                <button onclick="alert('Paiement non encore disponible')">Procéder au paiement</button>
            </div>
        </div>
    </main>

    <?php require('phpFrequent/footer.php'); ?>

</body>
</html>
