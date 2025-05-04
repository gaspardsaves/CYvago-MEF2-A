<?php
// Inclure le fichier de configuration de la base de données
include 'config/db_config.php';

// Inclure le fichier de session
include 'session.php';

// Fonction pour journaliser les actions importantes
function logAction($userId, $action, $details) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO activity_logs (user_id, action, details, ip_address, timestamp) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$userId, $action, $details, $_SERVER['REMOTE_ADDR']]);
    } catch (PDOException $e) {
        // Log silencieux - ne pas bloquer l'exécution si l'enregistrement échoue
        error_log("Erreur de journalisation: " . $e->getMessage());
    }
}

// Fonction pour répondre en JSON (utilisée par l'admin AJAX)
function jsonResponse($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit();
}

// Fonction pour valider les entrées
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        jsonResponse(false, "Session expirée, veuillez vous reconnecter");
    } else {
        header("Location: connexion.php?message=" . urlencode("Veuillez vous connecter pour accéder à cette page"));
        exit();
    }
}

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        jsonResponse(false, "Erreur de connexion à la base de données");
    } else {
        header("Location: moncompte.php?message=" . urlencode("Erreur de connexion à la base de données"));
        exit();
    }
}


if (isset($_POST['userId']) && isset($_POST['type']) && isset($_POST['value'])) {
    
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
        jsonResponse(false, "Accès refusé - Privilèges administrateur requis");
    }
    
    $userId = intval($_POST['userId']);
    $type = validateInput($_POST['type']);
    $value = intval($_POST['value']);
    
    // Valider le type de mise à jour
    if ($type != 'vip' && $type != 'ban') {
        jsonResponse(false, "Type de mise à jour non valide");
    }
    
    try {
        // Début de la transaction
        $pdo->beginTransaction();
        
        $columnName = ($type == 'vip') ? 'is_vip' : 'is_banned';
        $stmt = $pdo->prepare("UPDATE users SET $columnName = :value WHERE id = :userId");
        $stmt->execute([
            ':value' => $value,
            ':userId' => $userId
        ]);
        
        if ($stmt->rowCount() > 0) {
            // Journaliser l'action
            $actionType = ($type == 'vip') ? 
                ($value ? "Définir comme VIP" : "Retirer statut VIP") : 
                ($value ? "Bannir utilisateur" : "Débannir utilisateur");
            
            logAction($_SESSION['user_id'], $actionType, "ID utilisateur affecté: " . $userId);
            
            // Valider la transaction
            $pdo->commit();
            
            jsonResponse(true, "Statut mis à jour avec succès", [
                'userId' => $userId, 
                'type' => $type, 
                'value' => $value
            ]);
        } else {
            $pdo->rollBack();
            jsonResponse(false, "Aucune mise à jour effectuée - Utilisateur non trouvé ou statut déjà défini");
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        jsonResponse(false, "Erreur lors de la mise à jour: " . $e->getMessage());
    }
}
// Traitement du formulaire de mise à jour de profil utilisateur
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID de l'utilisateur
    $userId = $_SESSION['user_id'];
    
    // Initialiser les messages et les modifications
    $messages = [];
    $updatedFields = [];
    
    // Récupérer et valider les données envoyées
    $nouveauNom = isset($_POST['nom']) ? validateInput($_POST['nom']) : null;
    $nouvelEmail = isset($_POST['email']) ? validateInput($_POST['email']) : null;
    $nouveauMotDePasse = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null;
    
    try {
        // Commencer une transaction
        $pdo->beginTransaction();
        
        // Traitement du nom complet
        if ($nouveauNom !== null && $nouveauNom !== ($_SESSION['prenom'] . ' ' . $_SESSION['nom'])) {
            $nomComplet = explode(' ', $nouveauNom, 2);
            $prenom = $nomComplet[0];
            $nom = isset($nomComplet[1]) ? $nomComplet[1] : '';
            
            $stmt = $pdo->prepare("UPDATE users SET prenom = :prenom, nom = :nom WHERE id = :userId");
            $stmt->execute([
                ':prenom' => $prenom,
                ':nom' => $nom,
                ':userId' => $userId
            ]);
            
            if ($stmt->rowCount() > 0) {
                $_SESSION['prenom'] = $prenom;
                $_SESSION['nom'] = $nom;
                $messages[] = "Nom mis à jour avec succès.";
                $updatedFields[] = "nom";
            }
        }
        
        // Traitement de l'email
        if ($nouvelEmail !== null && $nouvelEmail !== $_SESSION['email']) {
            if (!filter_var($nouvelEmail, FILTER_VALIDATE_EMAIL)) {
                $messages[] = "Format d'email non valide.";
            } else {
                // Vérifier si l'email existe déjà
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email AND id != :userId");
                $stmt->execute([
                    ':email' => $nouvelEmail,
                    ':userId' => $userId
                ]);
                
                if ($stmt->fetchColumn() > 0) {
                    $messages[] = "Cet email est déjà utilisé par un autre compte.";
                } else {
                    $stmt = $pdo->prepare("UPDATE users SET email = :email WHERE id = :userId");
                    $stmt->execute([
                        ':email' => $nouvelEmail,
                        ':userId' => $userId
                    ]);
                    
                    if ($stmt->rowCount() > 0) {
                        $_SESSION['email'] = $nouvelEmail;
                        $messages[] = "Email mis à jour avec succès.";
                        $updatedFields[] = "email";
                    }
                }
            }
        }
        
        // Traitement du mot de passe
        if ($nouveauMotDePasse !== null) {
            // Vérifier la complexité du mot de passe
            if (strlen($nouveauMotDePasse) < 8) {
                $messages[] = "Le mot de passe doit contenir au moins 8 caractères.";
            } 
            // Vous pouvez ajouter d'autres règles de complexité ici
            else {
                $motDePasseHache = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :userId");
                $stmt->execute([
                    ':password' => $motDePasseHache,
                    ':userId' => $userId
                ]);
                
                if ($stmt->rowCount() > 0) {
                    $messages[] = "Mot de passe mis à jour avec succès.";
                    $updatedFields[] = "mot de passe";
                }
            }
        }
        
        // Si des champs ont été mis à jour, journaliser l'action
        if (!empty($updatedFields)) {
            logAction($userId, "Mise à jour du profil", "Champs modifiés: " . implode(", ", $updatedFields));
            $pdo->commit();
        } else {
            $pdo->rollBack();
            if (empty($messages)) {
                $messages[] = "Aucune modification n'a été effectuée.";
            }
        }
        
    } catch (PDOException $e) {
        $pdo->rollBack();
        $messages[] = "Erreur lors de la mise à jour: " . $e->getMessage();
        error_log("Erreur update_profile.php: " . $e->getMessage());
    }
    
    // Rediriger avec un message approprié
    $messageParam = !empty($messages) ? "?message=" . urlencode(implode(' ', $messages)) : "";
    header("Location: moncompte.php" . $messageParam);
    exit();
}
// Si aucune des conditions précédentes n'est remplie
else {
    header("Location: moncompte.php");
    exit();
}
?>