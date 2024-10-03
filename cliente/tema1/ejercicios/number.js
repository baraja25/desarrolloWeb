/* Ejercicio 1 */
let num1 = 3.14159;
let num2 = 5.6789;

let resultado1 = num1.toFixed(2); // Debería devolver "3.14"
let resultado2 = num2.toFixed(2); // Debería devolver "5.68"

console.log(resultado1); // Imprime "3.14"
console.log(resultado2); // Imprime "5.68"

/* Ejercicio 2 */

let numero = 255;

let binario = numero.toString(2); // Convierte a binario (base 2)
let hexadecimal = numero.toString(16); // Convierte a hexadecimal (base 16)
let octal = numero.toString(8); // Convierte a octal (base 8)

console.log("Binario:", binario); // Debería devolver "11111111"
console.log("Hexadecimal:", hexadecimal); // Debería devolver "ff"
console.log("Octal:", octal); // Debería devolver "377"

/* Ejercicio 3 */

let numeroConPrecision = 3.14159;

let precision4 = numeroConPrecision.toPrecision(4); // Precisión de 4 dígitos
let precision6 = numeroConPrecision.toPrecision(6); // Precisión de 6 dígitos

console.log("Precisión de 4 dígitos:", precision4); // Debería devolver "3.142"
console.log("Precisión de 6 dígitos:", precision6); // Debería devolver "3.14159"


/* Ejercicio 4 */

let numObj1 = new Number(10);
let numObj2 = new Number(10);

let sonIguales = numObj1.valueOf() === numObj2.valueOf(); // Compara los valores primitivos

console.log("¿Son iguales?", sonIguales); // Debería devolver true

/* Ejercicio 5 */

let arrayNumeros = [1, 2.5, 3, 4.1, 5];

let esEntero1 = Number.isInteger(arrayNumeros[0]); // true
let esEntero2 = Number.isInteger(arrayNumeros[1]); // false
let esEntero3 = Number.isInteger(arrayNumeros[2]); // true
let esEntero4 = Number.isInteger(arrayNumeros[3]); // false
let esEntero5 = Number.isInteger(arrayNumeros[4]); // true

console.log(esEntero1, esEntero2, esEntero3, esEntero4, esEntero5);
// Debería devolver: true false true false true

/* Ejercicio 6 */

let arrayStrings = ["10", "20.5", "30"];

let numConvertido1 = Number(arrayStrings[0]); // Convierte "10" a 10
let numConvertido2 = Number(arrayStrings[1]); // Convierte "20.5" a 20.5
let numConvertido3 = Number(arrayStrings[2]); // Convierte "30" a 30

console.log(numConvertido1, numConvertido2, numConvertido3);
// Debería devolver: 10 20.5 30

/* Ejercicio 7 */

let valores = [10, "hola", NaN, "123", true];

let esNaN1 = isNaN(valores[0]); // false, 10 es un número
let esNaN2 = isNaN(valores[1]); // true, "hola" no es un número
let esNaN3 = isNaN(valores[2]); // true, NaN no es un número
let esNaN4 = isNaN(valores[3]); // false, "123" es un número cuando se convierte
let esNaN5 = isNaN(valores[4]); // false, true es tratado como 1 (número)

console.log(esNaN1, esNaN2, esNaN3, esNaN4, esNaN5);
// Debería devolver: false true true false false
