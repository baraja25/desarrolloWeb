function Product(serial, brand, model, price,
    taxPercentage = Product.IVA) {
    if (!(this instanceof Product))
        throw new InvalidAccessConstructorException();
    if (!serial) throw new EmptyValueException("serial");
    if (!brand) throw new EmptyValueException("brand");
    if (!model) throw new EmptyValueException("model");
    price = Number.parseFloat(price);
    if (!price || price <= 0) throw new InvalidValueException("price", price);
    if (!taxPercentage || taxPercentage < 0) throw new InvalidValueException("taxPercentage", taxPercentage);
    let _serial = serial;
    let _brand = brand;
    let _model = model;
    let _price = price;
    let _taxPercentage = taxPercentage;
    Object.defineProperty(this, 'serial', {
        get: function () {
            return _serial;
        },
        set: function (value) {
            if (!value) throw new EmptyValueException("serial");
            _serialNumber = value;
        }
    });

    Object.defineProperty(this, 'brand', {
        get: function () {
            return _brand;
        },
        set: function (value) {
            if (!value) throw new EmptyValueException("brand");
            _brand = value;
        }
    });
    Object.defineProperty(this, 'model', {
        get: function () {
            return _model;
        },
        set: function (value) {
            if (!value) throw new EmptyValueException("model");
            _model = value;
        }
    });

    Object.defineProperty(this, 'price', {
        get: function () {
            return _price;
        },
        set: function (value) {
            value = Number.parseFloat(value);
            if (Number.isNaN(value) || value < 0) throw new InvalidValueException("price", value);
            _price = value;
        }
    });

    Object.defineProperty(this, 'taxPercentage', {
        get: function () {
            return _taxPercentage;
        },
        set: function (value = Product.IVA) {
            if (!value || value < 0) throw new InvalidValueException("taxPercentage", value);
            _taxPercentage = value;

        }
    });
}
Product.prototype = {};
Product.prototype.constructor = Product;
Object.defineProperty(Product.prototype, 'description', {
    enunmerable: true,
    writable: true,
    configurable: false
});
Object.defineProperty(Product.prototype, 'priceWithoutTaxes', {
    get: function () {
        return this.price - (this.price * this.taxPercentage / 100);
    }
});
Object.defineProperty(Product.prototype, 'tax', {
    get: function () {
        return this.price * this.taxPercentage / 100;
    }
});
Product.prototype.toString = function () {
    return "Serial: " + this.serial + " Brand: " + this.brand + " Model: "
        + this.model + " Price: " + this.price + "€ Tax: " + this.taxPercentage +
        "%";
}
Object.defineProperty(Product, 'IVA', {
    value: 21,
    writable: false,
    enumerable: true,
    configurable: false
});

function Laptop(serial, brand, model, price, taxPercentage = Product.IVA,
    processor = "unkonwn", memory = "0GB", hd = "-", size = "0GB") {
    //La función se invoca con el operador new 
    if (!(this instanceof Laptop))
        throw new InvalidAccessConstructorException();
    //Llamada al superconstructor. 
    Product.call(this, serial, brand, model, price, taxPercentage);
    //Validación de argumentos 
    if (!processor) throw new EmptyValueException("processor");
    if (!/^((\d+GB)|(\d+TB))$/.test(memory)) throw new InvalidValueException("memory", memory);
    if (!/^((HDD)|(SSD)|())$/.test(hd)) throw new InvalidValueException("hd", hd);
    if (!/^((\d+GB)|(\d+TB))$/.test(size)) throw new InvalidValueException("size", size);
    //Atributos privados 
    let _processor = processor;
    let _memory = memory;
    let _hd = hd;
    let _size = size;
    //Propiedades de acceso a los atributos privados 
    Object.defineProperty(this, 'processor', {
        get: function () {
            return _processor;
        },
        set: function (value) {
            if (!value) throw new EmptyValueException("processor");
            _processor = value;
        }
    });

    Object.defineProperty(this, 'memory', {
        get: function () {
            return _memory;
        },
        set: function (value) {
            if (!/^((\d+GB)|(\d+TB))$/.test(value)) throw new InvalidValueException("memory", value);
            _memory = value;
        }
    });

    Object.defineProperty(this, 'hd', {
        get: function () {
            return _hd;
        },
        set: function (value) {
            if (!/^((HDD)|(SDD))$/.test(value)) throw new InvalidValueException
                ("hd", value);
            _hd = value;
        }
    });

    Object.defineProperty(this, 'size', {
        get: function () {
            return _size;
        },
        set: function (value) {
            if (!/^((\d+GB)|(\d+TB))$/.test(value)) throw new InvalidValueException("size", value);
            _size = value;
        }
    });
}
Laptop.prototype = Object.create(Product.prototype);
Laptop.prototype.constructor = Laptop;
Laptop.prototype.system = "Unknown"; // Propiedad pública 
Laptop.prototype.toString = function () {
    return Product.prototype.toString.call(this) + " System: " + this.system + " Processor: " + this.processor +
        " Memoria: " + this.memory + " HD: " + this.hd +
        " Size: " + this.size;
}

//Definimos la subclase Camera
function Camera(serial, brand, model, price, taxPercentage = Product.IVA,
    type = "-", resolution = 0, size = 0) {
    //La función se invoca con el operador new
    if (!(this instanceof Camera))
        throw new InvalidAccessConstructorException();
    //Llamada al superconstructor.
    Product.call(this, serial, brand, model, price, taxPercentage);
    //Validación de argumentos
    resolution = Number.parseFloat(resolution);
    size = Number.parseFloat(size);
    if (!/^((Digital)|(Reflex)|(-)) $ /.test(type)) throw new InvalidValueException("type", type);
    if (Number.isNaN(resolution) || resolution < 0) throw new InvalidValueException("resolution", resolution);
    if (Number.isNaN(size) || size < 0) throw new InvalidValueException("size", size);
    //Atributos privados
    let _type = type;
    let _resolution = resolution;
    let _size = size;
    //Propiedades de acceso a los atributos privados
    Object.defineProperty(this, 'type', {
        get: function () {
            return _type;
        },
        set: function (value) {
            if (!/^((Digital)|(Reflex)|(-))$ /.test(value)) throw new InvalidValueException("type", value);
            _type = value;
        }
    });
    Object.defineProperty(this, 'resolution', {
        get: function () {
            return _resolution;
        },
        set: function (value) {
            value = Number.parseFloat(value);
            if (Number.isNaN(value) || value < 0) throw new InvalidValueException("resolution", value);
            _resolution = value;
        }
    });
    Object.defineProperty(this, 'size', {
        get: function () {
            return _size;
        },
        set: function (value) {
            value = Number.parseFloat(value);
            if (Number.isNaN(value) || value < 0) throw new InvalidValueExcepti
            on("size", value);
            _size = value;
        }
    });
}
Camera.prototype = Object.create(Product.prototype); //Heredamos de Product
Camera.prototype.constructor = Camera;
Camera.prototype.toString = function () {
    return Product.prototype.toString.call(this) +
        " Tipo: " + this.type + " Resolución: " + this.resolution + "MP Size:" + this.size + "''";
}
//Definimos la subclase Smartphone
function Smartphone(serial, brand, model, price, taxPercentage = Product.IVA, memory = "0GB", storage = "0GB", resolution = "0x0", size = 0) {
    //La función se invoca con el operador new
    if (!(this instanceof Smartphone))
        throw new InvalidAccessConstructorException();
    //Llamada al superconstructor.
    Product.call(this, serial, brand, model, price, taxPercentage);
    //Validación de argumentos
    if (!/^((\d+GB)|(\d+TB))$/.test(memory)) throw new InvalidValueException("memory", memory);
    if (!/^((\d+GB)|(\d+TB))$/.test(storage)) throw new InvalidValueException("storage", storage);
    size = Number.parseFloat(size);
    if (Number.isNaN(size) || size < 0) throw new InvalidValueException("size", size);
    if (!/^(\d+x\d+)$/.test(resolution)) throw new InvalidValueException("resolution", resolution);
    //Atributos privados
    let _memory = memory;
    let _storage = storage;
    let _resolution = resolution;
    let _size = size;
    //Propiedades de acceso a los atributos privados
    Object.defineProperty(this, 'memory', {
        get: function () {
            return _memory;
        },
        set: function (value) {
            if (!/^((\d+GB)|(\d+TB))$/.test(value)) throw new InvalidValueException("memory", value);
            _memory = value;
        }
    });
    Object.defineProperty(this, 'resolution', {
        get: function () {
            return _resolution;
        },
        set: function (value) {
            if (!/^(\d+x\d+)$/.test(value)) throw new InvalidValueException("resolution", value);
            _resolution = value;
        }
    });
    Object.defineProperty(this, 'storage', {
        get: function () {
            return _storage;
        },
        set: function (value) {
            if (!/^((\d+GB)|(\d+TB))$/.test(value)) throw new InvalidValueException("storage", value);
            _storage = value;
        }
    });
    Object.defineProperty(this, 'size', {
        get: function () {
            return _size;
        },
        set: function (value) {
            value = Number.parseFloat(value);
            if (Number.isNaN(value) || value < 0) throw new InvalidValueException("size", value);
            _size = value;
        }
    });
}
Smartphone.prototype = Object.create(Product.prototype); //Heredamos de Product
Smartphone.prototype.constructor = Smartphone;
Smartphone.prototype.system = "Unknown"; // Propiedad pública
Smartphone.prototype.toString = function () {
    return Product.prototype.toString.call(this) + " System: " + this.system +
        " Memoria: " + this.memory + " Almacenamiento: " + this.storage + " Resolución: " + this.resolution + " Size: " + this.size + "''";
}
//Definimos la subclase Tablet
function Tablet(serial, brand, model, price, taxPercentage = Product.IVA,
    memory = "0GB", storage = "0GB", resolution = "0x0", size = 0) {
    //La función se invoca con el operador new
    if (!(this instanceof Tablet))
        throw new InvalidAccessConstructorException();
    //Llamada al superconstructor.
    Product.call(this, serial, brand, model, price, taxPercentage);
    //Validación de argumentos
    if (!/^((\d+GB)|(\d+TB))$/.test(memory)) throw new InvalidValueException("memory", memory);
    if (!/^((\d+GB)|(\d+TB))$/.test(storage)) throw new InvalidValueException("storage", storage);
    size = Number.parseFloat(size);
    if (Number.isNaN(size) || size < 0) throw new InvalidValueException("size", size);
    if (!/^(\d+x\d+)$/.test(resolution)) throw new InvalidValueException("resolution", resolution);
    //Atributos privados
    let _memory = memory;
    let _storage = storage;
    let _resolution = resolution;
    let _size = size;
    //Propiedades de acceso a los atributos privados
    Object.defineProperty(this, 'memory', {
        get: function () {
            return _memory;
        },
        set: function (value) {
            if (!/^((\d+GB)|(\d+TB))$/.test(value)) throw new InvalidValueException("memory", value);
            _memory = value;
        }
    });
    Object.defineProperty(this, 'resolution', {
        get: function () {
            return _resolution;
        },
        set: function (value) {
            if (!/^(\d+x\d+)$/.test(value)) throw new InvalidValueException("resolution", value);
            _resolution = value;
        }
    });
    Object.defineProperty(this, 'storage', {
        get: function () {
            return _storage;
        },
        set: function (value) {
            if (!/^((\d+GB)|(\d+TB))$/.test(value)) throw new InvalidValueException("storage", value);
            _storage = value;
        }
    });
    Object.defineProperty(this, 'size', {
        get: function () {
            return _size;
        },
        set: function (value) {
            value = Number.parseFloat(value);
            if (Number.isNaN(value) || value < 0) throw new InvalidValueException("size", value);
            _size = value;
        }
    });
}
Tablet.prototype = Object.create(Product.prototype); //Heredamos de Product
Tablet.prototype.constructor = Tablet;
Tablet.prototype.system = "Unknown"; // Propiedad pública
Tablet.prototype.toString = function () {
    return Product.prototype.toString.call(this) + " System: " + this.system +
        " Memoria: " + this.memory + " Almacenamiento: " + this.storage + " Resolución: " + this.resolution + " Size: " + this.size + "''";
}                         

let producto1 = new Product("111-111-111", "HP", "Pavilion",500,21);
producto1.price = 25;

let producto2 = new Product("111-111-111", "HP", "Pavilion",500,21);

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
        return  `Serial: ${ this.serial }, Brand: ${ this.brand }, Model: ${ this.model }`;
    }
    // Método abstracto
    calculatePrice() {
        throw new Error("Abstract method calculatePrice must be implemented");
    }
}

//let abstracta1 = new AbstractProduct("111-111-111", "HP", "Pavilion");

class Phone extends AbstractProduct {
    constructor(serial, brand, model, price, tax) {
        super(serial, brand, model);
        this.price = price;
        this.tax = tax;
    }
    // Implementación del método abstracto
    calculatePrice() {
        return this.price + (this.price * this.tax / 100);
    }
}
const myPhone = new Phone("A123", "Apple", "iPhone 14", 1000, 21);
console.log(myPhone.getDetails()); // "Serial: A123, Brand: Apple, Model: iPhone 14"
console.log("Price with taxes: " + myPhone.calculatePrice()); // "Price with taxes: 1210"

function mostrarTexto(){
    console.log("Texto desde botón");
}

function agregarLaptop() {
    let portatil = new Laptop("111-111-111", "HP", "Pavilion", 500, 21, "Intel I7", "8GB", "HDD", "512GB");
    console.log("Portatil: " + portatil.toString());
    let div1 = document.getElementById("div1");

    // Crear el contenido que se va a añadir al div
    // let content = `<p><strong>Serial:</strong> ${portatil.serial}</p>
    // <p><strong>Brand:</strong> ${portatil.brand}</p>
    // <p><strong>Model:</strong> ${portatil.model}</p>
    // <p><strong>Processor:</strong> ${portatil.processor}</p>
    // <p><strong>Memory:</strong> ${portatil.memory}</p>
    // <p><strong>Hard Drive (HD):</strong> ${portatil.hd}</p>
    // <p><strong>Size:</strong> ${portatil.size}</p>
    // <p><strong>Price (without tax):</strong> $${portatil.price}</p>`;

    // div1.innerHTML = content;

    // Asignar los valores del objeto portátil a los elementos de la tabla
    document.getElementById("serial").textContent = portatil.serial;
    document.getElementById("brand").textContent = portatil.brand;
    document.getElementById("model").textContent = portatil.model;
    document.getElementById("price").textContent = "$" + portatil.price;
    document.getElementById("tax").textContent = portatil.taxPercentage + "%";
    document.getElementById("processor").textContent = portatil.processor;
    document.getElementById("memory").textContent = portatil.memory;
    document.getElementById("hd").textContent = portatil.hd;
    document.getElementById("size").textContent = portatil.size;
}

function agregarPhone() {
    let movil = new Phone("A123", "Apple", "iPhone 14", 1000, 21);
    let div2 = document.getElementById("div2");


    document.getElementById("serialMovil").textContent = movil.serial;
    document.getElementById("brandMovil").textContent = movil.brand;
    document.getElementById("modelMovil").textContent = movil.model;
    document.getElementById("priceMovil").textContent = "$" + movil.price;
    document.getElementById("taxMovil").textContent = movil.taxPercentage + "%";
    
}