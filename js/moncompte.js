document.addEventListener('DOMContentLoaded', function () {
    const profileForm = document.getElementById('profile-form');
    const firstnameField = document.getElementById('firstname');
    const lastnameField = document.getElementById('lastname');
    const nomUtilisateur = document.getElementById('nomUtilisateur');

    profileForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(profileForm);
        formData.append('action', 'update_profile');

        fetch('update_profile.php', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour l'affichage du nom dans le titre
                if (nomUtilisateur) {
                    nomUtilisateur.textContent = `${data.data.firstname} ${data.data.lastname}`;
                }

                // Mettre à jour les valeurs des champs du formulaire
                firstnameField.value = data.data.firstname;
                lastnameField.value = data.data.lastname;

                // Afficher un message de succès
                const messageContainer = document.createElement('div');
                messageContainer.className = 'message-con-ok show';
                messageContainer.textContent = data.message;
                document.querySelector('main').insertBefore(messageContainer, document.querySelector('.profile-container'));

                // Faire disparaître le message après 3 secondes
                setTimeout(() => {
                    messageContainer.remove();
                }, 3000);
            } else {
                alert(data.message || 'Une erreur est survenue.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de la communication avec le serveur.');
        });
    });
});