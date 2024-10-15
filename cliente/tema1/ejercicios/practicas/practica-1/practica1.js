let book = {
  ISBN: "978-84-9804-654-0",
  title: "El Quijote",
  author: "Miguel de Cervantes",
  publicationDate: new Date(1605, 0, 1),
  price: 20,
};

let book2 = {
  ISBN: "978-84-9804-654-0",
  title: "lol",
  author: "Miguel de Cervantes",
  publicationDate: new Date(1605, 0, 1),
  price: 20,
};

function create() {
  return [];
}

function isEmpty(lista) {
  return lista.length === 0;
}

function isFull(lista) {
  return lista.length >= MAXCAPACITY;
}

function size(lista) {
  return lista.length;
}

function add(lista, elem) {
    if (isFull(lista)) {
        throw "La lista esta llena";
      }
      lista.push(elem);
      return lista.length;
}

function addAt(list, book, index) {
    if (isFull(lista)) {
        throw "La lista esta llena";
      }
  list.splice(index, 0, book);
  return list.length;
}

function get(lista, index) {
    if (isEmpty(lista)) throw "La lista esta vacia";
    if (index < 0 || index >= lista.length) {
      throw "Index out of bounds";
    }
    return lista[index];
}

function toString(lista) {
  return lista.reduceRight(function (str, item, index) {
    return index !== lista.length - 1 ? str + " - " + item : str + item;
  }, "");
}

function indexOf(lista, elem) {
  return lista.indexOf(elem);
}

function primerElemento(lista) {
  if (isEmpty(lista)) throw "La lista esta vacia";
  return lista[0];
}

function ultimoElemento(lista) {
  if (isEmpty(lista)) throw "La lista esta vacia";
  return lista[lista.length - 1];
}

function capacidad(lista) {
  return MAXCAPACITY;
}

function eliminar(lista, index) {
  if (isEmpty(lista)) throw "La lista esta vacia";
  lista.splice(index, 1);
  return lista.length;
}

function eliminarElemento(lista, elem) {
    if (isEmpty(lista)) throw "La lista esta vacia";
  let index = lista.indexOf(elem);
  if (index !== -1) {
    lista.splice(index, 1);
  }
  return lista.length;
}

function set(lista, elem, index) {
    if (isEmpty(lista)) throw "La lista esta vacia";
  if (index < 0 || index >= lista.length) {
    throw "Index out of bounds";
  }
  lista[index] = elem;
  return lista.length;
}

const MAXCAPACITY = 10;

function test() {
  let lista = create();

  console.log("Capacidad: " + capacidad(lista));
  console.log("Es vacia: " + isEmpty(lista));
  console.log("Tamaño: " + size(lista));

  for (let i = 0; i < MAXCAPACITY; i++) {
    console.log("numero de elementos: " + add(lista, book));
  }

  console.log(toString(lista));
  console.log(primerElemento(lista));
  console.log(ultimoElemento(lista));

  console.log("Posicion del elemento 4 " + get(lista, 4));

  console.log("Posicion del libro 'El Quijote' " + indexOf(lista, book));

  eliminar(lista, 4);
  console.log("Eliminar elemento en posicion 4: " + toString(lista));

  eliminarElemento(lista, book);
  console.log("Eliminar elemento 'El Quijote': " + toString(lista));

  set(lista, book2, 0);
  console.log("Set elemento en posicion 0: " + toString(lista));
}

test();
