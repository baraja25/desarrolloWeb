/* Ejercicio 1 */

function diaDeNacimiento(fechaNacimiento) {
    const diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    const fecha = new Date(fechaNacimiento); // Crea un objeto Date con la fecha
    const diaSemana = fecha.getDay(); // Obtiene el día de la semana (0-6)

    return diasSemana[diaSemana]; // Devuelve el nombre del día
}

// Ejemplo
let fechaNacimiento = '1990-10-03'; // Formato: AAAA-MM-DD
console.log("Naciste un:", diaDeNacimiento(fechaNacimiento));

/* Ejercicio 2 */

function calcularEdad(fechaNacimiento) {
    const hoy = new Date(); // Fecha actual
    const fechaNac = new Date(fechaNacimiento); // Fecha de nacimiento
    
    let edad = hoy.getFullYear() - fechaNac.getFullYear(); // Diferencia en años

    // Verificar si el cumpleaños de este año ya pasó o no
    const mesActual = hoy.getMonth();
    const diaActual = hoy.getDate();
    const mesNacimiento = fechaNac.getMonth();
    const diaNacimiento = fechaNac.getDate();

    // Si el cumpleaños no ha pasado este año, restar 1 a la edad
    if (mesActual < mesNacimiento || (mesActual === mesNacimiento && diaActual < diaNacimiento)) {
        edad--;
    }

    return edad;
}

// Ejemplo 
let fechaNacimiento1 = '1990-10-03'; // Formato: AAAA-MM-DD
console.log("Tu edad es:", calcularEdad(fechaNacimiento1));

/* Ejercicio 3 */


function diferenciaDias(fecha1, fecha2) {
    const fechaInicial = new Date(fecha1); // Primera fecha
    const fechaFinal = new Date(fecha2); // Segunda fecha

    // Diferencia en milisegundos entre ambas fechas
    const diferenciaMilisegundos = Math.abs(fechaFinal - fechaInicial);

    // Convertir milisegundos a días (1 día = 24 horas * 60 minutos * 60 segundos * 1000 milisegundos)
    const milisegundosPorDia = 24 * 60 * 60 * 1000;
    const diferenciaDias = Math.floor(diferenciaMilisegundos / milisegundosPorDia);

    return diferenciaDias;
}

// Ejemplo 
let fecha1 = '2023-09-01'; // Formato: AAAA-MM-DD
let fecha2 = '2023-10-01'; // Formato: AAAA-MM-DD
console.log("Diferencia de días:", diferenciaDias(fecha1, fecha2));
// Deberia devolver 30

/* Ejercicio 4 */

function esBisiesto(fecha) {
    const año = new Date(fecha).getFullYear(); // Obtiene el año de la fecha

    // Verifica si el año es bisiesto
    if ((año % 4 === 0 && año % 100 !== 0) || (año % 400 === 0)) {
        return true; // Es bisiesto
    } else {
        return false; // No es bisiesto
    }
}

// Ejemplo de uso
let fecha3 = '2020-02-29'; // Año bisiesto
let fecha4 = '2021-02-28'; // No es bisiesto
console.log("¿El año es bisiesto?", esBisiesto(fecha3)); //  true
console.log("¿El año es bisiesto?", esBisiesto(fecha4)); //  false

/* Ejercicio 5 */

function sumarDias(fecha, dias) {
    const fechaOriginal = new Date(fecha); // Crea un objeto Date con la fecha original

    // Sumar los días en milisegundos
    const milisegundosPorDia = 24 * 60 * 60 * 1000; // Milisegundos en un día
    const nuevaFecha = new Date(fechaOriginal.getTime() + (dias * milisegundosPorDia)); // Nueva fecha

    return nuevaFecha; // Devuelve la nueva fecha
}

// Ejemplo de uso
let fecha = '2023-10-01'; // Formato: AAAA-MM-DD
let diasASumar = 30; // Número de días a sumar
let nuevaFecha = sumarDias(fecha, diasASumar);
console.log("Nueva fecha:", nuevaFecha.toISOString().split('T')[0]); // Devuelve la nueva fecha en formato AAAA-MM-DD
// Debería devolver: "2023-10-31"

/* Ejercicio 6 */

function formatearFecha(fecha) {
    const fechaObj = new Date(fecha); // Crea un objeto Date a partir de la fecha proporcionada

    // Obtener el día, mes y año
    let dia = fechaObj.getDate(); // Día del mes
    let mes = fechaObj.getMonth() + 1; // Mes (0-11, así que sumamos 1)
    const año = fechaObj.getFullYear(); // Año

    // Agregar ceros a los días y meses si es necesario
    dia = dia < 10 ? '0' + dia : dia; // Agregar cero al día si es menor que 10
    mes = mes < 10 ? '0' + mes : mes; // Agregar cero al mes si es menor que 10

    // Retornar la fecha en formato "dd-mm-aaaa"
    return `${dia}-${mes}-${año}`;
}

// Ejemplo de uso
let fecha5 = '2023-10-03'; // Formato: AAAA-MM-DD
console.log("Fecha formateada:", formatearFecha(fecha5)); //  "03-10-2023"

/* Ejercicio 7 */

function cuentaRegresiva(fechaEvento) {
    const evento = new Date(fechaEvento).getTime(); // Convierte la fecha del evento a milisegundos

    // Actualiza el tiempo restante cada segundo
    const intervalo = setInterval(() => {
        const ahora = new Date().getTime(); // Obtiene el tiempo actual
        const diferencia = evento - ahora; // Calcula la diferencia

        // Calcula días, horas, minutos y segundos restantes
        const dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        const horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        const segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

        // Muestra el resultado
        console.log(`Faltan ${dias} días, ${horas} horas, ${minutos} minutos y ${segundos} segundos.`);

        // Si la cuenta regresiva ha terminado, muestra un mensaje y detiene el intervalo
        if (diferencia < 0) {
            clearInterval(intervalo);
            console.log("¡El evento ha comenzado!");
        }
    }, 1000); // Actualiza cada segundo
}

// Ejemplo de uso
const fechaEvento = '2024-01-01T00:00:00'; // Cambia esto a la fecha del evento futuro
cuentaRegresiva(fechaEvento);
