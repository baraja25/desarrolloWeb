const inputs = document.getElementsByTagName("input");
//const inputs = document.querySelectorAll("input");

for (let i = 0; i < inputs.length; i++) {
    const input = inputs[i];
    
    input.addEventListener("input", function () {
        if (!input.checkValidity()) {
            input.classList.add("invalid");
            input.classList.remove("valid");
        } else {
            input.classList.remove("invalid");
            input.classList.add("valid");
        }
    })
}


/*
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
*/