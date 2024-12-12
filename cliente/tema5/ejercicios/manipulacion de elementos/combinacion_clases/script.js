document.getElementById('actionButton').addEventListener('click', function() {
    const multiBox = document.getElementById('multiBox');

    // Agregar la clase 'bordered'
    multiBox.classList.add('bordered');

    // Eliminar la clase 'box' si está presente
    if (multiBox.classList.contains('box')) {
        multiBox.classList.remove('box');
    }

    // Reemplazar la clase 'bordered' con 'highlighted' si existe
    if (multiBox.classList.contains('bordered')) {
        multiBox.classList.replace('bordered', 'highlighted');
    }

    // Alternar la clase 'visible'
    multiBox.classList.toggle('visible');

    // Si la clase 'visible' no está presente, agregar la clase 'hidden'
    if (!multiBox.classList.contains('visible')) {
        multiBox.classList.add('hidden');
    } else {
        multiBox.classList.remove('hidden');
    }

    console.log('Clases actuales:', multiBox.classList);
});