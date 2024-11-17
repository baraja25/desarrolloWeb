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