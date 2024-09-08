document.addEventListener('DOMContentLoaded', function() {
    const togglePasswords = document.querySelectorAll('.togglePassword');
    const passwordInputs = document.querySelectorAll('.password');

    togglePasswords.forEach(function(togglePassword, index) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = passwordInputs[index];
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
        });
    });
});
