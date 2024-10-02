/* Ejercicio 1  */
function createCounter() {
    let contador = 0;  // Inicializamos una variable 'contador' que almacenará el número actual

    // Definimos una función interna llamada 'incrementar' que aumenta el valor de 'contador'
    function incrementar() {
        return ++contador;  // Incrementa el valor de 'contador' en 1 y lo devuelve
    }

    return incrementar;  // Devolvemos la referencia a la función 'incrementar', NO la ejecutamos
}

// Al llamar 'createCounter()', obtenemos la función 'incrementar' con su propio 'contador'
const counter = createCounter();

console.log(counter());  // Llamamos a 'counter()', lo que ejecuta 'incrementar' y devuelve 1
console.log(counter());  // Llamamos a 'counter()' de nuevo, lo que incrementa y devuelve 2
console.log(counter());  // Tercera llamada, incrementa y devuelve 3
