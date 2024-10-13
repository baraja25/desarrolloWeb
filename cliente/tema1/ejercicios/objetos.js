//Ejercicio 1
let automovil = {
    marca: "Toyota",
    modelo: "Corolla",
    año: 2020
};

console.log(automovil.marca);  // Toyota
console.log(automovil.modelo); // Corolla
console.log(automovil.año);    // 2020

automovil.color = "rojo";
console.log(automovil.color);  // rojo

//Ejercicio 2

let estudiante = {
    nombre: "Carlos",
    edad: 22,
    carrera: "Ingeniería Informática"
};
estudiante.edad = 23;
console.log(estudiante.edad);  // 23

delete estudiante.carrera;
console.log(estudiante);  // La propiedad 'carrera' ya no está

estudiante.promedio = 8.5;
console.log(estudiante);  // Ahora incluye 'promedio: 8.5'

// Ejercicio 3

let producto = {
    nombre: "Laptop",
    precio: 1500,
    disponible: true
};

for (let propiedad in producto) {
    console.log(propiedad + ": " + producto[propiedad]);
}

console.log(producto.hasOwnProperty('descuento'));  // false
