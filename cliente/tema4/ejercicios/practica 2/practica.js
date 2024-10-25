class Vehicle {
  constructor(serial, brand, model, price, taxPercentage, description) {
    if (new.target === vehicle) {
      throw new Error("No se puede instanciar una clase abstracta");
    }
    this.serial = serial;
    this.brand = brand;
    this.model = model;
    this.price = price;
    this.taxPercentage = taxPercentage;
    this.description = description;
  }
  get priceWithoutTax() {
    return this.price;
  }

  get totalTax() {
    return (this.price * this.taxPercentage) / 100;
  }

  get priceWithTax() {
    return this.price + this.totalTax;
  }

  toString() {
    return `Serial: ${this.serial}, Marca: ${this.brand}, Modelo: ${
      this.model
    }, Precio: $${this.price.toFixed(2)}, Porcentaje de impuesto: ${
      this.taxPercentage
    }%, Descripción: ${this.description}`;
  }
}

class Car extends Vehicle {
  constructor(
    serial,
    brand,
    model,
    price,
    taxPercentage,
    description,
    motor,
    horsepower,
    doors,
    fuelType
  ) {
    super(serial, brand, model, price, taxPercentage, description);
    this.motor = motor;
    this.horsepower = horsepower;
    this.doors = doors;
    this.fuelType = fuelType;
  }

  toString() {
    return `${super.toString()}, Motor: ${this.motor}, Potencia: ${
      this.horsepower
    } HP, Número de puertas: ${this.doors}, Tipo de combustible: ${
      this.fuelType
    }`;
  }
}

class Motorcycle extends Vehicle {
  constructor(
    serial,
    brand,
    model,
    price,
    taxPercentage,
    description,
    engineType,
    motorcycleType,
    displacement //cilindrada
  ) {
    super(serial, brand, model, price, taxPercentage, description);
    this.engineType = engineType;
    this.motorcycleType = motorcycleType;
    this.displacement = displacement;
  }

  toString() {
    return `${super.toString()}, Tipo de motor: ${
      this.engineType
    }, Tipo de motocicleta: ${this.motorcycleType}, Cilindrada: ${
      this.displacement
    } CC`;
  }
}

class Truck extends Vehicle {
  constructor(
    serial,
    brand,
    model,
    price,
    taxPercentage,
    description,
    loadCapacity,
    axles //numero de ejes
  ) {
    super(serial, brand, model, price, taxPercentage, description);
    this.loadCapacity = loadCapacity;
    this.axles = axles;
  }

  toString() {
    return `${super.toString()}, Capacidad de carga: ${
      this.loadCapacity
    } toneladas, Número de ejes: ${this.axles}`;
  }
}

class inventory {
    constructor(){
        this.vehicles = [];
    }

    addVehicle(vehicle) {
        if (vehicle instanceof Vehicle) {
            this.vehicles.push(vehicle);
            console.log(`Vehiculo añadido: ${vehicle.toString()}`)
        } else {
            console.log("Solo se pueden añadir vehiculos");
        }
    }

    removeVehicle(serial) {
        const index = this.vehicles.findIndex(vehicle => vehicle.serial === serial);
        if (index !== -1) {
            const removedVehicle = this.vehicles.splice(index, 1);
            console.log(`Vehiculo eliminado: ${removedVehicle[0].toString()}`)
        } else {
            console.log("No se encontro un vehiculo con el numero de serie introducido")
        }
    }

    listVehicles() {
        if (this.vehicles.length === 0) {
            console.log("El inventario esta vacio.");
        } else {
            console.log("Vehiculos en el inventario: ");
            this.vehicles.forEach(vehicle => {
                console.log(vehicle.toString());
            });
        }
    }

    searchVehicle() {
        const vehicle = this.vehicles.find(vehicle => vehicle.serial === serial);
        if (vehicle) {
            console.log(`Vehiculo encontrado: ${vehicle.toString()}`)
        } else {
            console.log("No se encontro el vehiculo.")
        }
    }



}