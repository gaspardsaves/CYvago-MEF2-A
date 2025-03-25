<?php
// Récupération des paramètres de la destination et description (transmis par l'URL)
$destination = isset($_GET['destination']) ? $_GET['destination'] : 'Aucune destination';
$description = isset($_GET['description']) ? $_GET['description'] : 'Aucune description';

// Prix des options
$prixPetitDej = 10; // 10€ pour un petit déjeuner
$prixAssurance = 25; // 25€ pour l'assurance
$prixGuide = 50; // 50€ pour un guide
$prixMénage = 30; // 30€ pour le ménage
$prixDuréeSupplémentaire = 100; //  100€ par jour supplémentaire
$prixTransportAvion = 200; // 200€ pour un vol aller-retour
$prixTransportTrain = 80; //  80€ pour un trajet en train aller-retour
$prixChambreSimple = 70; // 70€ par nuit pour une chambre simple
$prixChambreDouble = 120; //  120€ par nuit pour une chambre double
$prixChambreSuite = 200; // 200€ par nuit pour une suite
$prixExcursion = 40; //  40€ par excursion
$prixServiceVIP = 150; // 150€ pour un service VIP
$prixActivitéSupplémentaire = 50; //  50€ par activité

// Calcul total de l'option
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['petit_dej'])) {
        $total += $prixPetitDej;
    }
    if (isset($_POST['assurance'])) {
        $total += $prixAssurance;
    }
    if (isset($_POST['guide'])) {
        $total += $prixGuide;
    }
    if (isset($_POST['menage'])) {
        $total += $prixMénage;
    }
    if (isset($_POST['duree'])) {
        $total += $_POST['duree'] * $prixDuréeSupplémentaire;
    }
    if (isset($_POST['transport'])) {
        if ($_POST['transport'] == 'avion') {
            $total += $prixTransportAvion;
        } elseif ($_POST['transport'] == 'train') {
            $total += $prixTransportTrain;
        }
    }
    if (isset($_POST['chambre'])) {
        if ($_POST['chambre'] == 'simple') {
            $total += $prixChambreSimple;
        } elseif ($_POST['chambre'] == 'double') {
            $total += $prixChambreDouble;
        } elseif ($_POST['chambre'] == 'suite') {
            $total += $prixChambreSuite;
        }
    }
    if (isset($_POST['excursion'])) {
        $total += $prixExcursion;
    }
    if (isset($_POST['serviceVIP'])) {
        $total += $prixServiceVIP;
    }
    if (isset($_POST['activites'])) {
        $total += $prixActivitéSupplémentaire;
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
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>

    <!-- Contenu de la page -->
    <main>
        <div class="contenu">
            <h1>Personnalisez votre voyage : <?php echo $destination; ?></h1>
            <p><?php echo $description; ?></p>

            <form method="POST" action="personalisationVoyage.php?destination=<?php echo urlencode($destination); ?>&description=<?php echo urlencode($description); ?>">

                <!-- Petit Déjeuner -->
                <div>
                    <label>
                        <input type="checkbox" name="petit_dej">
                        Petit Déjeuner - <?php echo $prixPetitDej; ?>€ par personne
                    </label>
                </div>

                <!-- Assurance -->
                <div>
                    <label>
                        <input type="checkbox" name="assurance">
                        Assurance voyage - <?php echo $prixAssurance; ?>€
                    </label>
                </div>

                <!-- Guide -->
                <div>
                    <label>
                        <input type="checkbox" name="guide">
                        Guide touristique - <?php echo $prixGuide; ?>€ par jour
                    </label>
                </div>

                <!-- Ménage -->
                <div>
                    <label>
                        <input type="checkbox" name="menage">
                        Service de ménage - <?php echo $prixMénage; ?>€ par jour
                    </label>
                </div>

                <!-- Durée -->
                <div>
                    <label>
                        Nombre de jours supplémentaires :
                        <select name="duree">
                            <option value="1">1 jour</option>
                            <option value="2">2 jours</option>
                            <option value="3">3 jours</option>
                        </select>
                    </label>
                </div>

                <!-- Transport -->
                <div>
                    <label>
                        Transport :
                        <select name="transport">
                            <option value="avion">Avion - <?php echo $prixTransportAvion; ?>€</option>
                            <option value="train">Train - <?php echo $prixTransportTrain; ?>€</option>
                        </select>
                    </label>
                </div>

                <!-- Chambre -->
                <div>
                    <label>
                        Type de chambre :
                        <select name="chambre">
                            <option value="simple">Chambre simple - <?php echo $prixChambreSimple; ?>€ par nuit</option>
                            <option value="double">Chambre double - <?php echo $prixChambreDouble; ?>€ par nuit</option>
                            <option value="suite">Suite - <?php echo $prixChambreSuite; ?>€ par nuit</option>
                        </select>
                    </label>
                </div>

                <!-- Excursion -->
                <div>
                    <label>
                        <input type="checkbox" name="excursion">
                        Excursion supplémentaire - <?php echo $prixExcursion; ?>€
                    </label>
                </div>

                <!-- Service VIP -->
                <div>
                    <label>
                        <input type="checkbox" name="serviceVIP">
                        Service VIP - <?php echo $prixServiceVIP; ?>€
                    </label>
                </div>

                <!-- Activités supplémentaires -->
                <div>
                    <label>
                        <input type="checkbox" name="activites">
                        Activités supplémentaires (plongée, randonnée, etc.) - <?php echo $prixActivitéSupplémentaire; ?>€
                    </label>
                </div>

                <!-- Affichage du total -->
                <div>
                    <h3>Total : <?php echo $total; ?>€</h3>
                </div>

                <!-- Boutons de validation -->
                <div>
                    <button type="submit">Valider la personnalisation</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Barre de menu pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>

</html>
