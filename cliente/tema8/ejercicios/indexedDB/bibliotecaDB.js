// Nombre de la base de datos y versión
const DB_NAME = "BibliotecaDB";
const DB_VERSION = 1;

let db;

// Inicialización de la base de datos
function initDB() {
    const request = indexedDB.open(DB_NAME, DB_VERSION);

    request.onupgradeneeded = function (event) {
        db = event.target.result;

        // Crear la tabla "socios"
        if (!db.objectStoreNames.contains("socios")) {
            const sociosStore = db.createObjectStore("socios", { keyPath: "id", autoIncrement: true });
            sociosStore.createIndex("nombre", "nombre", { unique: false });
        }

        // Crear la tabla "libros"
        if (!db.objectStoreNames.contains("libros")) {
            const librosStore = db.createObjectStore("libros", { keyPath: "id", autoIncrement: true });
            librosStore.createIndex("titulo", "titulo", { unique: false });
        }

        // Crear la tabla "préstamos"
        if (!db.objectStoreNames.contains("prestamos")) {
            const prestamosStore = db.createObjectStore("prestamos", { keyPath: "id", autoIncrement: true });
            prestamosStore.createIndex("socioId", "socioId", { unique: false });
            prestamosStore.createIndex("libroId", "libroId", { unique: false });
        }

        console.log("Base de datos inicializada");
    };

    request.onsuccess = function (event) {
        db = event.target.result;
        console.log("Conexión exitosa a la base de datos");
    };

    request.onerror = function (event) {
        console.error("Error al abrir la base de datos", event.target.errorCode);
    };
}

// Función para agregar un registro a un almacén específico
function agregarRegistro(storeName, data, callback) {
    const transaction = db.transaction([storeName], "readwrite");
    const objectStore = transaction.objectStore(storeName);
    const request = objectStore.add(data);

    request.onsuccess = function () {
        callback(true);
    };

    request.onerror = function () {
        callback(false);
    };
}

// Función para cargar libros iniciales en el almacén "libros"
function cargarLibros() {
    const libros = [
        { titulo: "Cien Años de Soledad", autor: "Gabriel García Márquez" },
        { titulo: "Don Quijote de la Mancha", autor: "Miguel de Cervantes" },
        { titulo: "1984", autor: "George Orwell" },
        { titulo: "El Principito", autor: "Antoine de Saint-Exupéry" },
        { titulo: "Ficciones", autor: "Jorge Luis Borges" }
    ];

    libros.forEach((libro) => {
        agregarRegistro("libros", libro, (success) => {
            if (success) {
                console.log(`Libro "${libro.titulo}" agregado exitosamente.`);
            } else {
                console.error(`Error al agregar el libro "${libro.titulo}".`);
            }
        });
    });
}

// Ejercicio 1: Usar un cursor para recorrer el almacén "libros"
function listarLibros() {
    const transaction = db.transaction(["libros"], "readonly");
    const objectStore = transaction.objectStore("libros");
    const request = objectStore.openCursor();

    request.onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            console.log("ID:", cursor.key, "Título:", cursor.value.titulo, "Autor:", cursor.value.autor);
            cursor.continue();
        } else {
            console.log("No hay más libros.");
        }
    };

    request.onerror = function (event) {
        console.error("Error al recorrer los libros", event.target.errorCode);
    };
}

// Ejercicio 2: Eliminar libros según una condición
function eliminarLibrosLargos() {
    const transaction = db.transaction(["libros"], "readwrite");
    const objectStore = transaction.objectStore("libros");
    const request = objectStore.openCursor();

    request.onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            if (cursor.value.titulo.length > 15) {
                objectStore.delete(cursor.key);
                console.log(`Libro "${cursor.value.titulo}" eliminado.`);
            }
            cursor.continue();
        } else {
            console.log("No hay más libros.");
        }
    };

    request.onerror = function (event) {
        console.error("Error al eliminar libros", event.target.errorCode);
    };
}

// Ejercicio 3: Modificar un registro
function modificarTituloLibro(id, nuevoTitulo) {
    const transaction = db.transaction(["libros"], "readwrite");
    const objectStore = transaction.objectStore("libros");
    const request = objectStore.get(id);

    request.onsuccess = function (event) {
        const libro = event.target.result;
        libro.titulo = nuevoTitulo;
        const updateRequest = objectStore.put(libro);

        updateRequest.onsuccess = function () {
            console.log(`Título del libro con ID ${id} actualizado a "${nuevoTitulo}".`);
        };

        updateRequest.onerror = function () {
            console.error("Error al actualizar el título del libro.");
        };
    };

    request.onerror = function (event) {
        console.error("Error al obtener el libro", event.target.errorCode);
    };
}

// Ejercicio 4: Agregar registros
function agregarSocios() {
    const socios = [
        { nombre: "María López", edad: 25 },
        { nombre: "Carlos Gómez", edad: 34 },
        { nombre: "Ana Martínez", edad: 29 },
        { nombre: "Jorge Ramírez", edad: 42 }
    ];

    socios.forEach((socio) => {
        agregarRegistro("socios", socio, (success) => {
            if (success) {
                console.log(`Socio "${socio.nombre}" agregado exitosamente.`);
            } else {
                console.error(`Error al agregar el socio "${socio.nombre}".`);
            }
        });
    });
}

// Ejercicio 5: Buscar un socio por nombre
function buscarSocioPorNombre(nombre) {
    const transaction = db.transaction(["socios"], "readonly");
    const objectStore = transaction.objectStore("socios");
    const index = objectStore.index("nombre");
    const request = index.get(nombre);

    request.onsuccess = function (event) {
        const socio = event.target.result;
        if (socio) {
            console.log(`ID: ${socio.id}, Nombre: ${socio.nombre}, Edad: ${socio.edad}`);
        } else {
            console.log(`No existe un socio con el nombre "${nombre}".`);
        }
    };

    request.onerror = function (event) {
        console.error("Error al buscar el socio", event.target.errorCode);
    };
}

// Ejercicio 6: Modificar la edad de un socio
function modificarEdadSocio(id, nuevaEdad) {
    const transaction = db.transaction(["socios"], "readwrite");
    const objectStore = transaction.objectStore("socios");
    const request = objectStore.get(id);

    request.onsuccess = function (event) {
        const socio = event.target.result;
        socio.edad = nuevaEdad;
        const updateRequest = objectStore.put(socio);

        updateRequest.onsuccess = function () {
            console.log(`La edad del socio ${socio.nombre} ha sido actualizada a ${nuevaEdad}.`);
        };

        updateRequest.onerror = function () {
            console.error("Error al actualizar la edad del socio.");
        };
    };

    request.onerror = function (event) {
        console.error("Error al obtener el socio", event.target.errorCode);
    };
}

// Ejercicio 7: Eliminar préstamos
function eliminarPrestamosPorSocio(socioId) {
    const transaction = db.transaction(["prestamos"], "readwrite");
    const objectStore = transaction.objectStore("prestamos");
    const index = objectStore.index("socioId");
    const request = index.openCursor(IDBKeyRange.only(socioId));

    request.onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            objectStore.delete(cursor.primaryKey);
            console.log(`Préstamo con ID ${cursor.primaryKey} eliminado.`);
            cursor.continue();
        } else {
            console.log(`Préstamos del socio con ID ${socioId} eliminados.`);
        }
    };

    request.onerror = function (event) {
        console.error("Error al eliminar los préstamos", event.target.errorCode);
    };
}

// Ejercicio 8: Buscar libros prestados a un socio
function buscarLibrosPorSocio(socioId) {
    const transaction = db.transaction(["prestamos"], "readonly");
    const objectStore = transaction.objectStore("prestamos");
    const index = objectStore.index("socioId");
    const request = index.openCursor(IDBKeyRange.only(socioId));

    const librosPrestados = [];

    request.onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            const libroId = cursor.value.libroId;
            const libroRequest = db.transaction(["libros"], "readonly").objectStore("libros").get(libroId);

            libroRequest.onsuccess = function (event) {
                const libro = event.target.result;
                librosPrestados.push(libro.titulo);
                cursor.continue();
            };
        } else {
            console.log(`Libros prestados al socio con ID ${socioId}: ${librosPrestados.join(", ")}`);
        }
    };

    request.onerror = function (event) {
        console.error("Error al buscar los libros prestados", event.target.errorCode);
    };
}

// Ejercicio 9: Mostrar estadísticas
function mostrarEstadisticas() {
    const transaction = db.transaction(["socios", "libros", "prestamos"], "readonly");

    const sociosStore = transaction.objectStore("socios");
    const librosStore = transaction.objectStore("libros");
    const prestamosStore = transaction.objectStore("prestamos");

    const sociosRequest = sociosStore.count();
    const librosRequest = librosStore.count();
    const prestamosRequest = prestamosStore.count();

    sociosRequest.onsuccess = function () {
        console.log(`Total de socios: ${sociosRequest.result}`);
    };

    librosRequest.onsuccess = function () {
        console.log(`Total de libros: ${librosRequest.result}`);
    };

    prestamosRequest.onsuccess = function () {
        console.log(`Número de préstamos registrados: ${prestamosRequest.result}`);
    };

    sociosRequest.onerror = librosRequest.onerror = prestamosRequest.onerror = function (event) {
        console.error("Error al obtener las estadísticas", event.target.errorCode);
    };
}

// Ejercicio 10: Filtrar libros por autor
function filtrarLibrosPorAutor(autor) {
    const transaction = db.transaction(["libros"], "readonly");
    const objectStore = transaction.objectStore("libros");
    const request = objectStore.openCursor();

    const librosDelAutor = [];

    request.onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            if (cursor.value.autor === autor) {
                librosDelAutor.push(cursor.value.titulo);
            }
            cursor.continue();
        } else {
            console.log(`Libros de ${autor}: ${librosDelAutor.join(", ")}`);
        }
    };

    request.onerror = function (event) {
        console.error("Error al filtrar los libros por autor", event.target.errorCode);
    };
}

// Ejercicio 11: Crear un préstamo
function crearPrestamo(socioId, libroId) {
    const prestamo = { socioId, libroId };
    agregarRegistro("prestamos", prestamo, (success) => {
        if (success) {
            console.log(`Préstamo registrado: Socio ID ${socioId} -> Libro ID ${libroId}`);
        } else {
            console.error("Error al registrar el préstamo.");
        }
    });
}

// Ejercicio 12: Eliminar libros no prestados
function eliminarLibrosNoPrestados() {
    const transaction = db.transaction(["libros", "prestamos"], "readwrite");
    const librosStore = transaction.objectStore("libros");
    const prestamosStore = transaction.objectStore("prestamos");
    const request = librosStore.openCursor();

    request.onsuccess = function (event) {
        const cursor = event.target.result;
        if (cursor) {
            const libroId = cursor.key;
            const prestamoRequest = prestamosStore.index("libroId").get(libroId);

            prestamoRequest.onsuccess = function (event) {
                if (!event.target.result) {
                    librosStore.delete(libroId);
                    console.log(`Libro "${cursor.value.titulo}" eliminado.`);
                }
                cursor.continue();
            };
        } else {
            console.log("No hay más libros.");
        }
    };

    request.onerror = function (event) {
        console.error("Error al eliminar libros no prestados", event.target.errorCode);
    };
}

// Llamar a la función después de inicializar la base de datos
initDB();
setTimeout(cargarLibros, 1000);
setTimeout(listarLibros, 2000);