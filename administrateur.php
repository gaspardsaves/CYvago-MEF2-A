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
    <link rel="stylesheet" href="css/administrateur.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    
</head>
<body>
    <!-- Barre de menu -->
    <?php include 'session.php'; ?>
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
                include 'database.php';
                $NB_lignes = 20;
                $requete = "SELECT * FROM users";
                $prep = $database->prepare($requete);
                $prep->execute();
                $res = $prep->get_result();
                while($ligne = $res->fetch_assoc()){
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
                                    id="' . $ligne['id'] . '" ' . ($ligne["role"] == 2 ? 'checked' : '') . '>
                                <span class="slider"></span>
                            </label>
                        </td>
                        <td>
                            <label class="switch">
                                <input type="checkbox" 
                                    class="ban-toggle" 
                                    data-user-id="' . $ligne['id'] . '" ' . ($ligne["role"] == -1 ? 'checked' : '') . '>
                                <span class="slider"></span>
                            </label>
                        </td>
                        ';
                    }
                    elseif($ligne["role"]==0){
                        echo '<td>Admin</td>';
                        echo'<td></td><td></td>';
                    }
                    
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
    
    <script src="js/admin.js?v=<?php echo time(); ?>"></script>
</body>
</html>