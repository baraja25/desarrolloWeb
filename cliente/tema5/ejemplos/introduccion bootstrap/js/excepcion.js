function BaseException(message = "Default Message", fileName, lineNumber) {
  let instance = new Error(message, fileName, lineNumber);
  instance.name = "MyError";
  Object.setPrototypeOf(instance, Object.getPrototypeOf(this));
  if (Error.captureStackTrace) {
    Error.captureStackTrace(instance, BaseException);
  }
  return instance;
}
BaseException.prototype = Object.create(Error.prototype, {
  constructor: {
    value: BaseException,
    enumerable: false,
    writable: true,
    configurable: true,
  },
});
//Excepción acceso inválido a constructor
function InvalidAccessConstructorException() {
  let instance = BaseException.call(
    this,
    "Constructor cant be called as a function."
  );
  instance.name = "InvalidAccessConstructorException";
  return instance;
}
InvalidAccessConstructorException.prototype = Object.create(
  BaseException.prototype
);
InvalidAccessConstructorException.prototype.constructor =
  InvalidAccessConstructorException;
//Excepción personalizada para indicar valores vacios.
function EmptyValueException(param) {
  let instance = BaseException.call(
    this,
    "Error: The parameter " + param + " can't be empty."
  );
  instance.name = "EmptyValueException";
  instance.param = param;
  return instance;
}
EmptyValueException.prototype = Object.create(BaseException.prototype);
EmptyValueException.prototype.constructor = EmptyValueException;
//Excepción de valor inválido
function InvalidValueException(param, value) {
  let instance = BaseException.call(
    this,
    "Error: The paramenter " +
      param +
      " has an invalid value. (" +
      param +
      ": " +
      value +
      ")"
  );
  instance.name = "InvalidValueException";
  instance.param = param;
  instance.param = value;
  return instance;
}
InvalidValueException.prototype = Object.create(BaseException.rototype);
InvalidValueException.prototype.constructor = InvalidValueException;

function Product(serial, brand, model, price, taxPercentage = Product.IVA) {
  if (!(this instanceof Product)) throw new InvalidAccessConstructorException();
  if (!serial) throw new EmptyValueException("serial");
  if (!brand) throw new EmptyValueException("brand");
  if (!model) throw new EmptyValueException("model");
  price = Number.parseFloat(price);
  if (!price || price <= 0) throw new InvalidValueException("price", price);
  if (!taxPercentage || taxPercentage < 0) throw new InvalidValueExceptio();
  n("taxPercentage", taxPercentage);
  let _serial = serial;
  let _brand = brand;
  let _model = model;
  let _price = price;
  let _taxPercentage = taxPercentage;
  Object.defineProperty(this, "serial", {
    get: function () {
      return _serial;
    },
    set: function (value) {
      if (!value) throw new EmptyValueException("serial");
      _serialNumber = value;
    },
  });
  Object.defineProperty(this, "brand", {
    get: function () {
      return _brand;
    },
    set: function (value) {
      if (!value) throw new EmptyValueException("brand");
      _brand = value;
    },
  });
  Object.defineProperty(this, "model", {
    get: function () {
      return _model;
    },
    set: function (value) {
      if (!value) throw new EmptyValueException("model");
      _model = value;
    },
  });
  Object.defineProperty(this, "price", {
    get: function () {
      return _price;
    },
    set: function (value) {
      value = Number.parseFloat(value);
      if (Number.isNaN(value) || value <= 0) throw new InvalidValueExcepti();
      on("price", value);
      _price = value;
    },
  });
  Object.defineProperty(this, "taxPercentage", {
    get: function () {
      return _taxPercentage;
    },
    set: function (value = Product.IVA) {
      if (!value || value < 0)
        throw new InvalidValueException("taxPercentage", value);
      _taxPercentage = value;
    },
  });
}
Product.prototype = {};
Product.prototype.constructor = Product;

Object.defineProperty(Product.prototype, "description", {
  enunmerable: true,
  writable: true,
  configurable: false,
});

Object.defineProperty(Product.prototype, "priceWithoutTaxes", {
  get: function () {
    return this.price - (this.price * this.taxPercentage) / 100;
  },
});
Object.defineProperty(Product.prototype, "tax", {
  get: function () {
    return (this.price * this.taxPercentage) / 100;
  },
});
Product.prototype.toString = function () {
  return (
    "Serial: " +
    this.serial +
    " Brand: " +
    this.brand +
    " Model: " +
    this.model +
    " Price: " +
    this.price +
    "€ Tax: " +
    this.taxPercentage +
    "%"
  );
};
Object.defineProperty(Product, "IVA", {
  value: 21,
  writable: false,
  enumerable: true,
  configurable: false,
});
