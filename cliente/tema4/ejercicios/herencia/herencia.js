// Clase base: Vehículo
function Vehiculo(marca, modelo, año) {
    this.marca = marca;
    this.modelo = modelo;
    this.año = año;
}

Vehiculo.prototype.arrancar = function() {
    console.log("El vehículo ha arrancado.");
};

Vehiculo.prototype.detener = function() {
    console.log("El vehículo ha sido detenido.");
};

// Clase derivada: Automóvil
function Automovil(marca, modelo, año, puertas) {
    Vehiculo.call(this, marca, modelo, año); // Llamar al constructor de Vehículo
    this.puertas = puertas;
}

// Heredar de Vehículo
Automovil.prototype = Object.create(Vehiculo.prototype);
Automovil.prototype.constructor = Automovil;

// Sobrescribir el método arrancar
Automovil.prototype.arrancar = function() {
    console.log("El automóvil ha arrancado.");
};

Automovil.prototype.tocarBocina = function() {
    console.log("El automóvil ha tocado la bocina.");
};

// Clase derivada: Motocicleta
function Motocicleta(marca, modelo, año, tipoManillar) {
    Vehiculo.call(this, marca, modelo, año); // Llamar al constructor de Vehículo
    this.tipoManillar = tipoManillar;
}

// Heredar de Vehículo
Motocicleta.prototype = Object.create(Vehiculo.prototype);
Motocicleta.prototype.constructor = Motocicleta;

// Sobrescribir el método arrancar
Motocicleta.prototype.arrancar = function() {
    console.log("La motocicleta ha arrancado.");
};

Motocicleta.prototype.hacerCaballito = function() {
    console.log("La motocicleta está haciendo un caballito.");
};

// Clase derivada: Camioneta
function Camioneta(marca, modelo, año, capacidadCarga) {
    Automovil.call(this, marca, modelo, año, 2); // Llamar al constructor de Automóvil
    this.capacidadCarga = capacidadCarga;
}

// Heredar de Automóvil
Camioneta.prototype = Object.create(Automovil.prototype);
Camioneta.prototype.constructor = Camioneta;

// Sobrescribir el método arrancar
Camioneta.prototype.arrancar = function() {
    console.log("La camioneta ha arrancado.");
};

Camioneta.prototype.cargar = function() {
    console.log("La camioneta está cargando.");
};

// Ejemplo de ejecución
var vehiculo = new Vehiculo("Toyota", "Corolla", 2020);
var auto = new Automovil("Ford", "Focus", 2018, 4);
var moto = new Motocicleta("Yamaha", "R1", 2021, "Deportivo");
var camioneta = new Camioneta("Chevrolet", "Silverado", 2022, 1.5);

// Probar los métodos
vehiculo.arrancar(); // "El vehículo ha arrancado."
vehiculo.detener(); // "El vehículo ha sido detenido."
auto.arrancar(); // "El automóvil ha arrancado."
auto.tocarBocina(); // "El automóvil ha tocado la bocina."
moto.arrancar(); // "La motocicleta ha arrancado."
moto.hacerCaballito(); // "La motocicleta está haciendo un caballito."
camioneta.arrancar(); // "La camioneta ha arrancado."
camioneta.cargar(); // "La camioneta está cargando."