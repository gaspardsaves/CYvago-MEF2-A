<?php
/**
 * Script de mise à jour du statut utilisateur (VIP ou bannissement)
 * Reçoit les données via POST et met à jour la base de données
 */

// Inclusion du fichier de connexion à la base de données
include 'database.php';
include 'session.php';

// Vérification des droits d'administrateur
if((!isset($_SESSION['email']))||($_SESSION['role']!=0)){
    // Renvoyer une réponse JSON d'erreur
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Accès non autorisé. Vous devez être administrateur.'
    ]);
    exit;
}

// Vérification que la requête est bien en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Méthode non autorisée. Utilisez POST.'
    ]);
    exit;
}

// Récupération des données envoyées
$userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : '';
$value = isset($_POST['value']) ? filter_var($_POST['value'], FILTER_VALIDATE_BOOLEAN) : false;

// Validation des données
if ($userId <= 0) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'ID utilisateur invalide.'
    ]);
    exit;
}

if (!in_array($action, ['vip', 'ban'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Action invalide.'
    ]);
    exit;
}

// Vérifier que l'utilisateur existe et n'est pas un admin
$checkQuery = "SELECT role FROM users WHERE id = ?";
$stmt = $database->prepare($checkQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Utilisateur non trouvé.'
    ]);
    exit;
}

$userData = $result->fetch_assoc();
if ($userData['role'] == 0) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Impossible de modifier un administrateur.'
    ]);
    exit;
}

// Déterminer le nouveau rôle en fonction de l'action et de la valeur
$newRole = 1; // Rôle normal par défaut

if ($action === 'vip') {
    if ($value) {
        // Vérifie si l'utilisateur est banni avant de le mettre VIP
        if ($userData['role'] == -1) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Impossible de mettre en VIP un utilisateur banni.'
            ]);
            exit;
        }
        $newRole = 2; // 2 pour VIP
    } else {
        $newRole = 1; // 1 pour normal
    }
} else if ($action === 'ban') {
    if ($value) {
        // Vérifie si l'utilisateur est VIP avant de le bannir
        if ($userData['role'] == 2) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Impossible de bannir un utilisateur VIP.'
            ]);
            exit;
        }
        $newRole = -1; // -1 pour banni
    } else {
        $newRole = 1; // 1 pour normal
    }
}

// Mise à jour de la base de données
$updateQuery = "UPDATE users SET role = ? WHERE id = ?";
$stmt = $database->prepare($updateQuery);
$stmt->bind_param("ii", $newRole, $userId);

if ($stmt->execute()) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => true,
        'message' => 'Statut utilisateur mis à jour avec succès.'
    ]);
} else {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de la mise à jour: ' . $database->error
    ]);
}

$stmt->close();
?>