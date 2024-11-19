class Electrodomestico {
    constructor(marca, modelo, precio, consumoEnergetico) {
        this.marca = marca;
        this.modelo = modelo;
        this.precio = precio;
        this.consumoEnergetico = consumoEnergetico;
        this.encendido = false;
    }

    encender() {
        this.encendido = true;
        console.log(`El electrodomestico ${this.marca} ${this.modelo} se ha encendido.`);
    }

    apagar() {
        this.encendido = false;
        console.log(`El electrodomestico ${this.marca} ${this.modelo} se ha apagado.`);
    }

    mostrarInfo() {
        return `Marca: ${this.marca}, Modelo: ${this.modelo}, Precio: ${this.precio}, ConsumoEnergetico: ${this.consumoEnergetico}`;
    }
}

/* Clase que hereda de electrodomestico*/

class Lavadora extends Electrodomestico {
    constructor(marca, modelo, precio, consumoEnergetico, capacidad) {
        super(marca, modelo, precio, consumoEnergetico);
        this._marca = marca;
        this._modelo = modelo;
        this._precio = precio;
        this._consumoEnergetico = consumoEnergetico;
        this._capacidad = capacidad;
    }


    get marca() {
        return this._marca;
    }

    set marca(value) {
        this._marca = value;
    }

    get modelo() {
        return this._modelo;
    }

    set modelo(value) {
        this._modelo = value;
    }

    get precio() {
        return this._precio;
    }

    set precio(value) {
        this._precio = value;
    }

    get consumoEnergetico() {
        return this._consumoEnergetico;
    }

    set consumoEnergetico(value) {
        this._consumoEnergetico = value;
    }

    get capacidad() {
        return this._capacidad;
    }

    set capacidad(value) {
        this._capacidad = value;
    }

    /* Metodos */

    iniciarLavado() {
        if (this.encendido) {
            console.log("El ciclo de lavado ha comenzado.");
        } else {
            console.log("La lavadora esta apagada. Por favor enciendela");
        }
    }


}

/* Clase que hereda de electrodomestico */

class Televisor extends Electrodomestico {
    constructor(marca, modelo, precio, consumoEnergetico, pulgadas) {
        super(marca, modelo, precio, consumoEnergetico);
        this._marca = marca;
        this._modelo = modelo;
        this._precio = precio;
        this._consumoEnergetico = consumoEnergetico;
        this._pulgadas = pulgadas;
    }

    /* getters y setters */
    get marca() {
        return this._marca;
    }

    set marca(value) {
        this._marca = value;
    }

    get modelo() {
        return this._modelo;
    }

    set modelo(value) {
        this._modelo = value;
    }

    get precio() {
        return this._precio;
    }

    set precio(value) {
        this._precio = value;
    }

    get consumoEnergetico() {
        return this._consumoEnergetico;
    }

    set consumoEnergetico(value) {
        this._consumoEnergetico = value;
    }

    get pulgadas() {
        return this._pulgadas;
    }

    set pulgadas(value) {
        this._pulgadas = value;
    }

    /* Metodos */

    cambiarCanal() {
        if (this.encendido) {
            console.log("Has cambiado de canal.");
        } else {
            console.log("El televisor esta apagado.");
        }
    }

}


class Hogar {
    constructor(nombre) {
        this.nombre = nombre;
        this.electrodomesticos = [];
    }

    agregarElectrodomestico(electrodomestico) {
        this.electrodomesticos.push(electrodomestico);
    }

    eliminarElectrodomestico(marca, modelo) {
        this.electrodomesticos = this.electrodomesticos.filter(electrodomestico => {
            return !(electrodomestico.marca === marca && electrodomestico.modelo === modelo);
        })
    }

    buscarElectrodomestico(marca, modelo) {
        const electroDomesticoEncontrado =  this.electrodomesticos.find(electrodomestico => {
            return electrodomestico.marca === marca && electrodomestico.modelo === modelo;
        })
        if(electroDomesticoEncontrado) {
            return electroDomesticoEncontrado;
        } else {
            return `No se encontro el electrodomestico con marca: ${marca} y modelo: ${modelo}.`;
        }
    }

    contarElectrodomesticoPorTipo(tipo) {
        let contador = 0;

        for (let i = 0; i < this.electrodomesticos.length; ++i) {
            if (this.electrodomesticos[i] instanceof Televisor && tipo === "Televisor") {
                contador++;
            } else if (this.electrodomesticos[i] instanceof Lavadora && tipo === "Lavadora") {
                contador++;
            }

        }
        return contador;
    }

    listarElectrodomestico() {
        if (this.electrodomesticos.length === 0) {
            console.log("No se encontro el electrodomestico.");
            return;
        }
        console.log(`Electrodomesticos en ${this.nombre}: `);
        this.electrodomesticos.forEach(electrodomestico => {
            console.log(`- Marca: ${electrodomestico.marca}, Modelo: ${electrodomestico.modelo}`);
        })
    }
}


/* Tests */

// Crear una instancia de Hogar
const miHogar = new Hogar("Mi Casa");

// Crear instancias de electrodomésticos
const lavadora1 = new Lavadora("LG", "T123", 500, "A++", 8);
const televisor1 = new Televisor("Samsung", "QLED", 1200, "A+", 55);
const lavadora2 = new Lavadora("Samsung", "EcoBubble", 600, "A++", 9);
const televisor2 = new Televisor("Sony", "Bravia", 1500, "A++", 65);

// Agregar electrodomésticos al hogar
miHogar.agregarElectrodomestico(lavadora1);
miHogar.agregarElectrodomestico(televisor1);
miHogar.agregarElectrodomestico(lavadora2);
miHogar.agregarElectrodomestico(televisor2);

// Listar todos los electrodomésticos en el hogar
miHogar.listarElectrodomestico();

// Contar electrodomésticos por tipo
const cantidadLavadoras = miHogar.contarElectrodomesticoPorTipo("Lavadora");
const cantidadTelevisores = miHogar.contarElectrodomesticoPorTipo("Televisor");

console.log(`Cantidad de Lavadoras: ${cantidadLavadoras}`); // Debería mostrar 2
console.log(`Cantidad de Televisores: ${cantidadTelevisores}`); // Debería mostrar 2

// Buscar un electrodoméstico específico
const busqueda1 = miHogar.buscarElectrodomestico("LG", "T123");
console.log(busqueda1.mostrarInfo()); // Muestra la información del electrodoméstico

const busqueda2 = miHogar.buscarElectrodomestico("Sony", "Bravia");
console.log(busqueda2.mostrarInfo()); // Muestra la información del electrodoméstico

// Encender y apagar electrodomésticos
lavadora1.encender(); // Encender la lavadora
lavadora1.iniciarLavado(); // Iniciar el ciclo de lavado

televisor1.encender(); // Encender el televisor
televisor1.cambiarCanal(); // Cambiar de canal

// Apagar electrodomésticos
lavadora1.apagar(); // Apagar la lavadora
televisor1.apagar(); // Apagar el televisor

// Eliminar un electrodoméstico
miHogar.eliminarElectrodomestico("Samsung", "QLED");
console.log("Después de eliminar el televisor Samsung QLED:");
miHogar.listarElectrodomestico(); // Listar electrodomésticos después de la eliminación