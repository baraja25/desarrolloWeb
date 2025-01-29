document.getElementById('addClassButton').addEventListener('click', function() {
    const box = document.getElementById('box');
    box.classList.add('highlight'); // Agregar la clase highlight al elemento box
    console.log('Clase añadida:', box.classList);
});