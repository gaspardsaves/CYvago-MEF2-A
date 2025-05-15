// Script for calculating and updating price in real time
document.addEventListener('DOMContentLoaded', function() {
    console.log("Script de calcul de prix chargé");
    
    // Récupérer les éléments du DOM
    const basePriceElement = document.querySelector('.base-price');
    if (!basePriceElement) {
        console.error("Élément prix de base non trouvé");
        return;
    }
    
    // Convertir le prix de base en nombre
    const basePriceText = basePriceElement.textContent.trim();
    const basePrice = parseFloat(basePriceText.replace(/[^\d.,]/g, '').replace(',', '.'));
    
    console.log("Prix de base récupéré:", basePrice);
    
    // Autres éléments nécessaires
    const peopleSelectorOptions = document.querySelectorAll('.people-select');
    const optionItems = document.querySelectorAll('.option-item');
    const optionsPriceElement = document.querySelector('.options-price');
    const finalTotalElement = document.getElementById('finalTotal');
    const hiddenTotalPrice = document.getElementById('hiddenTotalPrice');
    const selectedOptionsElement = document.getElementById('selectedOptions');
    const priceSummary = document.querySelector('.price-summary');
    const numberOfPeopleSelect = document.getElementById('people');
    const perPersonLabel = document.getElementById('perPersonPrice');
    const basePriceDisplay = document.querySelector('.base-price-display');
    
    // Vérification supplémentaire
    if (!priceSummary) {
        console.error("Résumé des prix non trouvé");
        return;
    }
    
    // Update total price
    function updateTotalPrice() {
        console.log("Mise à jour du prix total");
        
        let optionsPrice = 0;
        let selectedOptionsHTML = '';
        let numberOfPeople = parseInt(numberOfPeopleSelect.value) || 1; // Par défaut 1 personne
        
        console.log("Nombre total de personnes:", numberOfPeople);
        
        // Reset selected class on all option items
        optionItems.forEach(item => item.classList.remove('option-item-selected'));
        
        // Calculate prices for selected options
        peopleSelectorOptions.forEach(selector => {
            const peopleForOption = parseInt(selector.value) || 0;
            
            if (peopleForOption > 0) {
                // Mark this option as selected
                const optionItem = selector.closest('.option-item');
                optionItem.classList.add('option-item-selected');
                
                const extraId = selector.dataset.extraId;
                const pricePerPerson = parseFloat(selector.dataset.price);
                
                if (isNaN(pricePerPerson)) {
                    console.error("Prix invalide pour l'option", extraId);
                    return;
                }
                
                const name = optionItem.querySelector('.option-title').textContent.trim();
                
                const totalOptionPrice = pricePerPerson * peopleForOption;
                optionsPrice += totalOptionPrice;
                
                console.log(`Option ${name}: ${pricePerPerson}€ × ${peopleForOption} pers = ${totalOptionPrice}€`);
                selectedOptionsHTML += `<div>• ${name} (${pricePerPerson}€ × ${peopleForOption} ${peopleForOption > 1 ? 'pers.' : 'pers.'} = ${totalOptionPrice}€)</div>`;
            }
        });
        
        // Calculer le prix du forfait de base
        const basePriceTotal = basePrice * numberOfPeople;
        const totalPrice = basePriceTotal + optionsPrice;
        
        console.log("Prix de base total:", basePriceTotal);
        console.log("Prix des options:", optionsPrice);
        console.log("Prix total:", totalPrice);
        
        // Mettre à jour l'affichage
        if (basePriceDisplay) {
            basePriceDisplay.textContent = basePriceTotal + '€';
            // Animer le changement
            basePriceDisplay.classList.add('price-changed');
            setTimeout(() => {
                basePriceDisplay.classList.remove('price-changed');
            }, 1500);
        }
        
        // Afficher les détails des personnes du forfait de base
        if (perPersonLabel) {
            perPersonLabel.textContent = `(${basePrice}€ × ${numberOfPeople} ${numberOfPeople > 1 ? 'personnes' : 'personne'})`;
            perPersonLabel.style.display = 'inline';
        }
        
        // Update option price display
        if (optionsPriceElement) {
            optionsPriceElement.textContent = optionsPrice + '€';
            optionsPriceElement.classList.add('price-changed');
            setTimeout(() => {
                optionsPriceElement.classList.remove('price-changed');
            }, 1500);
        }
        
        // Update final total
        if (finalTotalElement) {
            finalTotalElement.textContent = totalPrice + '€';
            finalTotalElement.classList.add('price-changed');
            setTimeout(() => {
                finalTotalElement.classList.remove('price-changed');
            }, 1500);
        }
        
        if (hiddenTotalPrice) {
            hiddenTotalPrice.value = totalPrice;
        }
        
        // Update selected options list
        if (selectedOptionsElement) {
            selectedOptionsElement.innerHTML = selectedOptionsHTML || '<div>Aucune option sélectionnée</div>';
        }
        
        // Visual effect for price summary panel
        if (priceSummary) {
            priceSummary.classList.remove('updated');
            void priceSummary.offsetWidth;
            priceSummary.classList.add('updated');
        }
    }
    
    // Event handlers for people selectors in options
    peopleSelectorOptions.forEach(selector => {
        console.log("Initialisation d'un sélecteur d'option");
        selector.addEventListener('change', function() {
            console.log("Changement du nombre de personnes pour une option:", this.value);
            updateTotalPrice();
        });
    });
    
    // Event handler for main people selector
    if (numberOfPeopleSelect) {
        console.log("Initialisation du sélecteur principal de personnes");
        numberOfPeopleSelect.addEventListener('change', function() {
            console.log("Changement du nombre total de personnes:", this.value);
            validatePeopleCount();
            updateTotalPrice();
        });
    }
    
    // Add validation - ensure option people count doesn't exceed total people
    function validatePeopleCount() {
        console.log("Validation du nombre de personnes pour les options");
        const totalPeople = parseInt(numberOfPeopleSelect.value);
        
        peopleSelectorOptions.forEach(selector => {
            // Reset options in the selector based on total people
            let currentValue = parseInt(selector.value) || 0;
            
            // Clear all options
            while (selector.firstChild) {
                selector.removeChild(selector.firstChild);
            }
            
            // Add "0 person" option
            const zeroOption = document.createElement('option');
            zeroOption.value = "0";
            zeroOption.textContent = "0 pers.";
            selector.appendChild(zeroOption);
            
            // Add options up to total people
            for (let i = 1; i <= totalPeople; i++) {
                const option = document.createElement('option');
                option.value = i;
                option.textContent = `${i} ${i > 1 ? 'pers.' : 'pers.'}`;
                selector.appendChild(option);
            }
            
            // Set the value back if it's valid, otherwise reset to 0
            if (currentValue > totalPeople) {
                selector.value = "0";
            } else {
                selector.value = currentValue.toString();
            }
        });
    }
    
    // Initial setup
    console.log("Configuration initiale");
    validatePeopleCount();
    
    // Initial calculation
    console.log("Calcul initial du prix");
    updateTotalPrice();
    
    console.log("Script de calcul de prix initialisé avec succès");
});