// Ejercicio 1
function sumaArray(arr) {
    return arr.reduce((acc, num) => acc + num, 0);
}

// Ejercicio 2
function numeroMayor(arr) {
    return Math.max(...arr);
}

// Ejercicio 3
function filtrarPares(arr) {
    return arr.filter(num => num % 2 === 0);
}

// Ejercicio 4
function contarOcurrencias(arr, elemento) {
    return arr.filter(item => item === elemento).length;
}

// Ejercicio 5
function invertirArray(arr) {
    return arr.reverse();
}

// Ejercicio 6
function combinarArrays(arr1, arr2) {
    return arr1.concat(arr2);
}

// Ejercicio 7
function eliminarDuplicados(arr) {
    return [...new Set(arr)];
}

// Ejercicio 8
function ordenarArray(arr) {
    return arr.sort((a, b) => a - b);
}

// Ejercicio 9
function encontrarIndice(arr, elemento) {
    return arr.indexOf(elemento);
}

// Ejercicio 10
function convertirAMayusculas(arr) {
    return arr.map(cadena => cadena.toUpperCase());
}