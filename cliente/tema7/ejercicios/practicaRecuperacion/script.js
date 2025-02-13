document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("megaformulario");
  
    // Validación en vivo para el campo "Nombre"
    document.getElementById("nombre").addEventListener("input", validateNombre);
    function validateNombre() {
      const nombre = document.getElementById("nombre").value.trim();
      const error = document.getElementById("error-nombre");
      if (nombre === "" || nombre.length < 5) {
        error.innerText = 'El campo "Nombre" debe tener al menos 5 caracteres.';
      } else {
        error.innerText = "";
      }
    }
  
    // Validación en vivo para el campo "Correo Electrónico"
    document.getElementById("email").addEventListener("input", validateEmail);
    function validateEmail() {
      const email = document.getElementById("email").value.trim();
      const error = document.getElementById("error-email");
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        error.innerText = 'El campo "Correo Electrónico" no es válido.';
      } else {
        error.innerText = "";
      }
    }
  
    // Validación en vivo para el campo "Edad"
    document.getElementById("edad").addEventListener("input", validateEdad);
    function validateEdad() {
      const edad = document.getElementById("edad").value;
      const error = document.getElementById("error-edad");
      if (edad < 18 || edad > 100) {
        error.innerText = 'El campo "Edad" debe estar entre 18 y 100.';
      } else {
        error.innerText = "";
      }
    }
  
    // Validación en vivo para el campo "Contraseña"
    document.getElementById("password").addEventListener("input", validatePassword);
    function validatePassword() {
      const password = document.getElementById("password").value;
      const error = document.getElementById("error-password");
      if (password.length < 8) {
        error.innerText = 'El campo "Contraseña" debe tener al menos 8 caracteres.';
      } else {
        error.innerText = "";
      }
    }
  
    // Validación en vivo para el campo "Confirmar Contraseña"
    document.getElementById("confirm-password").addEventListener("input", validateConfirmPassword);
    function validateConfirmPassword() {
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm-password").value;
      const error = document.getElementById("error-confirm-password");
      if (confirmPassword !== password) {
        error.innerText = 'Las contraseñas no coinciden.';
      } else {
        error.innerText = "";
      }
    }
  
    contactForm.addEventListener("submit", function (event) {
      const nombre = document.getElementById("nombre").value.trim();
      const email = document.getElementById("email").value.trim();
      const edad = document.getElementById("edad").value;
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirm-password").value;
      const genero = document.querySelector('input[name="genero"]:checked')
        ? document.querySelector('input[name="genero"]:checked').value
        : "";
      const pais = document.getElementById("pais").value;
      const comentarios = document.getElementById("comentarios").value.trim();
      const terminos = document.getElementById("terminos").checked;
  
      // Validaciones adicionales al enviar el formulario
      if (nombre === "" || nombre.length < 5) {
        const error = document.getElementById("error-nombre");
        error.innerText = 'El campo "Nombre" debe tener al menos 5 caracteres.';
        event.preventDefault();
      }
  
      if (!emailPattern.test(email)) {
        const error = document.getElementById("error-email");
        error.innerText = 'El campo "Correo Electrónico" no es válido.';
        event.preventDefault();
      }
  
      if (edad < 18 || edad > 100) {
        const error = document.getElementById("error-edad");
        error.innerText = 'El campo "Edad" debe estar entre 18 y 100.';
        event.preventDefault();
      }
  
      if (password.length < 8) {
        const error = document.getElementById("error-password");
        error.innerText = 'El campo "Contraseña" debe tener al menos 8 caracteres.';
        event.preventDefault();
      }
  
      if (confirmPassword !== password) {
        const error = document.getElementById("error-confirm-password");
        error.innerText = 'Las contraseñas no coinciden.';
        event.preventDefault();
      }
  
      if (genero === "") {
        const error = document.getElementById("error-genero");
        error.innerText = 'Debe seleccionar un género.';
        event.preventDefault();
      }
  
      if (pais === "") {
        const error = document.getElementById("error-pais");
        error.innerText = 'Debe seleccionar un país.';
        event.preventDefault();
      }
  
      if (!terminos) {
        const error = document.getElementById("error-terminos");
        error.innerText = 'Debe aceptar los términos y condiciones.';
        event.preventDefault();
      }
    });
  });