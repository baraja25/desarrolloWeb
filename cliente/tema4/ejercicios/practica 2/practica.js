// Excepciones personalizadas
class VehicleError extends Error {
  constructor(message) {
    super(message);
    this.name = "VehicleError";
  }
}

class InventoryError extends Error {
  constructor(message) {
    super(message);
    this.name = "InventoryError";
  }
}

class Vehicle {
  constructor(serial, brand, model, price, taxPercentage, description) {
    if (new.target === Vehicle) {
      throw new VehicleError("No se puede instanciar una clase abstracta");
    }
    this._serial = serial;
    this._brand = brand;
    this._model = model;
    this._price = this._validatePrice(price);
    this._taxPercentage = this._validateTaxPercentage(taxPercentage);
    this._description = description;
  }

  _validatePrice(price) {
    if (price < 0) throw new VehicleError("El precio no puede ser negativo");
    return price;
  }

  _validateTaxPercentage(taxPercentage) {
    if (taxPercentage < 0 || taxPercentage > 100) {
      throw new VehicleError("El porcentaje de impuesto debe estar entre 0 y 100");
    }
    return taxPercentage;
  }

  get serial() {
    return this._serial;
  }

  get brand() {
    return this._brand;
  }

  get model() {
    return this._model;
  }

  get priceWithoutTax() {
    return this._price;
  }

  get totalTax() {
    return (this._price * this._taxPercentage) / 100;
  }

  get priceWithTax() {
    return this._price + this.totalTax;
  }

  toString() {
    return `Serial: ${this._serial}, Marca: ${this._brand}, Modelo: ${
      this._model
    }, Precio: $${this._price.toFixed(2)}, Porcentaje de impuesto: ${
      this._taxPercentage
    }%, Descripción: ${this._description}`;
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
    this._motor = motor;
    this._horsepower = horsepower;
    this._doors = doors;
    this._fuelType = fuelType;
  }

  toString() {
    return `${super.toString()}, Motor: ${this._motor}, Potencia: ${
      this._horsepower
    } HP, Número de puertas: ${this._doors}, Tipo de combustible: ${
      this._fuelType
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
    this._engineType = engineType;
    this._motorcycleType = motorcycleType;
    this._displacement = displacement;
  }

  toString() {
    return `${super.toString()}, Tipo de motor: ${
      this._engineType
    }, Tipo de motocicleta: ${this._motorcycleType}, Cilindrada: ${
      this._displacement
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
    this._loadCapacity = loadCapacity;
    this._axles = axles;
  }

  toString() {
    return `${super.toString()}, Capacidad de carga: ${
      this._loadCapacity
    } toneladas, Número de ejes: ${this._axles}`;
  }
}

class Inventory {
  constructor() {
    this._vehicles = [];
  }

  addVehicle(vehicle) {
    if (vehicle instanceof Vehicle) {
      this._vehicles.push(vehicle);
      console.log(`Vehículo añadido: ${vehicle.toString()}`);
    } else {
      throw new InventoryError("Solo se pueden añadir vehículos válidos");
    }
  }

  removeVehicle(serial) {
    const index = this._vehicles.findIndex(vehicle => vehicle.serial === serial);
    if (index !== -1) {
      const removedVehicle = this._vehicles.splice(index, 1);
      console.log(`Vehículo eliminado: ${removedVehicle[0].toString()}`);
    } else {
      throw new InventoryError("No se encontró un vehículo con el número de serie introducido");
    }
  }

  listVehicles() {
    if (this._vehicles.length === 0) {
      console.log("El inventario está vacío.");
    } else {
      console.log("Vehículos en el inventario: ");
      this._vehicles.forEach(vehicle => {
        console.log(vehicle.toString());
      });
    }
  }

  searchVehicle(serial) {
    const vehicle = this._vehicles.find(vehicle => vehicle.serial === serial);
    if (vehicle) {
      console.log(`Vehículo encontrado: ${vehicle.toString()}`);
    } else {
      throw new InventoryError("No se encontró el vehículo.");
    }
  }

  totalCost() {
    let totalWithoutTax = 0;
    let totalWithTax = 0;

    this._vehicles.forEach(vehicle => {
      totalWithoutTax += vehicle.priceWithoutTax;
      totalWithTax += vehicle.priceWithTax;
    });

    console.log(`Total sin impuestos:` + totalWithoutTax);
    console.log(`Total con impuestos:` + totalWithTax);
  }
}

// Tests básicos
function runTests() {
  try {
    const inventory = new Inventory();
    const car = new Car("1", "Toyota", "Corolla", 20000, 15, "Sedán", "2.0L", 150, 4, "Gasolina");
    const motorcycle = new Motorcycle("2", "Yamaha", "MT-07", 8000, 10, "Deportiva", "2 cilindros", "Naked", 689);
    const truck = new Truck("3", "Ford", "F-150", 30000, 12, "Pickup", 1.5, 4);

    inventory.addVehicle(car);
    inventory.addVehicle(motorcycle);
    inventory.addVehicle(truck);
    inventory.listVehicles();
    inventory.totalCost();

    inventory.removeVehicle("2");
    inventory.listVehicles();
    inventory.totalCost();

    inventory.searchVehicle("1");
  } catch (error) {
    console.error(error.message);
  }
}

runTests();