// Soumettre le formulaire automatiquement après 2 secondes
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        document.getElementById("paymentForm").submit();
    }, 2000);
});