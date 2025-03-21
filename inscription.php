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
    <title>ZanimoTrip Inscription</title>
    <link rel="stylesheet" href="css/formulaire.css">
</head>
<body>
    <!-- Barre de menu -->
    <?php require('phpFrequent/navbar.php'); ?>
    
    <!-- Barre de recherche -->
    <?php require('phpFrequent/searchbar.php'); ?>
    
    <!-- Contenu de la page -->
    <main>
        <div class="container-form">
            <form action="newaccount.php" method="POST">
                <p style="font-size: 20px;"><b> S'inscrire:</b></p>
                <p>
                    <input type="radio" name="pres" value="mademoiselle" /> Mademoiselle
                    <input type="radio" name="pres" value="madame"/> Madame
                    <input type="radio" name="pres" value="monsieur"/> Monsieur <br />
                </p>
                <label for="prenom"> Prénom : </label> <input type="text" name="prenom" placeholder="Philippe" maxlength="50" required> <br />
                <label for="nom"> Nom(s) : </label> <input type="text" name="nom" placeholder="DUPONT" maxlength="50" required> <br />
                <label for="mail"> Adresse mail : </label> <input type="email" name="mail" placeholder="xavier.dupont@mail.com" required> <br />
                <label for="mdp">Mot de passe : </label> <input type="password" name="mdp" required> <br/>
                <label for="date"> Date de naissance : </label> <input type="date" name="date" required> <br />
                <label for="tel"> Téléphone : </label> <input type="tel" name="tel" placeholder="05.69.13.00.01" required> <br />

                <div class="button-form">
                    <button class="button1" type="reset">Reset</button>
                    <button class="button1" type="submit">Valider</button>
                </div>
                <p>Déjà un compte ? <a href="connexion.php" class="link">Se connecter</a></p>
                <p>Accès à la page administrateur dans l'attente du backend  <a href="administrateur.php" class="link">Page Administrateur</a></p>
            </form>
        </div>
        
    </main>

    <!-- Barre de pied de page -->
    <?php require('phpFrequent/footer.php'); ?>
</body>
</html>
