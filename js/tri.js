document.addEventListener('DOMContentLoaded', function() {
    // Récupération des élement à filtrer
    const saisonSelect = document.querySelector('select[name="Saison"]');
    const prixSelect = document.querySelector('select[name="Prix"]');
    const paysCheckboxes = document.querySelectorAll('input[name="Country"]');
    
    // Gestion des accents
    function normaliserTexte(texte) {
        return texte.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
    
    // Fonction de filtrage
    function filtrage() {
        // Récupération des valeurs saisies
        const saisonChoisie = saisonSelect ? normaliserTexte(saisonSelect.value.toLowerCase()) : '';
        const prixChoisi = prixSelect ? prixSelect.value : '';
        
        // Récupération des pays sélectionnés
        const paysSelectionnes = [];
        if (paysCheckboxes) {
            paysCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    paysSelectionnes.push(normaliserTexte(checkbox.value.toLowerCase()));
                }
            });
        }
        
        // Parcours des séjours pour le filtrage
        const sejoursElements = document.querySelectorAll('.image-interactive');
        let sejourVisible = false;
        
        sejoursElements.forEach(sejour => {
            // Filtres par défaut (si attributs HTML non défini)
            let matchSaison = true;
            let matchPrix = true;
            let matchPays = true;
            
            // Filtrage par saison (si attribut défini)
            if (sejour.hasAttribute('data-season') && saisonChoisie) {
                const season = normaliserTexte(sejour.getAttribute('data-season').toLowerCase());
                matchSaison = season.includes(saisonChoisie);
            }
            
            // Filtrage par prix (si attribut défini)
            if (sejour.hasAttribute('data-price') && prixChoisi) {
                const price = parseFloat(sejour.getAttribute('data-price'));
                let prixMin = 0;
                let prixMax = Infinity;
                if (prixChoisi === '1000euro-2000euro') {
                    prixMin = 1000;
                    prixMax = 2000;
                } else if (prixChoisi === '2001euro-3000euro') {
                    prixMin = 2001;
                    prixMax = 3000;
                } else if (prixChoisi === 'plus3000euros') {
                    prixMin = 3001;
                }
                
                matchPrix = (price >= prixMin && price <= prixMax);
            }
            
            // Filtre par pays (si pays sélectionné)
            if (sejour.hasAttribute('data-title') && paysSelectionnes.length > 0) {
                const title = normaliserTexte(sejour.getAttribute('data-title').toLowerCase());
                
                // Table de correspondance pays
                const mappingPays = {
                    'china': ['chine'],
                    'australia': ['australie'],
                    'bresil': ['bresil', 'capybara'],
                    'imaginaire': ['licorne', 'dragon', 'chewbaca'],
                    'nepal': ['nepal', 'everest'],
                    'antarctique': ['antarctique']
                };
                
                // Vérification des éventuelles correspondances
                matchPays = false;
                for (const paysSelection of paysSelectionnes) {
                    const synonymes = mappingPays[paysSelection] || [];
                    if (title.includes(paysSelection) || 
                        synonymes.some(s => title.includes(s))) {
                        matchPays = true;
                        break;
                    }
                }
            }
            
            // Application des filtres
            if (matchSaison && matchPrix && matchPays) {
                sejour.style.display = '';
                sejourVisible = true;
            } else {
                sejour.style.display = 'none';
            }
        });
        
        // Affichage du message d'échec en l'absence de correspondance
        const messagePasDeResultat = document.getElementById('no-results-message');
        if (messagePasDeResultat) {
            messagePasDeResultat.style.display = sejourVisible ? 'none' : 'block';
        } else if (!sejourVisible) {
            const message = document.createElement('p');
            message.id = 'no-results-message';
            message.textContent = 'Aucun séjour ne correspond à vos critères de recherche.';
            message.style.textAlign = 'center';
            message.style.fontSize = '1.2rem';
            message.style.padding = '20px';
            message.style.color = 'white';
            
            const conteneurOffre = document.querySelector('.offre');
            if (conteneurOffre) {
                conteneurOffre.appendChild(message);
            }
        }
    }
    
    // Détection des modifications de l'utilisateur
    if (saisonSelect) {
        saisonSelect.addEventListener('change', filtrage);
    }
    if (prixSelect) {
        prixSelect.addEventListener('change', filtrage);
    }
    if (paysCheckboxes) {
        paysCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', filtrage);
        });
    }

    filtrage();
});