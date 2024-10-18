// 1. Declara dos variables `a` y `b` con valores numéricos
let a = 20; // Puedes elegir cualquier valor numérico
let b = 5;  // Puedes elegir cualquier valor numérico

// 2. Realiza las operaciones aritméticas
let suma = a + b;
let resta = a - b;
let multiplicacion = a * b;
let division = a / b;

// 3. Muestra los resultados en la consola
console.log("Suma:", suma);               // Muestra la suma
console.log("Resta:", resta);             // Muestra la resta
console.log("Multiplicación:", multiplicacion); // Muestra la multiplicación
console.log("División:", division);       // Muestra la división

// 4. Utiliza un operador de asignación para sumar 10 a `a`
a += 10; // Sumar 10 a `a`

// Muestra el nuevo valor de `a` en la consola
console.log("Nuevo valor de a:", a);

/*----------------------------------------------------------------------------------- */
// 1. Declara una variable `nombre` y asígnale tu nombre
let nombre = "TuNombre"; // Reemplaza "TuNombre" con tu nombre

// 2. Concatenar `nombre` con otra cadena para formar un saludo
let saludo = "Hola, " + nombre + "!";
console.log(saludo); // Muestra el saludo en la consola

// 3. Declara una variable `edad` y asígnale un valor numérico
let edad = 25; // Reemplaza 25 con tu edad

// 4. Usa operadores lógicos para verificar si la persona es mayor de edad y menor de 65
let esMayorDeEdad = edad >= 18 && edad < 65;
console.log("¿Es mayor de edad y menor de 65?:", esMayorDeEdad);

// 5. Verifica si la persona está jubilada (65 años o más)
let estaJubilado = edad >= 65;
console.log("¿Está jubilado?:", estaJubilado);
/*------------------------------------------------------------------------------------------ */
// 1. Declara dos variables, `x` y `y`
let x = 12;          // Valor numérico
let y = "5";        // Valor de cadena que representa el mismo número

// 2. Verifica si `x` y `y` son iguales en valor y tipo
let sonIgualesValor = (x == y);
let sonIgualesValorTipo = (x === y);

console.log("¿x y y son iguales en valor? (==):", sonIgualesValor); // true
console.log("¿x y y son iguales en valor y tipo? (===):", sonIgualesValorTipo); // false

// 3. Usa operadores bitwise para realizar una operación AND y OR
let andResultado = x & 1; // AND
let orResultado = x | 2;  // OR

console.log("Resultado de x AND 1:", andResultado); 
console.log("Resultado de x OR 1:", orResultado);   

// 4. Usa el operador `typeof` para mostrar el tipo de dato de las variables
console.log("Tipo de x:", typeof x); // "number"
console.log("Tipo de y:", typeof y); // "string"
