// ejercicio 1
function mostrarClaves(producto) {
  const claves = Object.keys(producto);
  const valores = Object.values(producto);

  const mensajeClaves = `Claves: ${claves.join(", ")}`;
  const mensajeValores = `Valores ${valores.join(", ")}`;

  console.log(mensajeClaves);
  console.log(mensajeValores);
}
// ejemplo
const product1 = {
  serial: "111-111-111",
  name: "Portátil",
  price: 750,
};

mostrarClaves(product1);

// ejercicio 2

const product2 = {
  serial: "111-111-112",
  name: "Tablet",
  stock: 20,
};

product3 = Object.assign({}, product1, product2);
console.log(product3);

// ejercicio 3

function Product(serial, name, price) {
  this.serial = serial;
  this.name = name;
  this.price = price;
  this.fullName = function () {
    return `${this.serial}: ${this.name}`;
  };
}

const product4 = new Product("111-111-113", "Telefono", 500);
console.log(product4.fullName());

//ejercicio 4
const newProduct = Object.create(product1);
newProduct.category = "Electronica";
console.log(newProduct);
//console.log(newProduct.fullName());

//ejercicio 5

function mergeProducts(productA, productB) {
  if (productA.serial === productB.serial) {
    console.log("Producto ya existente");
  } else {
    const mergedProduct = Object.assign({}, productA, productB);
    console.log(mergedProduct);
  }
}

const productA = { serial: "111-111-111", name: "Portátil", price: 750 };
const productB = { serial: "111-111-111", name: "Laptop", stock: 10 };

mergeProducts(productA, productB);
