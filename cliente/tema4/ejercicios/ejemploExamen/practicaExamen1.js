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
