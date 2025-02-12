document.addEventListener('DOMContentLoaded', () => {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    const sendButton = document.getElementById('sendButton');
    const clearButton = document.getElementById('clearButton');

    // Load data from sessionStorage
    const loadFormData = () => {
        nameInput.value = sessionStorage.getItem('name') || '';
        emailInput.value = sessionStorage.getItem('email') || '';
        messageInput.value = sessionStorage.getItem('message') || '';
    };

    // Save data to sessionStorage
    const saveFormData = () => {
        sessionStorage.setItem('name', nameInput.value);
        sessionStorage.setItem('email', emailInput.value);
        sessionStorage.setItem('message', messageInput.value);
    };

    // Clear form data and sessionStorage
    const clearFormData = () => {
        nameInput.value = '';
        emailInput.value = '';
        messageInput.value = '';
        sessionStorage.removeItem('name');
        sessionStorage.removeItem('email');
        sessionStorage.removeItem('message');
    };

    // Event listeners for input fields
    nameInput.addEventListener('input', saveFormData);
    emailInput.addEventListener('input', saveFormData);
    messageInput.addEventListener('input', saveFormData);

    // Event listener for send button
    sendButton.addEventListener('click', () => {
        alert('Formulario enviado con éxito');
        clearFormData();
    });

    // Event listener for clear button
    clearButton.addEventListener('click', clearFormData);

    // Load form data on page load
    loadFormData();
});