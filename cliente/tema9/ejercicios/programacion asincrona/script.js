// Elemento donde mostraremos los resultados
const output = document.getElementById("output");

// Función para obtener datos simulando tiempos de respuesta variables
function fetchData(url) {
    return new Promise((resolve, reject) => {
        const time = Math.random() * 3000; // Simula tiempos entre 0 y 3 segundos
        setTimeout(() => {
            fetch(url)
                .then(response => {
                    if (!response.ok) throw new Error(`Error en ${url}`);
                    return response.json();
                })
                .then(data => resolve({ url, data, time }))
                .catch(error => reject(error));
        }, time);
    });
}

// URLs de prueba (API pública)
const userAPI = "https://jsonplaceholder.typicode.com/users";
const postsAPI = "https://jsonplaceholder.typicode.com/posts";
const commentsAPI = "https://jsonplaceholder.typicode.com/comments";

// Crear la base de datos IndexedDB
let db;
const request = indexedDB.open("dataDB", 1);

request.onupgradeneeded = function(event) {
    db = event.target.result;
    const objectStore = db.createObjectStore("users", { keyPath: "id" });
    objectStore.createIndex("name", "name", { unique: true });
};

request.onsuccess = function(event) {
    db = event.target.result;
};

request.onerror = function(event) {
    console.error("Error opening IndexedDB:", event.target.errorCode);
};

// Almacenar los datos en IndexedDB
function storeData(data) {
    const transaction = db.transaction(["users"], "readwrite");
    const objectStore = transaction.objectStore("users");

    data.forEach(user => {
        const request = objectStore.add(user);
        request.onsuccess = function() {
            console.log(`User ${user.name} added to IndexedDB`);
        };
        request.onerror = function() {
            console.log(`User ${user.name} already exists in IndexedDB`);
        };
    });
}

// Recuperar los datos de IndexedDB
function getDataFromDB() {
    return new Promise((resolve, reject) => {
        const transaction = db.transaction(["users"], "readonly");
        const objectStore = transaction.objectStore("users");
        const request = objectStore.getAll();

        request.onsuccess = function(event) {
            resolve(event.target.result);
        };

        request.onerror = function(event) {
            reject(event.target.errorCode);
        };
    });
}

// Modificar el DOM con los resultados
function displayData(data) {
    output.innerHTML = "";
    data.forEach(user => {
        const userDiv = document.createElement("div");
        userDiv.innerHTML = `<strong>${user.name}</strong> (${user.email})`;
        output.appendChild(userDiv);
    });
}

// Promise.all() - Espera a todas las respuestas o falla si una falla
function fetchAll() {
    output.textContent = "Cargando datos con Promise.all()...";
    Promise.all([fetchData(userAPI), fetchData(postsAPI)])
        .then(results => {
            const users = results[0].data;
            storeData(users);
            displayData(users);
        })
        .catch(error => {
            output.textContent = "Promise.all() - Error:\n" + error.message;
        });
}

// Promise.allSettled() - Espera a todas sin importar si fallan
function fetchAllSettled() {
    output.textContent = "Cargando datos con Promise.allSettled()...";
    Promise.allSettled([fetchData(userAPI), fetchData("https://wrong.url"), fetchData(postsAPI)])
        .then(results => {
            const users = results[0].status === "fulfilled" ? results[0].value.data : [];
            storeData(users);
            displayData(users);
        });
}

// Promise.race() - Toma el primer resultado exitoso o fallido
function fetchRace() {
    output.textContent = "Cargando datos con Promise.race()...";
    Promise.race([fetchData(userAPI), fetchData(postsAPI)])
        .then(result => {
            const users = result.data;
            storeData(users);
            displayData(users);
        })
        .catch(error => {
            output.textContent = "Promise.race() - Error:\n" + error.message;
        });
}

// Promise.any() - Toma el primer éxito y descarta los errores
function fetchAny() {
    output.textContent = "Cargando datos con Promise.any()...";
    Promise.any([fetchData("https://wrong.url"), fetchData(userAPI), fetchData(postsAPI)])
        .then(result => {
            const users = result.data;
            storeData(users);
            displayData(users);
        })
        .catch(error => {
            output.textContent = "Promise.any() - Todas fallaron:\n" + error.message;
        });
}

// Verificar si los datos están en IndexedDB antes de hacer la solicitud
function fetchDataWithCache(fetchFunction) {
    getDataFromDB()
        .then(data => {
            if (data.length > 0) {
                displayData(data);
            } else {
                fetchFunction();
            }
        })
        .catch(error => {
            console.error("Error retrieving data from IndexedDB:", error);
            fetchFunction();
        });
}

// Modificar los botones para usar la función de caché
document.querySelector("button[onclick='fetchAll()']").onclick = () => fetchDataWithCache(fetchAll);
document.querySelector("button[onclick='fetchAllSettled()']").onclick = () => fetchDataWithCache(fetchAllSettled);
document.querySelector("button[onclick='fetchRace()']").onclick = () => fetchDataWithCache(fetchRace);
document.querySelector("button[onclick='fetchAny()']").onclick = () => fetchDataWithCache(fetchAny);