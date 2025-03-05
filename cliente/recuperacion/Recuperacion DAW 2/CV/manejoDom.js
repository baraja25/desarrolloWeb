const imagen = document.querySelector('img[src="Homer_Simpson_2006"]');

// imagen.addEventListener("click" , (){

// })


// cambia el color de las letras
document
  .querySelector(".habilidades")
  .addEventListener("mouseover", function () {
    document.querySelectorAll("ul").forEach(function (element) {
      element.style.color = "#ff0000";
    });
  });

  //cambia el nombre de homer
document.querySelector("h1").addEventListener("dblclick", function () {
  const nombreHomer = document.querySelector("h1");
  nombreHomer.textContent = "Homer Jay Simpson";
});


// añade clases
document
  .querySelector(".formacion ul li:nth-child(2)")
  .addEventListener("click", function () {
    document.querySelectorAll(".formacion h2, ul").forEach(function (item) {
      item.classList.add("highlighted-course");
    });
  });



const experto = document.querySelector(
  ".cv-container ul:nth-child(2) li"
);
 // cambia el contenido de texto (esta mal porque coge la lista de arriba)
experto.addEventListener("click", function () {
  experto.textContent = "Experto en Seguridad Nuclear y Prevención de Crisis";
});

// cambia el elemento html
const estudios = document.querySelector(".estudios li:nth-child(2)");
estudios.addEventListener("click", function() {
    estudios.innerHTML = "<strong>Licenciatura en Ciencias Nucleares</strong> - Universidad de Springfield (2025)";
});

//añade correo
const email = document.querySelector(".cv-container p");
email.addEventListener('mouseover', function() {
    email.setAttribute('href', "homersimpson@planta-nuclear.com");
})


//cambia el fondo
const tituloEstudios = document.querySelector('.tituloEstudio')

tituloEstudios.addEventListener('dblclick', function() {
    const container = document.querySelector('.cv-container');
    container.style.backgroundColor = "#f8f9fa";
})