// Script for calculating and updating price in real time
document.addEventListener('DOMContentLoaded', function() {
    console.log("Script de calcul de prix initialisé");
    
    // Récupération des éléments nécessaires
    const basePrice = parseFloat(document.querySelector('.base-price').textContent.replace(/[^\d,.-]/g, '').replace(',', '.'));
    const peopleSelectorOptions = document.querySelectorAll('.people-select');
    const numberOfPeopleSelect = document.getElementById('people');
    const basePriceDisplay = document.querySelector('.base-price-display');
    const optionsPriceElement = document.querySelector('.options-price');
    const finalTotalElement = document.getElementById('finalTotal');
    const hiddenTotalPrice = document.getElementById('hiddenTotalPrice');
    const selectedOptionsElement = document.getElementById('selectedOptions');
    const perPersonLabel = document.getElementById('perPersonPrice');
    
    // Vérification des éléments requis
    if (!basePrice || isNaN(basePrice)) {
        console.error("Prix de base invalide ou non trouvé");
        return;
    }
    
    console.log("Prix de base:", basePrice, "€");
    console.log("Nombre de sélecteurs d'options:", peopleSelectorOptions.length);
    
    // Fonction de calcul et mise à jour du prix total
    function updateTotalPrice() {
        // Nombre total de personnes pour le voyage
        const totalPeople = parseInt(numberOfPeopleSelect.value) || 1;
        console.log("Nombre de personnes pour le voyage:", totalPeople);
        
        // Prix de base pour toutes les personnes
        const totalBasePrice = basePrice * totalPeople;
        console.log("Prix de base total:", totalBasePrice, "€");
        
        // Calcul du prix des options
        let optionsPrice = 0;
        let selectedOptionsHTML = '';
        
        peopleSelectorOptions.forEach(selector => {
            const optionPeople = parseInt(selector.value) || 0;
            if (optionPeople > 0) {
                const optionPrice = parseFloat(selector.getAttribute('data-price'));
                const optionId = selector.getAttribute('data-extra-id');
                
                if (isNaN(optionPrice)) {
                    console.warn("Prix invalide pour l'option", optionId);
                    return;
                }
                
                const optionTitle = selector.closest('.option-item').querySelector('.option-title').textContent;
                const optionTotalPrice = optionPrice * optionPeople;
                
                optionsPrice += optionTotalPrice;
                
                console.log(`Option "${optionTitle}": ${optionPrice}€ × ${optionPeople} pers = ${optionTotalPrice}€`);
                selectedOptionsHTML += `<div class="selected-option">• ${optionTitle} (${optionPrice}€ × ${optionPeople} pers. = ${optionTotalPrice}€)</div>`;
                
                // Marquer cette option comme sélectionnée
                selector.closest('.option-item').classList.add('option-item-selected');
            } else {
                // Désélectionner cette option
                selector.closest('.option-item').classList.remove('option-item-selected');
            }
        });
        
        // Prix total
        const totalPrice = totalBasePrice + optionsPrice;
        console.log("Prix des options:", optionsPrice, "€");
        console.log("Prix total:", totalPrice, "€");
        
        // Mise à jour de l'affichage
        if (basePriceDisplay) {
            basePriceDisplay.textContent = totalBasePrice + '€';
        }
        
        if (perPersonLabel) {
            perPersonLabel.textContent = `(${basePrice}€ × ${totalPeople} ${totalPeople > 1 ? 'personnes' : 'personne'})`;
        }
        
        if (optionsPriceElement) {
            optionsPriceElement.textContent = optionsPrice + '€';
            // Animation de mise en évidence
            optionsPriceElement.classList.add('price-changed');
            setTimeout(() => optionsPriceElement.classList.remove('price-changed'), 1000);
        }
        
        if (finalTotalElement) {
            finalTotalElement.textContent = totalPrice + '€';
            // Animation de mise en évidence
            finalTotalElement.classList.add('price-changed');
            setTimeout(() => finalTotalElement.classList.remove('price-changed'), 1000);
        }
        
        if (hiddenTotalPrice) {
            hiddenTotalPrice.value = totalPrice;
        }
        
        if (selectedOptionsElement) {
            selectedOptionsElement.innerHTML = selectedOptionsHTML || '<div class="no-selected-option">Aucune option sélectionnée</div>';
        }
    }
    
    // Fonction pour ajuster les options disponibles en fonction du nombre de personnes
    function adjustOptionSelectors() {
        const totalPeople = parseInt(numberOfPeopleSelect.value) || 1;
        
        peopleSelectorOptions.forEach(selector => {
            // Sauvegarder la valeur actuelle
            const currentValue = parseInt(selector.value) || 0;
            
            // Vider le sélecteur
            selector.innerHTML = '';
            
            // Option 0 personne
            const option0 = document.createElement('option');
            option0.value = '0';
            option0.textContent = '0 pers.';
            selector.appendChild(option0);
            
            // Options de 1 à N personnes
            for (let i = 1; i <= totalPeople; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = `${i} pers.`;
                selector.appendChild(option);
            }
            
            // Rétablir la valeur si possible, ou mettre à 0
            if (currentValue > totalPeople) {
                selector.value = '0';
            } else {
                selector.value = currentValue.toString();
            }
        });
        
        // Mettre à jour le prix après ajustement
        updateTotalPrice();
    }
    
    // Ajout des écouteurs d'événements
    if (numberOfPeopleSelect) {
        numberOfPeopleSelect.addEventListener('change', function() {
            console.log("Changement du nombre total de personnes:", this.value);
            adjustOptionSelectors();
        });
    }
    
    peopleSelectorOptions.forEach(selector => {
        selector.addEventListener('change', function() {
            console.log("Option modifiée:", this.dataset.extraId, "Personnes:", this.value);
            updateTotalPrice();
        });
    });
    
    // Initialisation
    adjustOptionSelectors();
    updateTotalPrice();
    
    console.log("Script de calcul de prix chargé avec succès");
});