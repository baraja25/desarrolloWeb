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
const jsonProducto = '{"producto": "Laptop", "especificaciones": {"marca": "HP", "procesador": "Intel i5", "ram": "8GB"}}';

// Convertir la cadena JSON en un objeto JavaScript
const productoObj = JSON.parse(jsonProducto);

const procesador = productoObj.especificaciones.procesador;
console.log(procesador); // Esto imprimirá "Intel i5"

//ejercicio 5
const jsonErroneo = '{"nombre": "Carlos", "edad": 45, "ciudad": "Valencia"';

try {
    // Intentar convertir la cadena JSON en un objeto
    const objeto = JSON.parse(jsonErroneo);
    console.log(objeto); // Esto no se ejecutara si hay un error
} catch (error) {
    // Manejar el error en caso de que JSON.parse falle
    console.error("Error al parsear JSON:", error.message);
}

//ejercicio 6
const inventario = [
    { "nombre": "Laptop", "cantidad": 10, "precio": 1200 },
    { "nombre": "Mouse", "cantidad": 50, "precio": 20 },
    { "nombre": "Teclado", "cantidad": 30, "precio": 35 }
];

const jsonInventario = JSON.stringify(inventario);

// Convertir la cadena JSON de nuevo a un objeto
const inventarioObj = JSON.parse(jsonInventario);

// Aumentar en 5 la cantidad del producto "Laptop"
const laptop = inventarioObj.find(producto => producto.nombre === "Laptop");
if (laptop) {
    laptop.cantidad += 5;
}

// Agregar un nuevo producto llamado "Monitor" con cantidad 15 y precio 250
inventarioObj.push({ "nombre": "Monitor", "cantidad": 15, "precio": 250 });

// Calcular el valor total de todos los productos
let valorTotal = 0;
inventarioObj.forEach(producto => {
    valorTotal += producto.cantidad * producto.precio;
});

// Mostrar el resultado
console.log("Valor total del inventario:", valorTotal);

// ejercicio 7

const jsonEmpleados = '[{"nombre": "Carlos", "departamento": "Ventas", "sueldo": 3000}, {"nombre": "Ana", "departamento": "Marketing", "sueldo": 3500}, {"nombre": "Luis", "departamento": "IT", "sueldo": 4000}]';

const empleados = JSON.parse(jsonEmpleados);

// Incrementar el sueldo de cada empleado en un 10%
empleados.forEach(empleado => {
    empleado.sueldo *= 1.10;
});

// Cambiar el departamento de "Ana" a "Recursos Humanos"
const ana = empleados.find(empleado => empleado.nombre === "Ana");
if (ana) {
    ana.departamento = "Recursos Humanos";
}

// Mostrar la lista de empleados que tienen un sueldo mayor a 3200
const empleadosConSueldoMayorA3200 = empleados.filter(empleado => empleado.sueldo > 3200);
console.log("Empleados con sueldo mayor a 3200:", empleadosConSueldoMayorA3200);

// ejercicio 8

const historialCompras = {
    "compras": [
        {
            "fecha": "2023-01-15",
            "cliente": "Juan",
            "articulos": [
                {"nombre": "Laptop", "precio": 1200},
                {"nombre": "Teclado", "precio": 35}
            ]
        },
        {
            "fecha": "2023-01-20",
            "cliente": "Maria",
            "articulos": [
                {"nombre": "Mouse", "precio": 20},
                {"nombre": "Monitor", "precio": 250}
            ]
        }
    ]
};

// Agregar una nueva compra para el cliente "Ana"
const nuevaCompra = {
    "fecha": "2023-01-25",
    "cliente": "Ana",
    "articulos": [
        {"nombre": "Impresora", "precio": 150},
        {"nombre": "Cables", "precio": 10}
    ]
};

// Agregar la nueva compra al historial
historialCompras.compras.push(nuevaCompra);

// Calcular el total gastado por "Juan"
const totalGastadoPorJuan = historialCompras.compras
    .filter(compra => compra.cliente === "Juan")
    .reduce((total, compra) => {
        const totalCompra = compra.articulos.reduce((suma, articulo) => suma + articulo.precio, 0);
        return total + totalCompra;
    }, 0);

// Mostrar el total gastado por Juan
console.log("Total gastado por Juan:", totalGastadoPorJuan);

// Mostrar todos los nombres de los clientes únicos que han realizado compras
const clientesUnicos = [...new Set(historialCompras.compras.map(compra => compra.cliente))];
console.log("Clientes únicos que han realizado compras:", clientesUnicos);

// ejercicio 9

const estudiantes = [
    { "nombre": "Lucia", "edad": 20, "notas": [8, 9, 7] },
    { "nombre": "Carlos", "edad": 22, "notas": [6, 7, 5] },
    { "nombre": "Marta", "edad": 19, "notas": [10, 9, 10] }
];

const jsonEstudiantes = JSON.stringify(estudiantes);

// Convertir la cadena JSON de nuevo a un objeto
const estudiantesObj = JSON.parse(jsonEstudiantes);

// Filtrar los estudiantes cuya edad sea mayor a 20
const estudiantesMayoresDe20 = estudiantesObj.filter(estudiante => estudiante.edad > 20);

// Calcular el promedio de notas de cada estudiante
const estudiantesConPromedio = estudiantesObj.map(estudiante => {
    const sumaNotas = estudiante.notas.reduce((total, nota) => total + nota, 0);
    const promedio = sumaNotas / estudiante.notas.length;
    return { ...estudiante, promedio }; // Retornar el estudiante con su promedio
});

// Crear un nuevo arreglo JSON llamado jsonAprobados solo con estudiantes cuyo promedio sea mayor o igual a 6
const estudiantesAprobados = estudiantesConPromedio.filter(estudiante => estudiante.promedio >= 6);
const jsonAprobados = JSON.stringify(estudiantesAprobados);

// Mostrar resultados
console.log("Estudiantes mayores de 20:", estudiantesMayoresDe20);
console.log("Estudiantes aprobados:", jsonAprobados);

// ejercicio 10

const ventasAnuales = {
    "enero": { "cantidad": 100, "ingreso": 5000 },
    "febrero": { "cantidad": 120, "ingreso": 6000 },
    "marzo": { "cantidad": 130, "ingreso": 6500 }
};

// Agregar los datos de un nuevo mes, "abril"
ventasAnuales["abril"] = { "cantidad": 140, "ingreso": 7000 };

// Calcular el total anual de ingresos y unidades vendidas
let totalIngresos = 0;
let totalUnidades = 0;

for (const mes in ventasAnuales) {
    totalIngresos += ventasAnuales[mes].ingreso;
    totalUnidades += ventasAnuales[mes].cantidad;
}

// Mostrar el total anual
console.log("Total anual de ingresos:", totalIngresos);
console.log("Total anual de unidades vendidas:", totalUnidades);

// Mostrar los meses donde los ingresos fueron mayores a 6000
const mesesConIngresosAltos = Object.keys(ventasAnuales).filter(mes => ventasAnuales[mes].ingreso > 6000);
console.log("Meses con ingresos mayores a 6000:", mesesConIngresosAltos);