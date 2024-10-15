// Objeto Book de ejemplo
let book = {
  ISBN: "978-84-9804-654-0",
  title: "El Quijote",
  author: "Miguel de Cervantes",
  publicationDate: new Date(1605, 0, 1),
  price: 20,
};

// Constante para el límite máximo de elementos en la lista
const MAX_CAPACITY = 10;

// Operaciones de la lista
const BookList = {
  create: function () {
    return [];
  },

  isEmpty: function (list) {
    return list.length === 0;
  },

  isFull: function (list) {
    return list.length >= MAX_CAPACITY;
  },

  size: function (list) {
    return list.length;
  },

  add: function (list, elem) {
    if (this.isFull(list)) {
      throw new Error("La lista está llena");
    }
    list.push(elem);
    return this.size(list);
  },

  addAt: function (list, elem, index) {
    if (this.isFull(list)) {
      throw new Error("La lista está llena");
    }
    if (index < 0 || index > list.length) {
      throw new Error("Índice fuera de rango");
    }
    list.splice(index, 0, elem);
    return this.size(list);
  },

  get: function (list, index) {
    if (index < 0 || index >= list.length) {
      throw new Error("Índice fuera de rango");
    }
    return list[index];
  },

  toString: function (list) {
    return list.map(book => `${book.title}`).join(" - ");
  },

  indexOf: function (list, elem) {
    return list.findIndex(book => book.ISBN === elem.ISBN);
  },

  lastIndexOf: function (list, elem) {
    for (let i = list.length - 1; i >= 0; i--) {
      if (list[i].ISBN === elem.ISBN) {
        return i;
      }
    }
    return -1;
  },

  capacity: function () {
    return MAX_CAPACITY;
  },

  clear: function (list) {
    list.length = 0;
  },

  firstElement: function (list) {
    if (this.isEmpty(list)) {
      throw new Error("La lista está vacía");
    }
    return list[0];
  },

  lastElement: function (list) {
    if (this.isEmpty(list)) {
      throw new Error("La lista está vacía");
    }
    return list[list.length - 1];
  },

  remove: function (list, index) {
    if (index < 0 || index >= list.length) {
      throw new Error("Índice fuera de rango");
    }
    return list.splice(index, 1)[0];
  },

  removeElement: function (list, elem) {
    const index = this.indexOf(list, elem);
    if (index === -1) {
      return false;
    }
    this.remove(list, index);
    return true;
  },

  set: function (list, elem, index) {
    if (index < 0 || index >= list.length) {
      throw new Error("Índice fuera de rango");
    }
    const oldElem = list[index];
    list[index] = elem;
    return oldElem;
  }
};

// Ejemplo de uso

// Crear una lista vacía
let myBookList = BookList.create();

// Agregar un libro
BookList.add(myBookList, book);

// Obtener el tamaño de la lista
console.log(BookList.size(myBookList)); // 1

// Agregar otro libro en una posición específica
let anotherBook = {
  ISBN: "978-84-1234-654-1",
  title: "Don Quijote II",
  author: "Miguel de Cervantes",
  publicationDate: new Date(1615, 0, 1),
  price: 25,
};
BookList.addAt(myBookList, anotherBook, 0);

// Imprimir los libros como una cadena
console.log(BookList.toString(myBookList)); // "Don Quijote II - El Quijote"

// Buscar por índice
console.log(BookList.get(myBookList, 0).title); // "Don Quijote II"

// Eliminar un libro
BookList.removeElement(myBookList, book);
console.log(BookList.toString(myBookList)); // "Don Quijote II"

// Vaciar la lista
BookList.clear(myBookList);
console.log(BookList.isEmpty(myBookList)); // true
