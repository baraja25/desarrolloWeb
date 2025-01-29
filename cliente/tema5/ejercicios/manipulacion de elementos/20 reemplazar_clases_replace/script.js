document.getElementById('replaceClassButton').addEventListener('click', function () {
    const paragraph = document.getElementById('paragraph');
    paragraph.classList.replace('text-red', 'text-green'); // Reemplazar text-red con text-green
    console.log('Clase reemplazada:', paragraph.classList);
});