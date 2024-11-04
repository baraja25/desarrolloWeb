const MAXCAPACITY = 10;

function create() {
  return [];
}

function isEmpty(list) {
  return list.length === 0;
}

function isFull(list) {
  return list.length >= MAXCAPACITY;
}

function size(list) {
  return list.length;
}

function add(list, elem) {
  if (!isBook(elem)) {
    throw new Error("El elemento no es un Book");
  }
  if (isFull(list)) {
    throw new Error("La lista está llena");
  }
  
  let index = 0;
  while (index < list.length && list[index].ISBN < elem.ISBN) {
    index++;
  }
  
  list.splice(index, 0, elem);
  return list.length;
}

function get(list, index) {
  if (index < 0 || index >= list.length) {
    throw new Error("El índice está fuera de los límites de la lista");
  }
  return list[index];
}

function toString(list) {
  return list.map(book => book.ISBN).join(" - ");
}

function indexOf(list, elem) {
  if (!isBook(elem)) {
    throw new Error("El elemento no es un Book");
  }
  return list.findIndex(book => book.ISBN === elem.ISBN);
}

function capacity() {
  return MAXCAPACITY;
}

function clear(list) {
  list.length = 0;
}

function firstElement(list) {
  if (isEmpty(list)) {
    throw new Error("La lista está vacía");
  }
  return list[0];
}

function lastElement(list) {
  if (isEmpty(list)) {
    throw new Error("La lista está vacía");
  }
  return list[list.length - 1];
}

function remove(list, index) {
  if (index < 0 || index >= list.length) {
    throw new Error("El índice está fuera de los límites de la lista");
  }
  return list.splice(index, 1)[0];
}

function removeElement(list, elem) {
  if (!isBook(elem)) {
    throw new Error("El elemento no es un Book");
  }
  const index = indexOf(list, elem);
  if (index !== -1) {
    list.splice(index, 1);
    return true;
  }
  return false;
}

function isBook(elem) {
  return elem && typeof elem.ISBN === 'string' && typeof elem.title === 'string';
}

// Función de prueba
function test() {
  let list = create();

  console.log("Capacidad: " + capacity());
  console.log("Está vacía: " + isEmpty(list));
  console.log("Tamaño: " + size(list));

  let book1 = { ISBN: "111", title: "Book 1" };
  let book2 = { ISBN: "222", title: "Book 2" };
  let book3 = { ISBN: "333", title: "Book 3" };

  try {
    add(list, book2);
    add(list, book1);
    add(list, book3);

    console.log("Lista ordenada: " + toString(list));
    console.log("Primer elemento: ", firstElement(list));
    console.log("Último elemento: ", lastElement(list));

    console.log("Elemento en posición 1: ", get(list, 1));
    console.log("Posición del libro 'Book 2': " + indexOf(list, book2));

    remove(list, 1);
    console.log("Eliminar elemento en posición 1: " + toString(list));

    removeElement(list, book3);
    console.log("Eliminar elemento 'Book 3': " + toString(list));