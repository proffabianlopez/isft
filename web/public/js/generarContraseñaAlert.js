function generatePassword(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas generar una nueva contraseña para este usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, generar contraseña'
    }).then((result) => {
        if (result.isConfirmed) {
            // Aquí puedes redirigir al usuario a la acción con la lógica necesaria
            window.location.href = 'index.php?pages=manageUser&action=generar_password&id_user=' + userId;
        }
    });
}