/* funcion anonima + closure
createCounter es una función que se ejecuta inmediatamente y devuelve otra función.

La variable count es privada y solo puede ser modificada a través de la función interna, creando un closure.
*/
const createCounter = (function () {

    let count = 0; // Variable privada

    return function () {
        count++; // Incrementa el contador
        return count; // Devuelve el nuevo valor
    };

});

// Ejemplo de uso
console.log(createCounter()); // 1
console.log(createCounter()); // 2
console.log(createCounter()); // 3


/* Conversion a tipo arrow */

function sumar(a, b) {
    return a + b;
}

// Ejemplo de uso
console.log(sumar(2, 3)); // 5
/* Arrow */
const sumarArrow = (a, b) => a + b;

// Ejemplo de uso
console.log(sumarArrow(2, 3)); // 5

