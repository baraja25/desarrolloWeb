document.addEventListener("DOMContentLoaded", () => {
    // Selección de elementos con querySelectorAll
    const inputs = document.querySelectorAll("#myForm input");
    const errors = document.querySelectorAll(".error");
    const form = document.querySelector("#myForm");
    const infoDiv = document.querySelector("#info");
    const openWindowButton = document.querySelector("#openWindow");

    // Validación en tiempo real
    inputs.forEach((input, index) => {
        input.addEventListener("input", () => {
            const value = input.value;
            let errorMessage = "";

            if (input.id === "username" && value.length < 3) {
                errorMessage = "Debe tener al menos 3 caracteres.";
            } else if (input.id === "email" && !value.includes("@")) {
                errorMessage = "Ingrese un correo válido.";
            } else if (input.id === "password" && value.length < 6) {
                errorMessage = "Debe tener al menos 6 caracteres.";
            }

            if (errorMessage) {
                errors[index].textContent = errorMessage;
                errors[index].classList.remove("hidden");
            } else {
                errors[index].classList.add("hidden");
            }
        });
    });

    // Gestión del envío del formulario
    form.addEventListener("submit", (event) => {
        event.preventDefault(); // Prevenir la acción por defecto

        let valid = true;

        inputs.forEach((input, index) => {
            const value = input.value;
            if (
                (input.id === "username" && value.length < 3) ||
                (input.id === "email" && !value.includes("@")) ||
                (input.id === "password" && value.length < 6)
            ) {
                errors[index].classList.remove("hidden");
                valid = false;
            }
        });

        if (valid) {
            infoDiv.textContent = `Formulario enviado correctamente. URL actual: ${window.location.href}`;
            infoDiv.classList.remove("hidden");

            // Redirección después de 3 segundos
            setTimeout(() => {
                window.location.href = "https://www.google.com";
            }, 3000);
        }
    });

    // Ventana emergente
    openWindowButton.addEventListener("click", () => {
        const popup = window.open(
            "https://www.wikipedia.org",
            "VentanaEmergente",
            "width=600,height=400"
        );

        if (!popup) {
            alert("Por favor, habilite las ventanas emergentes.");
        }
    });

    // Temporizador (opcional para monitorear ancho/alto de ventana)
    setInterval(() => {
        console.log(`Ancho: ${window.innerWidth}, Alto: ${window.innerHeight}`);
    }, 5000);
});
