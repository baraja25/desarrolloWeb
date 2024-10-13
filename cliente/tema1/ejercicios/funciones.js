// Ejercicio 1
const sumar = function(a, b) {
    return a + b;
};

// Ejercicio 2
const numeros = [1, 2, 3, 4, 5, 6];
const numerosPares = numeros.filter(function(num) {
    return num % 2 === 0;
});


console.log(numerosPares); 

//Ejercicio 3

const crearContador = function() {
    let contador = 0;
    return function() {
        contador++;
        return contador;
    };
};

const contador = crearContador();

console.log(contador()); // Salida: 1
console.log(contador()); // Salida: 2
console.log(contador()); // Salida: 3