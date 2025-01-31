// 17
const img = document.getElementById('img');
img.setAttribute("alt", "Foto de perfil actualizada");
// 18
document.querySelector(".contact-info").addEventListener('click', (e) => {
    const contact = document.querySelector('.contact-info');
    contact.style.backgroundColor = "#e6f7ff";
})

// 19
document.querySelector("#htmlContent").addEventListener('click', (e) => {
const html = document.querySelector('h1');
html.textContent = "Curriculum Vitae Actualizado";

})

// 21
document.querySelector('#jobContent').addEventListener('click', () => {
    const first = document.getElementById('container').firstElementChild.textContent = "Gestión de proyectos avanzados en desarrollo web.";
});

// 22
document.querySelector('#innerJob').addEventListener('click', () => {
const last = document.querySelector(".educationList").lastElementChild;
    last.innerHTML = "<strong>Curso de Especialización en JavaScript</strong> - Academia Profesional (2022)";
})

// 23
document.getElementById("changeUrl").addEventListener('mouseover', () => {
    document.querySelector("#item3").setAttribute("href", "https://linkedin.com/in/actualizado")
})

// 24
document.querySelector(".cv-container").style.borderColor = "#00ff00";
document.querySelector(".cv-container").style.borderStyle = "solid";

//26
let lista = document.createElement("li");
lista.innerHTML = "<strong>Freelancer</strong> - Proyectos Independientes (2023 - Presente) <p>Desarrollo de soluciones personalizadas para clientes internacionales.</p>";
document.querySelector(".experience").appendChild(lista);

// 27
const first = document.querySelector(".experience").firstElementChild;
first.nextElementSibling.remove();
// 28
document.querySelector("h1").addEventListener("click", (e) => {
    document.querySelector("h1").style.color = "red";
});

