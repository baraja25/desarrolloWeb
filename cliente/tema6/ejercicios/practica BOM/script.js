const products = [
    {
        id: 1,
        name: "Producto 1",
        description: "Descripción del Producto 1",
        price: 100,
        images: ["https://via.placeholder.com/150", "https://via.placeholder.com/150/0000FF"],
    },
    {
        id: 2,
        name: "Producto 2",
        description: "Descripción del Producto 2",
        price: 200,
        images: ["https://via.placeholder.com/150/FF0000", "https://via.placeholder.com/150/00FF00"],
    },
    // Agrega más productos según sea necesario
];

let openWindows = [];

document.getElementById("search").addEventListener("input", filterProducts);
document.getElementById("closeWindows").addEventListener("click", closeAllWindows);
document.getElementById("toggleTheme").addEventListener("click", toggleTheme);

function filterProducts() {
    const query = this.value.toLowerCase();
    const filteredProducts = products.filter(product => product.name.toLowerCase().includes(query));
    displayProducts(filteredProducts);
}

function displayProducts(productsToDisplay) {
    const productList = document.getElementById("productList");
    productList.innerHTML = "";
    productsToDisplay.forEach(product => {
        const productCard = document.createElement("div");
        productCard.className = "card product-card";
        productCard.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">${product.name}</h5>
                <p class="card-text">${product.description}</p>
                <p class="card-text">$${product.price}</p>
                <button class="btn btn-primary" onclick="openProductWindow(${product.id})">Ver Más</button>
            </div>
        `;
        productList.appendChild(productCard);
    });
}

function openProductWindow(productId) {
    const product = products.find (product => product.id === productId);
    if (product) {
        const productWindow = window.open("", "_blank", "width=400,height=400");
        productWindow.document.write(`
            <html>
            <head>
                <title>${product.name}</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            </head>
            <body>
                <div class="container">
                    <h1>${product.name}</h1>
                    <p>${product.description}</p>
                    <p>Precio: $${product.price}</p>
                    <div class="gallery">
                        ${product.images.map(img => `<img src="${img}" class="img-fluid" style="width: 100%; margin-bottom: 10px;">`).join('')}
                    </div>
                    <button class="btn btn-secondary" onclick="window.close()">Regresar</button>
                </div>
            </body>
            </html>
        `);
        openWindows.push(productWindow);
        productWindow.onbeforeunload = () => {
            openWindows = openWindows.filter(win => win !== productWindow);
        };
    }
}

function closeAllWindows() {
    if (openWindows.length === 0) {
        alert("No hay ventanas abiertas.");
    } else {
        openWindows.forEach(win => win.close());
        openWindows = [];
    }
}

function toggleTheme() {
    document.body.classList.toggle("dark-theme");
}

// Inicializar la lista de productos al cargar la página
displayProducts(products);