document.getElementById('addAttributes').addEventListener('click', function() {
    const targetDiv = document.getElementById('targetDiv');
    targetDiv.setAttribute('data-user', '123');
    targetDiv.setAttribute('role', 'alert');
    console.log('Atributos agregados:', targetDiv.attributes);
});

document.getElementById('removeAttributes').addEventListener('click', function() {
    const targetDiv = document.getElementById('targetDiv');

    if (targetDiv.hasAttributes()) {
        // Iterar sobre los atributos y eliminarlos
        while (targetDiv.attributes.length > 0) {
            targetDiv.removeAttribute(targetDiv.attributes[0].name);
        }
        console.log('Atributos eliminados:', targetDiv.attributes);
    } else {
        console.log('No hay atributos para eliminar.');
    }
});