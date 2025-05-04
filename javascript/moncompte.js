document.addEventListener('DOMContentLoaded', function() {
    // Objet pour stocker les modifications
    const modifs = {};

    // Gestion des boutons d'édition
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.target;
            const input = document.getElementById(id);
            
            // Activer l'édition du champ
            input.disabled = false;
            input.dataset.original = input.value;
            input.focus();

            // Cacher le bouton d'édition et afficher les boutons de sauvegarde/annulation
            btn.style.display = 'none';
            document.querySelector(`.save-btn[data-target="${id}"]`).style.display = 'inline-block';
            document.querySelector(`.cancel-btn[data-target="${id}"]`).style.display = 'inline-block';
        });
    });

    // Gestion des boutons d'annulation
    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.target;
            const input = document.getElementById(id);
            
            // Restaurer la valeur originale et désactiver l'édition
            input.value = input.dataset.original;
            input.disabled = true;

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
            
            // Désactiver l'édition du champ
            input.disabled = true;
    
            // Cacher les boutons de sauvegarde/annulation et afficher le bouton d'édition
            btn.style.display = 'none';
            document.querySelector(`.cancel-btn[data-target="${id}"]`).style.display = 'none';
            document.querySelector(`.edit-btn[data-target="${id}"]`).style.display = 'inline-block';
    
            // Stocker la modification et mettre à jour le champ caché
            modifs[id] = input.value;
            const hiddenInput = document.getElementById(`hidden-${id}`);
            if (hiddenInput) {
                hiddenInput.value = input.value;
            }
    
            // Vérifier s'il faut afficher le bouton soumettre
            toggleSubmitButton();
        });
    });

    // Fonction pour afficher/masquer le bouton soumettre en fonction des modifications
    function toggleSubmitButton() {
        const submitBtn = document.getElementById('submit-profile');
        if (Object.keys(modifs).length > 0) {
            submitBtn.style.display = 'block';
        } else {
            submitBtn.style.display = 'none';
        }
    }
});