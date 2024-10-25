class vehicle {
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

class Car extends vehicle {
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

class Motorcycle extends vehicle {
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

class Truck extends vehicle {
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
