class List {
  constructor(maxCapacity) {
    this._elements = []; // Array privado
    this.MAXCAPACITY = maxCapacity; // Capacidad máxima
  }

  isEmpty() {
    return this._elements.length === 0;
  }

  isFull() {
    return this._elements.length >= this.MAXCAPACITY;
  }

  size() {
    return this._elements.length;
  }

  add(elem) {
    if (this.isFull()) {
      throw new ListFullException();
    }
    this._elements.push(elem);
    return this.size();
  }

  get(index) {
    if (this.isEmpty()) {
      throw new ListEmptyException();
    }
    if (index < 0 || index >= this.size()) {
      throw new IndexOutOfBoundsException();
    }
    return this._elements[index];
  }

  toString() {
    return this._elements.join(" - ");
  }

  indexOf(elem) {
    return this._elements.indexOf(elem);
  }

  remove(index) {
    if (this.isEmpty()) {
      throw new ListEmptyException();
    }
    if (index < 0 || index >= this.size()) {
      throw new IndexOutOfBoundsException();
    }
    this._elements.splice(index, 1);
    return this.size();
  }

  clear() {
    this._elements = [];
  }
}

class ObjectList extends List {
  constructor(maxCapacity, type) {
    super(maxCapacity);
    this.type = type; // Tipo de objetos que admite
  }

  add(elem) {
    if (typeof elem !== this.type) {
      throw new InvalidTypeException();
    }
    return super.add(elem);
  }

  get(index) {
    return super.get(index);
  }
}

class OrderedObjectList extends ObjectList {
  constructor(maxCapacity, type, orderFunction) {
    super(maxCapacity, type);
    this.orderFunction = orderFunction; // Función de ordenación
  }

  add(elem) {
    if (typeof elem !== this.type) {
      throw new InvalidTypeException();
    }
    super.add(elem);
    this._elements.sort(this.orderFunction); // Ordenar después de agregar
    return this.size();
  }
}


// Función de prueba
function test() {
  const book1 = {
    ISBN: "978-84-9804-654-0",
    title: "El Quijote",
    author: "Miguel de Cervantes",
    publicationDate: new Date(1605, 0, 1),
    price: 20,
  };

  const book2 = {
    ISBN: "978-84-9804-654-0",
    title: "lol",
    author: "Miguel de Cervantes",
    publicationDate: new Date(1605, 0, 1),
    price: 20,
  };

  const bookOrderFunction = (a, b) => a.title.localeCompare(b.title);
  const orderedList = new OrderedObjectList(10, 'object', bookOrderFunction);

  console.log("Capacidad: " + orderedList.MAXCAPACITY);
  console.log("Es vacía: " + orderedList.isEmpty());
  console.log("Tamaño: " + orderedList.size());

  // Agregar libros
  orderedList.add(book1);
  orderedList.add(book2);
  console.log(orderedList.toString());

  console.log("Primer elemento: " + orderedList.get(0).title);
  console.log("Último elemento: " + orderedList.get(orderedList.size() - 1).title);

  console.log("Índice del libro 'El Quijote': " + orderedList.indexOf(book1));

  orderedList.remove(1);
  console.log("Eliminar elemento en posición 1: " + orderedList.toString());

}