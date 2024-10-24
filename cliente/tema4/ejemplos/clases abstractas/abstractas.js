class AbstractProduct {
    constructor(serial, brand, model) {
    if (new.target === AbstractProduct) {
    throw new TypeError("Cannot instantiate an abstract class directly");
    }
    if (this.calculatePrice === undefined) {
    throw new TypeError("Must override method calculatePrice");
    }
    this.serial = serial;
    this.brand = brand;
    this.model = model;
    }
    getDetails() {
    return `Serial: ${this.serial}, Brand: ${this.brand}, Model: ${this.model}`;
    }
    // Método abstracto
    calculatePrice() {
    throw new Error("Abstract method calculatePrice must be implemented");
    }
}   