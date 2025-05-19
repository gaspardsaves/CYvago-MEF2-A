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

// Traitement du formulaire de mise à jour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID de l'utilisateur
    $userId = $_SESSION['user_id'];
    
    // Initialiser les messages et compteur de modifications
    $messages = [];
    $modificationsCount = 0;
    
    // Récupérer et valider les données envoyées
    $firstname = isset($_POST['firstname']) ? validateInput($_POST['firstname']) : null;
    $lastname = isset($_POST['lastname']) ? validateInput($_POST['lastname']) : null;
    $email = isset($_POST['email']) ? validateInput($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? validateInput($_POST['phone']) : null;
    $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null;
    
    
    
    // Traiter le prénom
    if ($firstname !== null) {
        $stmt = $database->prepare("UPDATE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
    }
    
    // Traiter le nom
    if ($lastname !== null) {
        $fieldUpdates[] = "lastname = ?";
        $params[] = $lastname;
        $modificationsCount++;
    }
    
    // Traiter l'email
    if ($email !== null) {
        // Valider l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $messages[] = "Format d'email non valide.";
        } else {
            // Vérifier si l'email existe déjà
            $checkEmail = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ? AND id != ?");
            $checkEmail->bind_param("si", $email, $userId);
            $checkEmail->execute();
            $result = $checkEmail->get_result();
            $emailExists = $result->fetch_row()[0];
            
            if ($emailExists > 0) {
                $messages[] = "Cet email est déjà utilisé par un autre compte.";
            } else {
                $fieldUpdates[] = "email = ?";
                $params[] = $email;
                $modificationsCount++;
            }
        }
    }
    
    // Traiter le téléphone
    if ($phone !== null) {
        $fieldUpdates[] = "phone = ?";
        $params[] = $phone;
        $modificationsCount++;
    }
    
    // Traiter le mot de passe
    if ($password !== null) {
        // Vérifier la complexité du mot de passe
        if (strlen($password) < 8) {
            $messages[] = "Le mot de passe doit contenir au moins 8 caractères.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $fieldUpdates[] = "password = ?";
            $params[] = $hashedPassword;
            $modificationsCount++;
        }
    }
    
    // Finaliser la requête SQL si des champs ont été mis à jour
    if (!empty($fieldUpdates) && empty($messages)) {
        $sql .= implode(", ", $fieldUpdates);
        $sql .= " WHERE id = ?";
        $params[] = $userId;
        
        // Préparer le type pour bind_param
        $types = str_repeat("s", count($params) - 1) . "i"; // Chaînes + un entier pour l'ID
        
        // Préparer et exécuter la requête
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        
        if ($stmt->execute()) {
            // Mettre à jour les variables de session
            if ($firstname !== null) {
                $_SESSION['prenom'] = $firstname;
            }
            if ($lastname !== null) {
                $_SESSION['nom'] = $lastname;
            }
            if ($email !== null) {
                $_SESSION['email'] = $email;
            }
            
            $messages[] = "Profil mis à jour avec succès.";
        } else {
            $messages[] = "Erreur lors de la mise à jour: " . $conn->error;
        }
    } elseif ($modificationsCount == 0) {
        $messages[] = "Aucune modification n'a été effectuée.";
    }
    
    // Rediriger avec un message approprié
    header("Location: moncompte.php?message=" . urlencode(implode(' ', $messages)));
    exit();
} else {
    // Si accès direct à ce fichier sans formulaire POST
    header("Location: moncompte.php");
    exit();
}
?>