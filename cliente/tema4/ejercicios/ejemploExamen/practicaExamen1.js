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

class Lavadora extends Electrodomestico {
    constructor(marca, modelo, precio, consumoEnergetico, capacidad) {
        super(marca, modelo, precio, consumoEnergetico);
        this.capacidad = capacidad;
    }

    iniciarLavado() {
        if (this.encendido) {
            console.log("El ciclo de lavado ha comenzado.");
        } else {
            console.log("La lavadora esta apagada. Por favor enciendela");
        }
    }
}
