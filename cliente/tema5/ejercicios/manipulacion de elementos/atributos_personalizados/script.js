document.getElementById('showProductData').addEventListener('click', function() {
    const product = document.getElementById('product');

    // Obtener los valores de los atributos personalizados
    const productId = product.getAttribute('data-product-id');
    const productName = product.getAttribute('data-product-name');
    const productPrice = product.getAttribute('data-price');

    // Mostrar los valores en el elemento <p> con id output
    const output = document.getElementById('output');
    output.textContent = `ID: ${productId}, Nombre: ${productName}, Precio: $${productPrice}`;
});