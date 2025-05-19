<?php 
include 'session.php';
include 'database.php';

// Inclusion du fichier contenant la fonction getAPIKey
require('getapikey.php');

// Connexion à la base de données
$database = require('database.php');

// Récupération de l'ID de réservation
$booking_id = $_GET['booking_id'] ?? null;

if ($booking_id) {
    // Récupération des paramètres de l'URL de retour
    $transaction = $_GET['transaction'] ?? '';
    $montant = $_GET['montant'] ?? '';
    $vendeur = "MEF-2_A";
    $statut = $_GET['status'] ?? ''; // 'accepted' ou 'declined'
    $control = $_GET['control'] ?? '';
    
    // Récupération de la clé API
    $api_key = getAPIKey($vendeur);
    
    // Vérification de la validité de la clé API
    if (!preg_match("/^[0-9a-zA-Z]{15}$/", $api_key)) {
        die("Code vendeur invalide");
    }
    
    // Recalcul de la valeur de contrôle pour vérification
    $control_calc = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");
    
    // Vérification de l'intégrité des données
    if ($control === $control_calc) {
        // Vérification que la réservation existe
        $stmt = $database->prepare("SELECT id FROM booking WHERE id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking_exists = $result->num_rows > 0;
        $stmt->close();
        
        if ($booking_exists) {
            // Récupération du paiement existant pour cette réservation
            $stmt = $database->prepare("SELECT id FROM payment WHERE reservation = ?");
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $payment = $result->fetch_assoc();
            $stmt->close();
            
            $payment_id = $payment['id'] ?? null;
            
            if ($payment_id) {
                // Mise à jour de l'entrée de paiement existante
                $stmt = $database->prepare("UPDATE payment SET montant = ?, date = NOW() WHERE id = ?");
                $stmt->bind_param("di", $montant, $payment_id);
                $stmt->execute();
                $stmt->close();
            } else {
                // Création d'une nouvelle entrée de paiement
                $stmt = $database->prepare("INSERT INTO payment (reservation, montant, date) VALUES (?, ?, NOW())");
                $stmt->bind_param("id", $booking_id, $montant);
                $stmt->execute();
                $payment_id = $database->insert_id;
                $stmt->close();
            }
            
            // Traitement en fonction du statut du paiement
            if ($statut === 'accepted') {
                // Paiement accepté - redirection vers une page de confirmation
                $_SESSION['payment_success'] = true;
                $_SESSION['payment_message'] = "Votre paiement de " . number_format($montant, 2, ',', ' ') . " € a été accepté.";
                header("Location: confirmation.php?booking_id=" . $booking_id);
                exit;
            } else {
                // Paiement refusé - redirection vers une page d'erreur
                $_SESSION['payment_error'] = true;
                $_SESSION['payment_message'] = "Votre paiement a été refusé. Veuillez réessayer avec une autre carte ou contacter le service client.";
                header("Location: echec-paiement.php?booking_id=" . $booking_id);
                exit;
            }
        } else {
            // La réservation n'existe pas
            echo "Erreur : réservation invalide";
            // Journalisation de l'erreur...
        }
    } else {
        // Les données ont été altérées
        echo "Erreur : les données de retour sont invalides";
        // Journalisation de l'erreur...
    }
} else {
    echo "Aucune réservation spécifiée";
}
?>