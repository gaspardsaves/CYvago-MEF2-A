document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les écouteurs d'événements pour les toggles VIP
    initToggleListeners('.vip-toggle', updateUserStatus);
    
    // Initialiser les écouteurs d'événements pour les toggles de banissement
    initToggleListeners('.ban-toggle', updateUserStatus);
    
    /**
     * Initialise les écouteurs d'événements pour les toggles spécifiés
     * @param {string} selector - Sélecteur CSS pour les toggles
     * @param {function} callback - Fonction à appeler lors du changement
     */
    function initToggleListeners(selector, callback) {
        const toggles = document.querySelectorAll(selector);
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function(event) {
                // Obtenir l'ID utilisateur et l'état actuel du toggle
                const userId = selector === '.vip-toggle' ? this.id : this.getAttribute('data-user-id');
                const isChecked = this.checked;
                const actionType = selector === '.vip-toggle' ? 'vip' : 'ban';
                
                // Stocker une référence au toggle actuel pour y accéder dans la promesse
                const currentToggle = this;
                
                // Vérification si le toggle est VIP et que le statut 'ban' est également activé
                if (actionType === 'vip' && isChecked) {
                    // Rechercher si l'utilisateur est banni (toggle ban correspondant à cet ID)
                    const banToggle = document.querySelector(`.ban-toggle[data-user-id="${userId}"]`);
                    if (banToggle && banToggle.checked) {
                        // Si l'utilisateur est banni, désactiver le toggle ban
                        banToggle.checked = false;
                        // Informer l'utilisateur
                        alert("Le statut VIP désactive automatiquement le bannissement de l'utilisateur.");
                    }
                }
                
                // De même, si on active le ban et que VIP est actif
                if (actionType === 'ban' && isChecked) {
                    // Rechercher le toggle VIP correspondant
                    const vipToggle = document.getElementById(userId);
                    if (vipToggle && vipToggle.checked) {
                        // Désactiver le statut VIP
                        vipToggle.checked = false;
                        // Informer l'utilisateur
                        alert("Le bannissement désactive automatiquement le statut VIP de l'utilisateur.");
                    }
                }
                
                // Appeler la fonction de mise à jour
                callback(userId, isChecked, actionType);
            });
        });
    }
    
    /**
     * Met à jour le statut d'un utilisateur (VIP ou banissement)
     * @param {number} userId - ID de l'utilisateur
     * @param {boolean} isChecked - État du toggle (true = activé, false = désactivé)
     * @param {string} actionType - Type d'action ('vip' ou 'ban')
     */
    function updateUserStatus(userId, isChecked, actionType) {
        // Créer les données à envoyer
        const formData = new FormData();
        formData.append('userId', userId);
        formData.append('action', actionType);
        formData.append('value', isChecked);
        
        // Afficher un indicateur de chargement
        showLoadingIndicator();
        
        // Envoyer la requête au serveur
        fetch('update_user_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Masquer l'indicateur de chargement
            hideLoadingIndicator();
            
            if (data.success) {
                // Afficher un message de succès
                showMessage('success', `Le statut de l'utilisateur a été mis à jour avec succès`);
            } else {
                // Afficher un message d'erreur et réinitialiser le toggle
                showMessage('error', data.message || 'Une erreur est survenue');
                location.reload(); // Recharger la page pour réinitialiser les toggles
            }
        })
        .catch(error => {
            // Masquer l'indicateur de chargement
            hideLoadingIndicator();
            
            // Journaliser l'erreur et afficher un message
            console.error('Erreur:', error);
            showMessage('error', 'Une erreur est survenue lors de la communication avec le serveur');
            location.reload(); // Recharger la page pour réinitialiser les toggles
        });
    }
    
    /**
     * Affiche un indicateur de chargement
     */
    function showLoadingIndicator() {
        // Vous pouvez implémenter un spinner ou une autre indication visuelle ici
        document.body.style.cursor = 'wait';
    }
    
    /**
     * Masque l'indicateur de chargement
     */
    function hideLoadingIndicator() {
        document.body.style.cursor = 'default';
    }
    
    /**
     * Affiche un message à l'utilisateur
     * @param {string} type - Type de message ('success' ou 'error')
     * @param {string} text - Texte du message
     */
    function showMessage(type, text) {
        // Créer une notification stylisée au lieu d'une alerte
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = text;
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.padding = '15px 20px';
        notification.style.borderRadius = '5px';
        notification.style.zIndex = '1000';
        
        if (type === 'success') {
            notification.style.backgroundColor = '#4CAF50';
            notification.style.color = 'white';
        } else {
            notification.style.backgroundColor = '#F44336';
            notification.style.color = 'white';
        }
        
        document.body.appendChild(notification);
        
        // Faire disparaître la notification après 3 secondes
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.5s ease';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }
});