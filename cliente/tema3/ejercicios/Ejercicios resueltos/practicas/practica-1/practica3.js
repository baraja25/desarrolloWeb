function create() {
    return [];
  }
  
  function isEmpty(set) {
    return set.length === 0;
  }
  
  function size(set) {
    return set.length;
  }
  
  function add(set, elem) {
    if (!isBook(elem)) {
      throw new Error("El elemento no es un Book");
    }
    if (has(set, elem)) {
      throw new Error("El ISBN ya está incluido en el conjunto");
    }
    set.push(elem);
    return set.length;
  }
  
  function has(set, elem) {
    if (!isBook(elem)) {
      throw new Error("El elemento no es un Book");
    }
    return set.some(book => book.ISBN === elem.ISBN);
  }
  
  function toString(set) {
    return set.map(book => `${book.ISBN}: ${book.title}`).join(" - ");
  }
  
  function clear(set) {
    set.length = 0;
  }
  
  function remove(set, elem) {
    if (!isBook(elem)) {
      throw new Error("El elemento no es un Book");
    }
    const index = set.findIndex(book => book.ISBN === elem.ISBN);
    if (index !== -1) {
      set.splice(index, 1);
      return true;
    }
    return false;
  }
  
  function isBook(elem) {
    const isbnPattern = /^(97(8|9))?\d{9}(\d|X)$/; // Expresión regular para ISBN
    return elem && typeof elem.ISBN === 'string' && typeof elem.title === 'string' && isbnPattern.test(elem.ISBN);
  }
  


  

  // Función de prueba

function test() {
  let set = create();

  console.log("Está vacío: " + isEmpty(set));
  console.log("Tamaño: " + size(set));

  let book1 = { ISBN: "9781234567897", title: "Book 1" }; // ISBN válido
  let book2 = { ISBN: "2222222222222", title: "Book 2" }; // ISBN válido
  let book3 = { ISBN: "3333333333333", title: "Book 3" }; // ISBN válido

  try {
    console.log("Añadir Book 1: " + add(set, book1));
    console.log("Añadir Book 2: " + add(set, book2));
    console.log("Añadir Book 3: " + add(set, book3));
    console.log("Intentar añadir Book 1 de nuevo");
    add(set, book1); // Esto debería lanzar una excepción
  } catch (error) {
    console.log("Error al añadir: " + error.message);
  }

  console.log("Conjunto: " + toString(set));

  try {
    console.log("¿Tiene Book 2?: " + has(set, book2));
    console.log("¿Tiene un objeto que no es un Book?");
    has(set, { notABook: true }); // Esto debería lanzar una excepción
  } catch (error) {
    console.log("Error al verificar: " + error.message);
  }

  try {
    console.log("Eliminar Book 2: " + remove(set, book2));
    console.log("Intentar eliminar un objeto que no es un Book");
    remove(set, { notABook: true }); // Esto debería lanzar una excepción
  } catch (error) {
    console.log("Error al eliminar: " + error.message);
  }

  console.log("Conjunto después de eliminar: " + toString(set));

  clear(set);
  console.log("Conjunto después de limpiar: " + toString(set));
  console.log("¿Está vacío?: " + isEmpty(set));
}

test();