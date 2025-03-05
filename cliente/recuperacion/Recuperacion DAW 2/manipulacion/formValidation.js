document.addEventListener("DOMContentLoaded", () => {
    const form = DOMUtils.select("#contactForm");
    const resetButton = document.getElementById("restablecer");


    // Validación en tiempo real
    DOMUtils.selectAll("input, textarea", form).forEach((field) => {
      DOMUtils.on(field, "input", function () {
        DOMUtils.validateField(this, `#error-${this.id}`);
      });
    });

    // Contador de caracteres para el mensaje
    const messageField = DOMUtils.select("#motivacion");
    const charsLeftSpan = DOMUtils.select("#chars-left");

    DOMUtils.on(messageField, "input", function () {
      const remaining = 200 - this.value.length;
      DOMUtils.setText(charsLeftSpan, `Caracteres restantes: ${remaining}`);

      if (this.value.length > 200) {
        this.setCustomValidity(
          "El mensaje no puede exceder los 200 caracteres"
        );
      } else {
        this.setCustomValidity("");
      }

      DOMUtils.validateField(this, "#error-message");
    });

    const genero =  DOMUtils.select('#genero');
    const errorGenero = DOMUtils.select('#error-gender');

    DOMUtils.on(genero, "option", function() {
        if (genero.value === "masculino") {
            DOMUtils.showFieldError(genero, errorGenero, {customError: {'Elige otro genero'}});
        }
    })

    // Validar al enviar
    DOMUtils.on(form, "submit", function (e) {
      e.preventDefault();

      if (DOMUtils.validateForm("#contactForm")) {
        const formData = DOMUtils.serialize(this);
        console.log("Datos del formulario:", formData);

        // Simular envío
        const loadingMessage = DOMUtils.create(
          "div",
          {
            class: "message loading",
          },
          "Enviando formulario..."
        );

        DOMUtils.prepend(form, loadingMessage);

        // Simular respuesta del servidor
        setTimeout(() => {
          DOMUtils.remove(loadingMessage);

          const successMessage = DOMUtils.create(
            "div",
            {
              class: "message success",
            },
            "¡Formulario enviado correctamente!"
          );

          DOMUtils.prepend(form, successMessage);
          form.reset();

          setTimeout(() => {
            DOMUtils.animate(
              successMessage,
              {
                opacity: "0",
              },
              500
            ).then(() => {
              DOMUtils.remove(successMessage);
            });
          }, 3000);
        }, 1500);
      }
    });
    // Restablecer formulario
    resetButton.addEventListener("click", function(event) {
        event.preventDefault();
        form.reset();
        const errorSpans = form.querySelectorAll(".error");
        errorSpans.forEach(span => span.textContent = "");
    });
  });