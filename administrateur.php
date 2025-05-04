<?php 
    include 'session.php';
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
    <title>ZanimoTrip Admin</title>
    <link rel="stylesheet" href="css/administrateur.css">
    <script src="js/admin.js"></script>
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
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>VIP</th>
                    <th>Banni</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                /*<?php
                $json = file_get_contents('json/comptes.json');
                $utilisateurs = json_decode($json, true);

                // vérification
                if (!$utilisateurs) {
                    echo "<tr><td colspan='6'>Erreur lors du chargement des utilisateurs.</td></tr>";
                } else {
                    // affichage utilisateurs dans tableaux
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
                */
                include 'database.php';
                $NB_lignes = 20;
                $requete = "SELECT * FROM users";
                $res = $database->query($requete);
                while($ligne=$res->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$ligne["id"]."</td>";
                    echo "<td>".$ligne["lastname"]."</td>";
                    echo "<td>".$ligne["firstname"]."</td>";
                    echo "<td>".$ligne["email"]."</td>";
                    if($ligne["role"]!=0){
                        echo'<td>Normal</td>';
                        echo '
                        <td>
                            <label class="switch">
                                <input type="checkbox" 
                                    class="vip-toggle" 
                                    data-user-id="'. $ligne['id'] . '" ' . ($ligne["role"] == 2 ? 'checked' : '') . '>'.'
                                <span class="slider"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" 
                                    class="ban-toggle" 
                                    data-user-id= ' . $ligne['id'] . '" ' . ($ligne["role"] == -1 ? 'checked' : '') . '>
                                <span class="slider"></span>
                            </label>
                        </td>
                        ';
                    }
                    elseif($ligne["role"]==0){
                        echo '<td>Admin</td>';
                        echo'<td></td><td></td>';
                    }
                    
                }
                if(isset($_REQUEST['requete']))
                ?>
                
            </tbody>
        </table>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php');
    //header('Content-Type: text/html; charset=UTF-8');?>

    
    
</body>
</html>