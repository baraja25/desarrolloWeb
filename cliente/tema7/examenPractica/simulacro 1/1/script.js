document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#formulario');
    const inputs = form.querySelectorAll('input:not([type="submit"])');
    const errors = form.querySelectorAll('.error');

    //validacion
    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            let valid = true;
            if (input.id === "nombre" && input.value.length < 3) valid = false;
            if (input.id === "correo" && !input.value.includes("@")) valid = false;
            if (input.id === "password" && input.value.length < 6) valid = false;

            //Mostrar u ocultar error
            errors[index].classList.toggle("hidden", valid);
        });
    });

    //Validacion del formulario
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let allValid = true;
        console.log(`ha entrado en el submit y el valor de allValid es: ${allValid}`);
        //Validar todos los campos
        inputs.forEach((input, index) => {
            console.log(`Comprobando error de ${input.id}:`, errors[index].classList.contains("hidden"));
            if (errors[index].classList.contains("hidden") === false) {
                allValid = false; // Si hay algún error, no se envía
                console.log(`ha entrado en el array y el valor de allValid es: ${allValid}`);
            }
        });
        if (!allValid) {
            console.log(`ha entrado en el alert de errores y el valor de allValid es: ${allValid}`);
            alert("Corrige los errores")
        } else {
            console.log(`ha entrado en el alert correcto y el valor de allValid es: ${allValid}`);
            alert("Formulario enviado correctamente");
        }
    });
});