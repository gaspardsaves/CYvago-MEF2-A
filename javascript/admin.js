document.addEventListener('DOMContentLoaded', () => {
    const updateUserStatus = (userId, type, value) => {
        const formData = new FormData();
        formData.append('userId', userId);
        formData.append('type', type);
        formData.append('value', value ? 1 : 0);

        return fetch('update_profile.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau lors de la mise à jour');
            }
            return response.json();
        });
    };

    
    const handleStatusUpdate = (checkbox, type) => {
        
        const userId = checkbox.dataset.userId;
        const newValue = checkbox.checked;
        
       
        checkbox.disabled = true;
        
        
        const sliderElement = checkbox.nextElementSibling;
        sliderElement.classList.add('updating');
        
        console.log(`Simulation de mise à jour pour ${type} de l'utilisateur ID ${userId}`);
        
        
        setTimeout(() => {
            
            updateUserStatus(userId, type, newValue)
                .then(response => {
                    console.log(`Mise à jour réussie pour ${type} ID ${userId}`);
                    
                })
                .catch(error => {
                    console.error('Erreur:', error);
                  
                    checkbox.checked = !newValue;
                    alert(`Erreur lors de la mise à jour du statut ${type}. Veuillez réessayer.`);
                })
                .finally(() => {
                   
                    checkbox.disabled = false;
                    sliderElement.classList.remove('updating');
                });
        }, 3000);
    };

    
    document.querySelectorAll('.vip-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            handleStatusUpdate(checkbox, 'vip');
        });
    });

  
    document.querySelectorAll('.ban-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            handleStatusUpdate(checkbox, 'ban');
        });
    });
});