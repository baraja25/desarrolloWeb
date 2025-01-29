document.getElementById('removeClassButton').addEventListener('click', function() {
    const textElement = document.getElementById('textElement');
    textElement.classList.remove('bold'); // Eliminar la clase bold

    // Verificar si la clase bold fue eliminada y aplicar estilo normal
    if (!textElement.classList.contains('bold')) {
        textElement.classList.add('normal'); // Agregar clase normal si bold fue eliminada
    }

    console.log('Clase eliminada:', textElement.classList);
});