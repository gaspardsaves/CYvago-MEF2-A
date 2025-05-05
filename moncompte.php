<?php
    
    include 'session.php';
   
    
    
    if(!isset($_SESSION['email']) && !isset($_SESSION['mail'])){
        header("Location: connexion.php");
        exit();
    }
    
    // Vérifier que les variables de session nécessaires existent
    $prenom = isset($_SESSION['prenom']) ? $_SESSION['prenom'] : "Utilisateur";
    $nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : "";
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : "non renseigné";
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
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
        <!-- Cas de la connexion classique -->
        <?php if(isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="message-con-ok show">
                Bonjour <span id="nomUtilisateur"><?php echo htmlspecialchars($prenom); ?></span> !
            </div>
        <?php endif; ?>
        <!-- Cas du nouvel utilisateur -->
        <?php if(isset($_GET['success']) && $_GET['success'] == 'newok'): ?>
            <div class="message-con-ok show">
                Bienvenue <span id="nomUtilisateur"><?php echo htmlspecialchars($prenom); ?></span> !
            </div>
        <?php endif; ?>

        <div class="profile-container">
            <h1>Bienvenue sur votre profil !</h1>

            <div class="profile-card">
                <img src="img/blank-picture-profile.png" 
                    alt="photo de profil" class="profile-pic">
                <a href="moncompte.php" class="modify">📸 Changer de photo</a>
            </div>

            <form id="profile-form" action="update_profile.php" method="POST">
                <div class="profile-info">
                    <h2>Vos informations</h2>
                    
                    <p>
                        <label for="nom"><strong>👤 Nom :</strong></label>
                        <input type="text" id="nom" value="<?php echo htmlspecialchars($prenom . ' ' . $nom); ?>" disabled>
                        <button type="button" class="edit-btn" data-target="nom">✏️</button>
                        <button type="button" class="save-btn" data-target="nom" style="display:none;">✅</button>
                        <button type="button" class="cancel-btn" data-target="nom" style="display:none;">❌</button>
                        <input type="hidden" name="nom" id="hidden-nom" value="<?php echo htmlspecialchars($prenom . ' ' . $nom); ?>">
                    </p>
                    <p>
                        <label for="email"><strong>📧 Email :</strong></label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
                        <button type="button" class="edit-btn" data-target="email">✏️</button>
                        <button type="button" class="save-btn" data-target="email" style="display:none;">✅</button>
                        <button type="button" class="cancel-btn" data-target="email" style="display:none;">❌</button>
                        <input type="hidden" name="email" id="hidden-email" value="<?php echo htmlspecialchars($email); ?>">
                    </p>
                    <p>
                        <label for="password"><strong>🔑 Mot de passe :</strong></label>
                        <input type="password" id="password" value="••••••••" disabled>
                        <button type="button" class="edit-btn" data-target="password">✏️</button>
                        <button type="button" class="save-btn" data-target="password" style="display:none;">✅</button>
                        <button type="button" class="cancel-btn" data-target="password" style="display:none;">❌</button>
                        <input type="hidden" name="password" id="hidden-password" value="">
                    </p>
                    <button class="button1" type="submit" id="submit-profile" style="display: none;">💾 Enregistrer les modifications</button>
                </div>
            </form>
            <br/>
            <div class="buttons-nav">
                <form action="panier.php" method="GET">
                    <button class="button1" type="submit">🛍️ Panier</button>
                </form>
                <form action="logout.php" method="GET">
                    <button class="button1" type="submit">⬅️ Déconnexion</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
    
    <!-- Script JavaScript à charger après le DOM -->
    <script src="js/moncompte.js"></script>
</body>
</html>