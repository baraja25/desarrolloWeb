document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("#registrationForm");
    const inputs = document.querySelectorAll("#registrationForm input, #registrationForm select");
    const errors = document.querySelectorAll(".error");

    // Validación en tiempo real
    inputs.forEach((input, index) => {
        input.addEventListener("input", () => {
            let valid = true;
            if (input.id === "textInput" && input.value.length < 3) valid = false;
            if (input.id === "emailInput" && !input.value.includes("@")) valid = false;
            if (input.id === "passwordInput" && input.value.length < 8) valid = false;
            if (input.id === "ageInput" && input.value <= 17 || input.value >= 101) valid = false;
            // las validaciones se rompen a partir de esta linea
            // if (input.id === "date" && input.value.includes("test")) valid = false;
            // if (input.id === "tel" && input.value.length <= 10 ) valid = false;
            // if (input.id === "url" && !input.value.includes("http://") || !input.value.includes("https://")) valid = false;
            // if (input.name === "interests" && !input.checked) valid = false;
            // if (input.id === "select" && input.value === "") valid = false;

            // Mostrar u ocultar el mensaje de error
            errors[index].classList.toggle("hidden", valid);
        });
    });

    // Validación del formulario
    form.addEventListener("submit", (e) => {

        let allValid = true;

        // Validar todos los campos antes de enviar
        inputs.forEach((input, index) => {
            if (errors[index].classList.contains("hidden") === false) {
                allValid = false; // Si hay algún error, no se envía
            }
        });

        if (allValid) {
            alert("Formulario enviado correctamente.");
        } else {
            e.preventDefault(); // Prevenir el envío del formulario
            alert("Por favor, corrija los errores antes de enviar.");
        }
    });
});