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
    <title>ZanimoTrip Admin</title>
    <link rel="stylesheet" href="css/administrateur.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>

    <!-- Contenu de la page -->
    <main class="admin">
        <h1>Utilisateurs de ZanimoTrip</h1>

        <!-- Tableau des utilisateurs -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>VIP</th>
                    <th>Banni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Charger les données
                $json = file_get_contents('json/comptes.json');
                $utilisateurs = json_decode($json, true);

                // Vérifier si utilisateurs sont bien chargés
                if (!$utilisateurs) {
                    echo "<tr><td colspan='6'>Erreur lors du chargement des utilisateurs.</td></tr>";
                } else {
                    // afficher les utilisateurs dans le tableau
                    foreach ($utilisateurs as $user) {
                        echo "<tr>
                                <td>$user{['id']}</td>
                                <td>{$user['nom']}</td>
                                <td>{$user['email']}</td>
                                <td>{$user['statut']}</td>
                                <td>
                                    <label class='switch'>
                                        <input type='checkbox' " . ($user['vip'] ? "checked" : "") . ">
                                        <span class='slider'></span>
                                    </label>
                                </td>
                                <td>
                                    <label class='switch'>
                                        <input type='checkbox' " . ($user['banni'] ? "checked" : "") . ">
                                        <span class='slider'></span>
                                    </label>
                                </td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php');
    header('Content-Type: text/html; charset=UTF-8');?>

    
    
</body>
</html>