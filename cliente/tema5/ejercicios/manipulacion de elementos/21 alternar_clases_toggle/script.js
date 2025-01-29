document.getElementById('toggleButton').addEventListener('click', function() {
    this.classList.toggle('active'); // Alternar la clase 'active'
    console.log('Clase activa:', this.classList.contains('active')); // Verificar si la clase está activa
});