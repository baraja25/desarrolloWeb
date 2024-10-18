// Ejercicio 1
function calcularRaizCuadrada(num) {
    if (num < 0) {
        throw new Error("No se puede calcular la raíz cuadrada de un número negativo");
    }
    return Math.sqrt(num);
}

try {
    console.log(calcularRaizCuadrada(9));   // 3
    console.log(calcularRaizCuadrada(-1));  // Lanza error
} catch (error) {
    console.error(error.message);
}

// Ejercicio 2

function invertirCadena(cadena) {
    if (typeof cadena !== 'string') {
        throw new Error("El argumento debe ser una cadena");
    }
    return cadena.split("").reverse().join("");
}

try {
    console.log(invertirCadena("hola"));    // "aloh"
    console.log(invertirCadena(1234));      // Lanza error
} catch (error) {
    console.error(error.message);
}

// Ejercicio 3

function sumarElementosArray(arr) {
    if (!Array.isArray(arr) || arr.length === 0) {
        throw new Error("El argumento debe ser un array no vacío");
    }
    let suma = 0;
    for (let num of arr) {
        if (typeof num !== 'number') {
            throw new Error("Todos los elementos deben ser numéricos");
        }
        suma += num;
    }
    return suma;
}

try {
    console.log(sumarElementosArray([1, 2, 3]));      // 6
    console.log(sumarElementosArray([1, "dos", 3]));  // Lanza error
} catch (error) {
    console.error(error.message);
}


// Ejercicio 4

function validarEdad(edad) {
    if (!Number.isInteger(edad) || edad <= 0) {
        throw new Error("La edad debe ser un número entero mayor a 0");
    }
    return true;
}

try {
    console.log(validarEdad(25));    // true
    console.log(validarEdad(-5));    // Lanza error
} catch (error) {
    console.error(error.message);
}


// Ejercicio 5

function leerObjeto(obj, clave) {
    if (obj === null || obj === undefined) {
        throw new Error("El objeto no puede ser null o undefined");
    }
    if (!obj.hasOwnProperty(clave)) {
        throw new Error("La clave no existe en el objeto");
    }
    return obj[clave];
}

try {
    let persona = { nombre: "Juan", edad: 30 };
    console.log(leerObjeto(persona, "nombre"));  // "Juan"
    console.log(leerObjeto(persona, "altura"));  // Lanza error
} catch (error) {
    console.error(error.message);
}
