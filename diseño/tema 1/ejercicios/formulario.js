const input = document.getElementById("edad");
const meter = document.getElementById("controlEdad");

input.addEventListener("input", function () {
  meter.value = this.value;
});
