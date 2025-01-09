// Función para mostrar números del 1 al 5 con un segundo de diferencia
function showNumbers() {
    for (let i = 1; i <= 5; i++) {
        setTimeout(() => {
            console.log(i);
        }, i * 1000); // Multiplica el índice por 1000 para el retraso
    }
}


showNumbers();