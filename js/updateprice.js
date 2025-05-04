// Script for calculating and updating price in real time
document.addEventListener('DOMContentLoaded', function() {
    const basePrice = parseFloat(document.querySelector('.base-price').textContent);
    const optionCheckboxes = document.querySelectorAll('.option-checkbox');
    const optionsPriceElement = document.querySelector('.options-price');
    const finalTotalElement = document.getElementById('finalTotal');
    const hiddenTotalPrice = document.getElementById('hiddenTotalPrice'); // For form after
    const selectedOptionsElement = document.getElementById('selectedOptions');
    const priceSummary = document.querySelector('.price-summary');
            
    // Update total price
    function updateTotalPrice() {
        let optionsPrice = 0;
        let selectedOptionsHTML = '';
        // Detection of options
        optionCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const price = parseFloat(checkbox.dataset.price);
                const name = checkbox.dataset.name;
                optionsPrice += price;
                selectedOptionsHTML += `<div>• ${name} (+${price}€)</div>`;
            }
        });
        // Total price
        const totalPrice = basePrice + optionsPrice; 
        // Update on screen
        optionsPriceElement.textContent = optionsPrice + '€';
        finalTotalElement.textContent = totalPrice + '€';
        if (hiddenTotalPrice) {
            hiddenTotalPrice.value = totalPrice;
        }
        selectedOptionsElement.innerHTML = selectedOptionsHTML || '<div>Aucune option sélectionnée</div>'; 
        // Visual effect
        priceSummary.classList.add('updated');
        setTimeout(() => {
            priceSummary.classList.remove('updated');
        }, 1000);
    }
            
    // Detection of option changes
    optionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });
    updateTotalPrice();
});