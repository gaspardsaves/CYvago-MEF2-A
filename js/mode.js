document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById("Clair-sombre");
    const body = document.querySelector("body");
    const text = document.getElementById("text");

    // Récupérer le mode actuel depuis le stockage local
    let lightmode = localStorage.getItem("light-mode");

    // Fonction pour activer le mode clair
    const enableLightMode = () => {
        body.classList.add("light-mode-theme");
        text.innerHTML = "Sombre"; // Quand on est en mode clair, le bouton propose de passer en mode sombre
        localStorage.setItem("light-mode", "enabled");
    };

    // Fonction pour désactiver le mode clair
    const disableLightMode = () => {
        body.classList.remove("light-mode-theme");
        text.innerHTML = "Clair"; // Quand on est en mode sombre, le bouton propose de passer en mode clair
        localStorage.setItem("light-mode", "disabled");
    };

    // Appliquer le mode enregistré au chargement de la page
    if (lightmode === "enabled") {
        enableLightMode();
    } else {
        disableLightMode(); // Par défaut, appliquer le mode sombre
    }

    // Gestionnaire d'événement pour le bouton
    button.addEventListener('click', function() {
        lightmode = localStorage.getItem("light-mode");
        if (lightmode === "disabled") {
            enableLightMode();
        } else {
            disableLightMode();
        }
    });
});