document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('.togglePassword');
    const passwordInput = document.querySelector('.password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
    });
});