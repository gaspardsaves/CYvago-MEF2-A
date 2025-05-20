<?php
// Inclure le fichier de connexion à la base de données
include 'session.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php?message=" . urlencode("Veuillez vous connecter pour accéder à cette page"));
    exit();
}

// Fonction pour valider les entrées
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

    // Récupérer l'ID de l'utilisateur
    $userId = $_SESSION['user_id'];
    
    if (isset($_POST['firstname'])) {
        $stmt = $database->prepare("UPDATE users SET firstname=? WHERE id=?");
        $stmt->bind_param("si", $_POST['firstname'], $userId);
        $stmt->execute();
        $_SESSION['prenom'] = $_POST['firstname'];
    }
    if (isset($_POST['lastname'])) {
        $stmt = $database->prepare("UPDATE users SET lastname=? WHERE id=?");
        $stmt->bind_param("si", $_POST['lastname'], $userId);
        $stmt->execute();
        $_SESSION['nom'] = $_POST['lastname'];
    }
    
    header("Location: moncompte.php");

?>