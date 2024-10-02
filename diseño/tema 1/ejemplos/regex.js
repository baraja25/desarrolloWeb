//const input = document.getElementsByTagName("input");
const inputs = document.querySelectorAll("input");

inputs.forEach(input => {
    input.addEventListener("input", () => {
        if (!input.checkValidity()) {
            input.classList.add("invalid");
            input.classList.remove("valid");
        } else {
            input.classList.remove("invalid");
            input.classList.add("valid");
        }
    });
});