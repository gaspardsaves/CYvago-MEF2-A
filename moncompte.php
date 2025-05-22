<?php
    
    include 'session.php';
   
    $id = $_SESSION['user_id'];
    $stmt = $database->prepare("SELECT lastname, firstname, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if(!isset($_SESSION['email'])){
        header("Location: connexion.php");
        exit();
    }
    
    // Vérifier que les variables de session nécessaires existent
    $prenom = isset($user['firstname']) ? $user['firstname'] : "Utilisateur";
    $nom = isset($user['lastname']) ? $user['lastname'] : "";
    $email = isset($user['email']) ? $user['email'] : "non renseigné";
    $phone = isset($user['phone']) ? $user['phone'] : "";
    
    // Pour les messages de notification
    $message = isset($_GET['message']) ? $_GET['message'] : '';
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
    <title>ZanimoTrip Mon Compte</title>
    <link rel="stylesheet" href="css/monCompte.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/mode-clair.css?v=<?php echo time(); ?>">
    <script src="js/mode.js?v=<?php echo time(); ?>"></script>
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
        <!-- Messages de notification -->
        <?php if(isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="message-con-ok show">
                Bonjour <span id="nomUtilisateur"><?php echo htmlspecialchars($prenom); ?></span> !
            </div>
        <?php endif; ?>
        
        <?php if(isset($_GET['success']) && $_GET['success'] == 'newok'): ?>
            <div class="message-con-ok show">
                Bienvenue <span id="nomUtilisateur"><?php echo htmlspecialchars($prenom); ?></span> !
            </div>
        <?php endif; ?>
        
        <?php if(!empty($message)): ?>
            <div class="message-con-ok show">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="profile-container">
            <h1>Bienvenue sur votre profil !</h1>

            <div class="profile-card">
                <img src="img/blank-picture-profile.png" 
                    alt="photo de profil" class="profile-pic">
                <a href="moncompte.php" class="modify">📸 Changer de photo</a>
            </div>

            <form id="profile-form">
                <label for="firstname">Prénom :</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($prenom); ?>" required>

                <label for="lastname">Nom :</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($nom); ?>" required>

                <button type="submit" class="button1">Mettre à jour</button>
            </form>
            <br/>
            <div class="buttons-nav">
                <form action="mesreservations.php" method="GET">
                    <button class="button1" type="submit">🛍️ Mes réservations</button>
                </form>
                <form action="logout.php" method="GET">
                    <button class="button1" type="submit">⬅️ Déconnexion</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
    
    
    <script src="js/moncompte.js?v=<?php echo time(); ?>"></script>
</body>
</html>