document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registrationForm");
    const resetButton = document.getElementById("restablecer");
    const countButton = document.createElement("button");
    countButton.textContent = "Contar Completados";
    form.appendChild(countButton);

    // Validaciones en tiempo real
    form.addEventListener("input", function(event) {
        validateField(event.target);
    });

    // Validación al enviar el formulario
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        let isValid = true;
        const fields = form.querySelectorAll("input, select, textarea");
        fields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
            }
        });
        if (isValid) {
            alert("Formulario enviado correctamente");
            form.reset();
        } else {
            alert("Por favor, corrige los errores en el formulario");
        }
    });

    // Restablecer formulario
    resetButton.addEventListener("click", function(event) {
        event.preventDefault();
        form.reset();
        const errorSpans = form.querySelectorAll(".error");
        errorSpans.forEach(span => span.textContent = "");
    });

    // Contar campos completados
    countButton.addEventListener("click", function(event) {
        event.preventDefault();
        let completedCount = 0;
        const fields = form.querySelectorAll("input, select, textarea");
        fields.forEach(field => {
            if (field.value.trim() !== "") {
                completedCount++;
            }
        });
        alert(`Campos completados correctamente: ${completedCount}`);
    });

    // Validar campo específico
    function validateField(field) {
        const errorSpan = document.getElementById(`error-${field.id}`);
        if (field.validity.valid) {
            errorSpan.textContent = "";
            field.classList.remove("error");
            field.classList.add("success");
            return true;
        } else {
            showError(field, errorSpan);
            field.classList.remove("success");
            field.classList.add("error");
            return false;
        }
    }

    // Mostrar mensaje de error
    function showError(field, errorSpan) {
        if (field.validity.valueMissing) {
            errorSpan.textContent = "Este campo es obligatorio";
        } else if (field.validity.typeMismatch) {
            errorSpan.textContent = "Por favor, introduce un valor válido";
        } else if (field.validity.tooShort) {
            errorSpan.textContent = `El valor debe tener al menos ${field.minLength} caracteres`;
        } else if (field.validity.rangeUnderflow) {
            errorSpan.textContent = `El valor debe ser mayor o igual a ${field.min}`;
        } else if (field.validity.rangeOverflow) {
            errorSpan.textContent = `El valor debe ser menor o igual a ${field.max}`;
        } else if (field.validity.patternMismatch) {
            if (field.id === "password") {
                errorSpan.textContent = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una minúscula y un número";
            } else if (field.id === "tel") {
                errorSpan.textContent = "El teléfono debe contener solo números y tener una longitud de 10 dígitos";
            } else if (field.id === "url") {
                errorSpan.textContent = "El sitio web debe ser un URL válido y empezar con http:// o https://";
            } else {
                errorSpan.textContent = "Por favor, sigue el formato requerido";
            }
        } else if (field.validity.customError) {
            errorSpan.textContent = field.validationMessage;
        }
    }

    // Validación personalizada para confirmar contraseña
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");

    confirmPassword.addEventListener("input", function() {
        if (confirmPassword.value !== password.value) {
            confirmPassword.setCustomValidity("Las contraseñas no coinciden");
        } else {
            confirmPassword.setCustomValidity("");
        }
        validateField(confirmPassword);
    });

    // Mostrar caracteres restantes en tiempo real para comentarios
    const comentarios = document.getElementById("textarea");
    const comentariosError = document.getElementById("error-textarea");
    const caracteresRestantes = document.createElement("span");
    caracteresRestantes.id = "caracteres-restantes";
    comentarios.parentNode.appendChild(caracteresRestantes);

    comentarios.addEventListener("input", function() {
        const remaining = 200 - comentarios.value.length;
        caracteresRestantes.textContent = `Caracteres restantes: ${remaining}`;
        if (comentarios.value.length > 200) {
            comentarios.setCustomValidity("No puede exceder los 200 caracteres");
        } else {
            comentarios.setCustomValidity("");
        }
        validateField(comentarios);
    });
});