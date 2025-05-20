document.addEventListener('DOMContentLoaded', function() {
    // Objet pour stocker les modifications
    const modifs = {};

    // Vérifier si un message de notification est présent
    const messageDiv = document.querySelector('.message-con-ok');
    if (messageDiv) {
        // Faire disparaître le message après 5 secondes
        setTimeout(() => {
            messageDiv.classList.remove('show');
            setTimeout(() => messageDiv.style.display = 'none', 500);
        }, 5000);
    }

    // Gestion des boutons d'édition
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.target;
            const input = document.getElementById(id);
            
            // Activer l'édition du champ
            input.readOnly = false;
            input.dataset.original = input.value;
            input.focus();

            // Cacher le bouton d'édition et afficher les boutons de sauvegarde/annulation
            btn.style.display = 'none';
            document.querySelector(`.save-btn[data-target="${id}"]`).style.display = 'inline-block';
            document.querySelector(`.cancel-btn[data-target="${id}"]`).style.display = 'inline-block';
            
            // Cas particulier pour le mot de passe
            if (id === 'password') {
                input.value = ''; // Effacer les astérisques
                input.placeholder = 'Nouveau mot de passe';
            }
        });
    });

    // Gestion des boutons d'annulation
    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.target;
            const input = document.getElementById(id);
            
            // Restaurer la valeur originale et désactiver l'édition
            if (id === 'password') {
                input.value = '';
                input.placeholder = '••••••••';
            } else {
                input.value = input.dataset.original;
            }
            
            input.readOnly = true;

            // Cacher les boutons de sauvegarde/annulation et afficher le bouton d'édition
            btn.style.display = 'none';
            document.querySelector(`.save-btn[data-target="${id}"]`).style.display = 'none';
            document.querySelector(`.edit-btn[data-target="${id}"]`).style.display = 'inline-block';

            // Supprimer la modification de l'objet modifs et vérifier s'il faut afficher le bouton soumettre
            delete modifs[id];
            toggleSubmitButton();
        });
    });

    // Gestion des boutons de sauvegarde
    document.querySelectorAll('.save-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.target;
            const input = document.getElementById(id);
            
            // Validation simple
            if (id === 'email' && !validateEmail(input.value)) {
                alert('Veuillez entrer un email valide');
                return;
            }
            
            if (id === 'password' && input.value.length > 0 && input.value.length < 8) {
                alert('Le mot de passe doit contenir au moins 8 caractères');
                return;
            }
            
            if (id === 'phone' && input.value && !validatePhone(input.value)) {
                alert('Veuillez entrer un numéro de téléphone valide');
                return;
            }
            
            // Désactiver l'édition du champ mais garder la valeur accessible pour l'envoi du formulaire
            input.readOnly = true;
    
            // Cacher les boutons de sauvegarde/annulation et afficher le bouton d'édition
            btn.style.display = 'none';
            document.querySelector(`.cancel-btn[data-target="${id}"]`).style.display = 'none';
            document.querySelector(`.edit-btn[data-target="${id}"]`).style.display = 'inline-block';
    
            // Stocker la modification
            if (id === 'password' && input.value.length === 0) {
                delete modifs[id]; // Ne pas envoyer de mot de passe vide
            } else {
                modifs[id] = input.value;
            }
    
            // Vérifier s'il faut afficher le bouton soumettre
            toggleSubmitButton();
        });
    });

    // Fonction pour valider un email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
    
    // Fonction pour valider un numéro de téléphone
    function validatePhone(phone) {
        return phone.length >= 10;
    }

    // Fonction pour afficher/masquer le bouton soumettre en fonction des modifications
    function toggleSubmitButton() {
        const submitBtn = document.getElementById('submit-profile');
        if (Object.keys(modifs).length > 0) {
            submitBtn.style.display = 'block';
        } else {
            submitBtn.style.display = 'none';
        }
    }
    
    // Gérer la soumission du formulaire
    document.getElementById('profile-form').addEventListener('submit', function(e) {
        // Activer tous les champs avant soumission pour qu'ils soient envoyés
        document.querySelectorAll('input[readonly]').forEach(input => {
            if (modifs[input.id]) {
                input.readOnly = false;
            }
        });
    });
});