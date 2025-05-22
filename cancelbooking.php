<?php
include 'session.php';
include 'database.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit;
}

// Récupérer l'ID de réservation
$booking_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($booking_id <= 0) {
    $_SESSION['cancel_error'] = "Identifiant de réservation invalide.";
    header("Location: mesreservations.php");
    exit;
}

// Vérifier que la réservation existe et appartient à l'utilisateur
$stmt = $database->prepare("
    SELECT b.id, b.status
    FROM booking b
    WHERE b.id = ? AND b.user = ?
");
$stmt->bind_param("ii", $booking_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['cancel_error'] = "Réservation non trouvée ou vous n'êtes pas autorisé à la supprimer.";
    header("Location: mesreservations.php");
    exit;
}

$booking = $result->fetch_assoc();
$stmt->close();

// Vérifier si la réservation a déjà été payée
$stmt = $database->prepare("
    SELECT COUNT(*) as count 
    FROM payment 
    WHERE reservation = ? AND status = 'accepted'
");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$payment_data = $result->fetch_assoc();
$stmt->close();

// Si la réservation est payée, empêcher l'annulation
if ($payment_data['count'] > 0) {
    $_SESSION['cancel_error'] = "Impossible d'annuler une réservation déjà payée. Veuillez contacter le service client.";
    header("Location: mesreservations.php");
    exit;
}

// Début de la transaction
$database->begin_transaction();

try {
    // 1. Supprimer les paiements associés
    $stmt = $database->prepare("DELETE FROM payment WHERE reservation = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();
    
    // 2. Supprimer les engagements (options) associés
    $stmt = $database->prepare("DELETE FROM engagement WHERE booking = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();
    
    // 3. Supprimer la réservation elle-même
    $stmt = $database->prepare("DELETE FROM booking WHERE id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $stmt->close();
    
    // Validation de la transaction
    $database->commit();
    
    // Message de succès
    $_SESSION['cancel_success'] = "Votre réservation #$booking_id a été annulée avec succès.";
    
} catch (Exception $e) {
    // En cas d'erreur, annuler toutes les modifications
    $database->rollback();
    
    // Journaliser l'erreur
    error_log("Erreur lors de l'annulation de la réservation #$booking_id: " . $e->getMessage());
    
    // Message d'erreur
    $_SESSION['cancel_error'] = "Une erreur s'est produite lors de l'annulation de la réservation. Veuillez réessayer.";
}

// Redirection vers la page des réservations
header("Location: mesreservations.php");
exit;
?>