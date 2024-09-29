/*Ejercicio 1 */
let texto = "Javascript es divertido!";
let mayusculas = texto.toUpperCase();
let minusculas = texto.toLowerCase();


console.log(mayusculas);
console.log(minusculas);

/*Ejercicio 2*/

let saludo = "Hola mundo";

primerCaracter = saludo.charAt(0);
indiceLetra = saludo.indexOf("m");

console.log(primerCaracter);
console.log(indiceLetra);

/* Ejercicio 3 */

let frase = "Aprendiendo javascript es muy interesante";



let palabra = frase.slice(12, 22);

console.log(palabra);

palabra = frase.slice(-12);

console.log(palabra);

/* Ejercicio 4 */

let palabras = "rojo,azul,verde,amarillo";

palabra = palabras.split(",");

for (let index = 0; index < palabra.length; index++) {
    const element = palabra[index];
    console.log(element);
}

frase = palabra.join(",");

console.log(frase);





