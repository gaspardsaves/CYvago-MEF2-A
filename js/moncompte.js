document.addEventListener('DOMContentLoaded', function () {
    const profileForm = document.getElementById('profile-form');
    const firstnameField = document.getElementById('firstname');
    const lastnameField = document.getElementById('lastname');
    const nomUtilisateur = document.getElementById('nomUtilisateur');

    // Stocker les valeurs originales au chargement
    let originalValues = {
        firstname: firstnameField.value,
        lastname: lastnameField.value
    };

    profileForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Vérifier si les valeurs ont changé
        const currentValues = {
            firstname: firstnameField.value.trim(),
            lastname: lastnameField.value.trim()
        };

        if (currentValues.firstname === originalValues.firstname && 
            currentValues.lastname === originalValues.lastname) {
            showInfoMessage('Aucune modification détectée.');
            return;
        }

        // Validation côté client
        if (!currentValues.firstname || !currentValues.lastname) {
            showErrorMessage('Les champs prénom et nom sont obligatoires.');
            return;
        }

        // Fonction pour mettre à jour le nom dans la barre de navigation
        function updateNavbarName(firstname) {
            const navbarButton = document.querySelector('.nav-bar .buttons-nav form[action="moncompte.php"] button.button1');
            if (navbarButton) {
                navbarButton.textContent = firstname;
            }
        }

        // Désactiver le bouton de soumission pendant la requête
        const submitButton = profileForm.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.textContent;
        submitButton.disabled = true;
        submitButton.textContent = 'Mise à jour...';

        const formData = new FormData(profileForm);
        formData.append('action', 'update_profile');

        fetch('update_profile.php', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Mettre à jour les valeurs stockées avec les nouvelles valeurs
                originalValues = {
                    firstname: data.data.firstname,
                    lastname: data.data.lastname
                };

                // Mettre à jour l'affichage du nom dans le titre
                const nomUtilisateurElements = document.querySelectorAll('#nomUtilisateur, .nomUtilisateur, [data-user-name]');
                nomUtilisateurElements.forEach(element => {
                    element.textContent = data.data.firstname;
                });

                // Mettre à jour les valeurs des champs du formulaire
                firstnameField.value = data.data.firstname;
                lastnameField.value = data.data.lastname;

                // Mettre à jour la navbar
                updateNavbarName(data.data.firstname);

                // Afficher un message de succès
                showSuccessMessage(data.message);

                console.log('Profil mis à jour avec succès:', data.data);
            } else {
                // En cas d'erreur, restaurer les valeurs précédentes
                firstnameField.value = originalValues.firstname;
                lastnameField.value = originalValues.lastname;
                
                showErrorMessage(data.message || 'Une erreur est survenue.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            
            // En cas d'erreur de réseau, restaurer les valeurs précédentes
            firstnameField.value = originalValues.firstname;
            lastnameField.value = originalValues.lastname;
            
            showErrorMessage('Une erreur est survenue lors de la communication avec le serveur.');
        })
        .finally(() => {
            // Réactiver le bouton de soumission
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
        });
    });

    // Fonction pour afficher un message de succès
    function showSuccessMessage(message) {
        showMessage(message, 'message-con-ok', 4000);
    }

    // Fonction pour afficher un message d'erreur
    function showErrorMessage(message) {
        showMessage(message, 'message-con-error', 5000);
    }

    // Fonction pour afficher un message d'information
    function showInfoMessage(message) {
        showMessage(message, 'message-con-info', 3000);
    }

    // Fonction générique pour afficher les messages
    function showMessage(message, className, duration) {
        // Supprimer les anciens messages
        removeExistingMessages();

        const messageContainer = document.createElement('div');
        messageContainer.className = `${className} show`;
        messageContainer.textContent = message;
        
        const main = document.querySelector('main');
        const profileContainer = document.querySelector('.profile-container');
        main.insertBefore(messageContainer, profileContainer);

        // Faire disparaître le message après la durée spécifiée
        setTimeout(() => {
            messageContainer.classList.remove('show');
            setTimeout(() => {
                if (messageContainer.parentNode) {
                    messageContainer.remove();
                }
            }, 300); // Attendre la fin de l'animation CSS
        }, duration);
    }

    // Fonction pour supprimer les messages existants
    function removeExistingMessages() {
        const existingMessages = document.querySelectorAll('.message-con-ok, .message-con-error, .message-con-info');
        existingMessages.forEach(msg => {
            if (msg.parentNode) {
                msg.remove();
            }
        });
    }

    // Validation en temps réel des champs
    [firstnameField, lastnameField].forEach(field => {
        field.addEventListener('input', function() {
            // Supprimer les espaces en début et fin
            const trimmedValue = this.value.trim();
            
            if (trimmedValue.length > 0) {
                this.classList.remove('error');
            } else {
                this.classList.add('error');
            }
        });

        // Restaurer la valeur originale si le champ est vidé
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                const fieldName = this.name;
                this.value = originalValues[fieldName];
                this.classList.remove('error');
            }
        });
    });

    // Ajouter un indicateur visuel des modifications non sauvegardées
    function checkForChanges() {
        const hasChanges = firstnameField.value !== originalValues.firstname || 
                          lastnameField.value !== originalValues.lastname;
        
        const submitButton = profileForm.querySelector('button[type="submit"]');
        if (hasChanges) {
            submitButton.classList.add('has-changes');
            submitButton.textContent = 'Sauvegarder les modifications';
        } else {
            submitButton.classList.remove('has-changes');
            submitButton.textContent = 'Mettre à jour';
        }
    }

    // Écouter les changements pour mettre à jour l'état du bouton
    [firstnameField, lastnameField].forEach(field => {
        field.addEventListener('input', checkForChanges);
    });

    // Vérifier l'état initial
    checkForChanges();
});