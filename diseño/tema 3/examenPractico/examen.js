/* Clase base de empresas */
class Empresa {
    constructor(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion) {
        this.ID = ID;
        this.nombre = nombre;
        this.Sector = Sector;
        this.ingresosAnuales = this.validaringresosAnuales(ingresosAnuales);
        this.impuestosPorcentaje = this.validarPorcentaje(impuestosPorcentaje);
        this.ingresoSinImpuesto = this.validarIngresosSinImpuesto(ingresosAnuales);
        this.totalImpuestos = ingresosAnuales * (1 + (impuestosPorcentaje / 100)); // si no me equivoco esto deberia ser por ejemplo 17% -> 1 + 0,17 = 1.17 * los ingresos
        this.descripcion = descripcion;
    }

    validarPorcentaje(impuestosPorcentaje) {
        if (impuestosPorcentaje < 0 || impuestosPorcentaje > 100) {
            throw new Error("El porcentaje de impuesto debe estar entre 0 y 100");
        }
        return impuestosPorcentaje;
    }

    validarIngresosSinImpuesto(ingresosAnuales) {
        if (ingresosAnuales < 0) {
            throw new Error("Los ingresos no pueden ser negativo");
        }
        return this.ingresosAnuales - (this.ingresosAnuales * (this.impuestosPorcentaje / 100));
    }

    validaringresosAnuales(ingresoAnuales) {
        if (ingresoAnuales < 0) {
            throw new Error("Los ingresos no pueden ser negativo");
        }
        return ingresoAnuales;
    }


    mostrarInfo() {
        return `ID: ${this.ID}, Nombre: ${this.nombre}, Sector: ${this.Sector}, Ingresos: ${this.ingresosAnuales}, Porcentaje Impuesto: ${this.impuestosPorcentaje}%, Descripcion: ${this.descripcion}`;
    }

    /* Funcion para crear un id incremental */

    // No se que hago mal pero al asignarlo al ID escribe por pantalla la funcion entera en vez del contador

    generarID() {

        let count = 0; // Variable privada

        return function () {
            count++; // Incrementa el contador
            return count; // Devuelve el nuevo valor
        };

    };
}

/* Clase derivada Startup */

class Startup extends Empresa {
    constructor(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion, nivelInversion, numEmpleados, tecnologia) {
        super(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion);
        this.nombre = nombre;
        this.Sector = Sector;
        this.ingresosAnuales = ingresosAnuales;
        this.impuestosPorcentaje = impuestosPorcentaje;
        this.descripcion = descripcion;
        this.nivelInversion = nivelInversion;
        this.numEmpleados = this.validarEmpleados(numEmpleados);
        this.tecnologia = tecnologia;
    }

    validarEmpleados(numEmpleados) {
        if (numEmpleados < 0) {
            throw new Error("No puede haber numeros negativos")
        }
        return numEmpleados;
    }

    mostrarInfo() {
        return `${super.mostrarInfo()},nivel Inversion: ${this.nivelInversion}, Numero de empleados: ${this.numEmpleados}, Tecnologia: ${this.tecnologia}`;
    }
}

/* Clase derivada empresaMediana */

class EmpresaMediana extends Empresa {
    constructor(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion, numEmpleados, mercadoObjetivo, aniosOperando) {
        super(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion);
        this.nombre = nombre;
        this.Sector = Sector;
        this.ingresosAnuales = ingresosAnuales;
        this.impuestosPorcentaje = impuestosPorcentaje;
        this.descripcion = descripcion;
        this.numEmpleados = numEmpleados;
        this.mercadoObjetivo = mercadoObjetivo;
        this.aniosOperando = aniosOperando;
    }

    mostrarInfo() {
        return `${super.mostrarInfo()},numero empleados: ${this.numEmpleados}, Mercado Objetivo: ${this.mercadoObjetivo}, años operando: ${this.aniosOperando}`;
    }
}

/* clase derivada corporacion */
class Corporacion extends Empresa {
    constructor(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion, numSubsidiaria, nivelGlobal, facturacion) {
        super(ID, nombre, Sector, ingresosAnuales, impuestosPorcentaje, descripcion);
        this.nombre = nombre;
        this.Sector = Sector;
        this.ingresosAnuales = ingresosAnuales;
        this.impuestosPorcentaje = impuestosPorcentaje;
        this.descripcion = descripcion;
        this.numSubsidiaria = numSubsidiaria;
        this.nivelGlobal = nivelGlobal;
        this.facturacion = facturacion;
    }

    mostrarInfo() {
        return `${super.mostrarInfo()},numero Subsidiaria: ${this.numSubsidiaria}, Nivel Global: ${this.nivelGlobal}, facturacion: ${this.facturacion}`;
    }
}


/* Clase directorio */

class Directorio {
    constructor(nombre) {
        this.nombre = nombre; //nombre del directorio
        this.empresas = [];
    }

    /* Metodo para añadir empresas al directorio */
    agregarEmpresa(empresa) {
        if (!(empresa instanceof Empresa)) {
            console.error("Error: No es una empresa.");
            return;
        }
        this.empresas.push(empresa);
    }

    /* Metodo para eliminar las empresas por id */
    eliminarEmpresa(ID) {
        const empresaExistente = this.buscarEmpresa(ID);

        if (empresaExistente instanceof Empresa) {
            this.empresas = this.empresas.filter(empresa => {
                return !(empresa.ID === ID);
            });
        } else {
            console.error("No se encontro la empresa.");
        }
    }


    /* Metodo para buscar las empresas por ID */
    buscarEmpresa(ID) {
        const empresaEncontrada = this.empresas.find(empresa => {
            return empresa.ID === ID;
        })
        if (empresaEncontrada) {
            return empresaEncontrada;
        } else {
            console.error(`No se encontro la empresa.`);
            return null;
        }
    }

    /* Metodo para mostrar todas las empresas del directorio */
    listarEmpresa() {
        if (this.empresas.length === 0) {
            console.log("No se encontro ninguna empresa.");
            return;
        }
        console.log(`Empresas en ${this.nombre}: `);
        this.empresas.forEach(empresa => {
            console.log(empresa.mostrarInfo());
        })
    }
}

/* Tests */

const directorio = new Directorio("Salvia");

const startup = new Startup(1, "steam", "videojuegos", 10000000, 24, "Tienda virtual de videojuegos", "Series A", 10000, "random");
const empresaMediana = new EmpresaMediana(2, "paco fruteria", "frutas", 50000, 18, "tienda de frutas", 100, "gente pobre", 6);
const corporacion = new Corporacion(3, "Nestle", "Alimentacion", 5000000, 26, "Empresa que roba agua", 150, "multinacional", 5000000000);

directorio.agregarEmpresa(startup);
directorio.agregarEmpresa(empresaMediana);
directorio.agregarEmpresa(corporacion);
console.log("Datos de la corporacion: ");
console.log(corporacion.mostrarInfo());
console.log("Ingresos sin los impuestos:" + corporacion.ingresoSinImpuesto);

console.log("Ingresos totales: " + corporacion.totalImpuestos);

directorio.listarEmpresa();
console.log("despues de borrar nestle");
directorio.eliminarEmpresa(corporacion.ID);
directorio.listarEmpresa();
