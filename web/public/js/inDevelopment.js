function inDevelopment(event) {
    event.preventDefault();
    Swal.fire({
        title: 'En desarrollo',
        text: 'Esta sección está en desarrollo. Pronto estará disponible.',
        icon: 'warning',
        confirmButtonText: 'OK!'
    });
}