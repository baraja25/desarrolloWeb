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

//devuelve una lista vacia
function create() {
  return [];
}

//devuelve true si esta vacia
function isEmpty(lista) {
  return lista.length === 0;
}

//devuelve true si esta llena
function isFull(lista) {
  return lista.length >= MAXCAPACITY;
}
//devuelve la longitud de la lista
function size(lista) {
  return lista.length;
}

//agrega un elemento a la lista si no esta llena y si el elemento es un libro. Lanza excepcion si esta llena o el elemento no es un libro
function add(lista, elem) {
  if (!isBook(elem)) {
    throw "El elemento no es un Book";
  }
  if (isFull(lista)) {
    throw "La lista esta llena";
  }
  lista.push(elem);
  return lista.length;
}

// agrega un elemento elem a la lista en la posición index si no está llena y si elem es un objeto Book. Lanza una excepción si la lista está llena, si index está fuera de los límites de la lista o si elem no es un objeto Book.
function addAt(list, elem, index) {
  if (!isBook(elem)) {
    throw "El elemento no es un Book";
  }
  if (isFull(list)) {
    throw "La lista esta llena";
  }
  if (index < 0 || index > list.length) {
    throw "El índice está fuera de los límites de la lista";
  }
  list.splice(index, 0, elem);
  return list.length;
}

// devuelve el elemento en la posición index de la lista si no está vacía y si index está dentro de los límites de la lista. Lanza una excepción si la lista está vacía o si index está fuera de los límites de la lista.
function get(lista, index) {
  if (isEmpty(lista)) {
    throw "La lista esta vacia";
  }
  if (index < 0 || index >= lista.length) {
    throw "El índice está fuera de los límites de la lista";
  }
  return lista[index];
}

// devuelve una cadena que representa la lista, separando los elementos con guiones.
function toString(lista) {
  return lista.reduceRight(function (str, item, index) {
    return index !== lista.length - 1 ? str + " - " + item : str + item;
  }, "");
}

//devuelve la posición del elemento elem en la lista si existe, o -1 si no existe.
function indexOf(lista, elem) {
  if (!isBook(elem)) {
    throw "El elemento no es un Book";
  }
  return lista.indexOf(elem);
}

// devuelve el primer elemento de una lista
function primerElemento(lista) {
  if (isEmpty(lista)) {
    throw "La lista esta vacia";
  }
  return lista[0];
}
// devuelve el ultimo elemento de una lista
function ultimoElemento(lista) {
  if (isEmpty(lista)) {
    throw "La lista esta vacia";
  }
  return lista[lista.length - 1];
}

// devuelve la capacidad maxima
function capacidad(lista) {
  return MAXCAPACITY;
}

// elimina el elemento en la posición index de la lista si no está vacía y si index está dentro de los límites de la lista. Lanza una excepción si la lista está vacía o si index está fuera de los límites de la lista.
function eliminar(lista, index) {
  if (isEmpty(lista)) {
    throw "La lista esta vacia";
  }
  if (index < 0 || index >= lista.length) {
    throw "El índice está fuera de los límites de la lista";
  }
  lista.splice(index, 1);
  return lista.length;
}

// elimina el elemento elem de la lista si existe y si no está vacía. Lanza una excepción si la lista está vacía o si elem no es un objeto Book.
function eliminarElemento(lista, elem) {
  if (isEmpty(lista)) {
    throw "La lista esta vacia";
  }
  if (!isBook(elem)) {
    throw "El elemento no es un Book";
  }
  let index = lista.indexOf(elem);
  if (index !== -1) {
    lista.splice(index, 1);
  }
  return lista.length;
}

// establece el elemento elem en la posición index de la lista si no esta vacía y si index está dentro de los límites de la lista. Lanza una excepción si la lista está vacía, si index está fuera de los límites de la lista o si elem no es un objeto Book.
function set(lista, elem, index) {
  if (isEmpty(lista)) {
    throw "La lista esta vacia";
  }
  if (!isBook(elem)) {
    throw "El elemento no es un Book";
  }
  if (index < 0 || index >= lista.length) {
    throw "El índice está fuera de los límites de la lista";
  }
  lista[index] = elem;
  return lista.length;
}

// devuelve true si elem es un objeto Book, es decir, si tiene propiedades ISBN y title.
function isBook(elem) {
  return elem && elem.ISBN && elem.title;
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
