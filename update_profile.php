<?php
include 'session.php';
include 'database.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Vous devez être connecté pour effectuer cette action.'
    ]);
    exit();
}

$userId = $_SESSION['user_id'];

// Vérifier si une action est spécifiée
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'update_profile') {
    // Récupérer les données envoyées
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';

    // Valider les données
    if (empty($firstname) || empty($lastname)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Les champs prénom et nom sont obligatoires.'
        ]);
        exit();
    }

    // Préparer la requête SQL
    $stmt = $database->prepare("UPDATE users SET firstname = ?, lastname = ? WHERE id = ?");
    if (!$stmt) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Erreur de préparation de la requête: ' . $database->error
        ]);
        exit();
    }

    $stmt->bind_param("ssi", $firstname, $lastname, $userId);

    if ($stmt->execute()) {
        // Mettre à jour la session
        $_SESSION['prenom'] = $firstname;
        $_SESSION['nomdefamille'] = $lastname;
        
        // Renvoyer une réponse de succès avec les données mises à jour
        echo json_encode([
            'success' => true,
            'message' => 'Profil mis à jour avec succès !',
            'data' => [
                'firstname' => $firstname,
                'lastname' => $lastname
            ]
        ]);
    } 
    else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Une erreur est survenue lors de la mise à jour: ' . $database->error
        ]);
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Action non reconnue.'
    ]);
}
?>