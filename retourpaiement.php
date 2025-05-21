<?php 
include 'session.php';
include 'database.php';

// Récupération des paramètres GET envoyés par CYBank
$booking_id = $_GET['booking_id'] ?? null;
$status = $_GET['status'] ?? ''; // 'accepted' ou 'declined'
// Montant en s'assurant qu'il est correctement formaté
$raw_montant = $_GET['montant'] ?? '0';
$montant = number_format((float)$raw_montant, 2, '.', '');
$transaction = $_GET['transaction'] ?? '';
$vendeur_received = $_GET['vendeur'] ?? 'MEF-2_A';
$control_received = $_GET['control'] ?? '';

try {
    // Récupération de la clé API
    require('getapikey.php');
    $vendeur = "MEF-2_A";
    $api_key = getAPIKey($vendeur);
    
    // Recalcul de la valeur de contrôle attendue pour vérification
    $expected_control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur_received . "#" . $status . "#");
    
    // Vérification de l'intégrité des données
    if ($control_received === $expected_control) {
        // Vérification que la réservation existe
        $stmt = $database->prepare("SELECT id FROM booking WHERE id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking_exists = $result->num_rows > 0;
        $stmt->close();
        
        if ($booking_exists) {
            // Enregistrer le paiement dans la base de données
            $stmt = $database->prepare("INSERT INTO payment (reservation, montant, date, status) VALUES (?, ?, NOW(), ?)");
            $stmt->bind_param("ids", $booking_id, $montant, $status);
            $stmt->execute();
            $payment_id = $database->insert_id;
            $stmt->close();
            
            // Traitement en fonction du statut du paiement
            if ($status === 'accepted') {
                // Paiement accepté - redirection vers une page de confirmation
                $_SESSION['payment_success'] = true;
                $_SESSION['payment_message'] = "Votre paiement de " . number_format($montant, 2, ',', ' ') . " € a été accepté.";
                
                // Mettre à jour le statut de la réservation
                $stmt = $database->prepare("UPDATE booking SET status = 'confirmed' WHERE id = ?");
                $stmt->bind_param("i", $booking_id);
                $stmt->execute();
                $stmt->close();
                
                header("Location: confirmation.php?booking_id=" . $booking_id);
                exit;
            } else {
                // Paiement refusé - redirection vers une page d'erreur
                $_SESSION['payment_error'] = true;
                $_SESSION['payment_message'] = "Votre paiement a été refusé. Veuillez réessayer avec une autre carte ou contacter le service client.";
                
                header("Location: echecpaiement.php?booking_id=" . $booking_id);
                exit;
            }
        } else {
            echo "Erreur : réservation invalide";
        }
    } else {
        echo "Erreur : les données de retour sont invalides";
    }
} catch (Exception $e) {
    echo "Une erreur est survenue lors du traitement du paiement. Veuillez contacter le support.";
}
?>