
function togglePasswordVisibility(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(iconId);
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.src = 'img/eye-open.png';
        toggleIcon.alt = 'Masquer le mot de passe';
    } else {
        passwordField.type = 'password';
        toggleIcon.src = 'img/eye-close.png';
        toggleIcon.alt = 'Voir le mot de passe';
    }
    passwordField.focus();
    const length = passwordField.value.length;
    passwordField.setSelectionRange(length, length);
}


function validateForm() {
    const email = document.getElementById('AdresseMail').value;
    const password = document.getElementById('MotDePasse').value;
    let isValid = true;


    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const emailError = document.getElementById('emailError');
    if (!emailRegex.test(email)) {
        emailError.textContent = 'L\'adresse email n\'est pas valide.';
        isValid = false;
    } else {
        emailError.textContent = '';
    }

    const passwordError = document.getElementById('passwordError');
    if (password.length < 6) {
        passwordError.textContent = 'Le mot de passe doit contenir au moins 6 caractères.';
        isValid = false;
    } else {
        passwordError.textContent = '';
    }

    return isValid;
}


function checkLoginError() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('error')) {
        const errorType = urlParams.get('error');
        const messageElement = document.getElementById('loginErrorMessage');
        if (errorType === 'password') {
            messageElement.textContent = 'Le mot de passe ne correspond pas.';
        } else if (errorType === 'user') {
            messageElement.textContent = 'L\'adresse email n\'existe pas.';
        }
    }
}


document.getElementById('loginForm').addEventListener('submit', function(event) {
    if (!validateForm()) {
        event.preventDefault(); 
    }
});


document.getElementById('MotDePasse').addEventListener('input', function() {
    const charCount = document.getElementById('passwordCount');
    charCount.textContent = this.value.length + ' caractères';
});


document.addEventListener('DOMContentLoaded', checkLoginError);

if (document.getElementById('togglePassword')) {
    document.getElementById('togglePassword').onclick = function() {
        togglePasswordVisibility('MotDePasse', 'togglePassword');
    };
}