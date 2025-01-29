document.getElementById('toggleVisibilityButton').addEventListener('click', function() {
    const hiddenText = document.getElementById('hiddenText');
    hiddenText.classList.toggle('hidden'); // Alternar la clase 'hidden'

    // Opcional: Cambiar el texto del botón según la visibilidad
    if (hiddenText.classList.contains('hidden')) {
        this.textContent = 'Mostrar'; // Cambia el texto del botón a "Mostrar"
    } else {
        this.textContent = 'Ocultar'; // Cambia el texto del botón a "Ocultar"
    }
});