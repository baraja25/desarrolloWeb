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

/* Ejercicio 5 */

frase = "Javascript es increible, me encanta Javascript";

let nuevaFrase = frase.replace("Javascript", "Python");

console.log(nuevaFrase);

nuevaFrase = frase.replaceAll("Javascript", "Python");

console.log(nuevaFrase);

/* Ejercicio 6 */

let parte1 = "javascript";
let parte2 = " es";
let parte3 = " asombroso";

let frase2 = parte1.concat(parte2, parte3);

console.log(frase2);

/* Ejercicio 7 */

let nombre = " Alice ";

nombre = nombre.trim();

console.log(nombre);

/* Ejercicio 8 */

let oracion = "Me gusta aprender javascript";

let encontrado = oracion.includes("javascript");

console.log("javascript: ", encontrado);

encontrado = oracion.includes("python");

console.log("python: ",encontrado);


/* Ejercicio 9 */

let mensaje = "Bienvenido a la clase de javascript";

console.log("Empieza por bienvenido: ",mensaje.startsWith("Bienvenido"));

console.log("Termina con javascript: ", mensaje.endsWith("javascript"));

/* Ejercicio 10 */

palabra = "hola";

let repe = palabra.repeat(3);

console.log(repe);
