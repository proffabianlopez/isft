const loginForm = document.getElementById("login-form");
const forgotPasswordForm = document.getElementById("forgot-password-form");
const forgotPasswordLink = document.getElementById("forgot-password-link");
const backToLoginLink = document.getElementById("back-to-login-link");
const note = document.getElementById("password-note");

forgotPasswordLink.addEventListener('click', function (event) {
    event.preventDefault();
    loginForm.style.display = 'none';
    note.style.display = 'none';
    forgotPasswordForm.style.display = 'block';
});

backToLoginLink.addEventListener('click', function (event) {
    event.preventDefault();
    forgotPasswordForm.style.display = 'none';
    note.style.display = 'block';
    loginForm.style.display = 'block';
});