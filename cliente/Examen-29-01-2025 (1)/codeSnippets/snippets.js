function showRemainingCharacters(textarea, maxLength) {
    const caracteresRestantes = document.createElement("span");
    caracteresRestantes.id = "caracteres-restantes";
    textarea.parentNode.appendChild(caracteresRestantes);

    textarea.addEventListener("input", function() {
        const remaining = maxLength - textarea.value.length;
        caracteresRestantes.textContent = `Caracteres restantes: ${remaining}`;
        if (textarea.value.length > maxLength) {
            textarea.setCustomValidity(`No puede exceder los ${maxLength} caracteres`);
        } else {
            textarea.setCustomValidity("");
        }
        validateField(textarea);
    });
}


function validateConfirmPassword(passwordField, confirmPasswordField) {
    confirmPasswordField.addEventListener("input", function() {
        if (confirmPasswordField.value !== passwordField.value) {
            confirmPasswordField.setCustomValidity("Las contraseñas no coinciden");
        } else {
            confirmPasswordField.setCustomValidity("");
        }
        validateField(confirmPasswordField);
    });
}

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
        errorSpan.textContent = "Por favor, sigue el formato requerido";
    } else if (field.validity.customError) {
        errorSpan.textContent = field.validationMessage;
    }
}

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

// ejemplo de uso de las funciones
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registrationForm");

    form.addEventListener("input", function(event) {
        validateField(event.target);
    });

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        let isValid = true;
        const fields = form.querySelectorAll("input, textarea");
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

    validateConfirmPassword(
        document.getElementById("password"),
        document.getElementById("confirm-password")
    );

    showRemainingCharacters(document.getElementById("comments"),200);
});