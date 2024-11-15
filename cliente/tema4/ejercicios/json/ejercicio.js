//ejercicio 1
const persona = {
    nombre: "Juan",
    edad: 25,
    profesion: "Desarrollador"
};

const jsonPersona = JSON.stringify(persona);

console.log(jsonPersona);


// ejercicio 2
const jsonString = '{"nombre": "Ana", "edad": 30, "ciudad": "Madrid"}';

const objetoAna = JSON.parse(jsonString);

console.log(objetoAna.ciudad);

//ejercicio 3
 let frutas = ["manzana", "banana", "naranja"];

 const jsonFrutas = JSON.stringify(frutas);

 console.log(jsonFrutas);

 //ejercicio 4

 
