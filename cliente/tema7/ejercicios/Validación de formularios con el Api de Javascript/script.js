document.addEventListener('DOMContentLoaded', function() {
    // Ejercicio 1: Validación de un formulario de contacto básico
    const contactForm = document.getElementById('contactForm');
    contactForm.addEventListener('submit', function(event) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
        if (name === '') {
            alert('El campo "Nombre" no puede estar vacío.');
            event.preventDefault();
        } else if (!validateEmail(email)) {
            alert('El correo electrónico no es válido.');
            event.preventDefault();
        } else if (message.length < 10) {
            alert('El mensaje debe tener al menos 10 caracteres.');
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Ejercicio 2: Validación de contraseña y confirmación de contraseña
    const passwordForm = document.getElementById('passwordForm');
    passwordForm.addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (password.length < 8) {
            alert('La contraseña debe tener al menos 8 caracteres.');
            event.preventDefault();
        } else if (password !== confirmPassword) {
            alert('Las contraseñas no coinciden.');
            event.preventDefault();
        }
    });

    // Ejercicio 3: Formulario de registro con validación de fecha y selección de edad
    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', function(event) {
        const birthDate = new Date(document.getElementById('birthDate').value);
        const age = calculateAge(birthDate);
        
        if (age < 18) {
            alert('Debes tener al menos 18 años.');
            event.preventDefault();
        }
    });

    function calculateAge(birthDate) {
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDifference = today.getMonth() - birthDate.getMonth();
        
        if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        
        return age;
    }
});