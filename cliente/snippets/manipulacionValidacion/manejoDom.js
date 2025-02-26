// 17. Selección por ID: Cambiar el atributo alt de la imagen de perfil
document.querySelector('img[src="homer_simpson_by_graysonwillis_d5mrjik-414w-2x.jpg"]').alt = "Foto de perfil actualizada";

// 18. Selección por Clase: Cambiar el color de fondo de los elementos con la clase contact-info al hacer click en el H2 de información de contacto
document.querySelector('.contact h2').addEventListener('click', function() {
    document.querySelectorAll('.contact-info').forEach(function(element) {
        element.style.backgroundColor = '#e6f7ff';
    });
});

// 19. Selección con querySelector: Cambiar el texto del encabezado principal al hacer mouseover y mouseout en el span HTML
const headerH1 = document.querySelector('.header h1');
const originalText = headerH1.textContent;
document.querySelector('.skills span:nth-child(1)').addEventListener('mouseover', function() {
    headerH1.textContent = "Curriculum Vitae Actualizado";
});
document.querySelector('.skills span:nth-child(1)').addEventListener('mouseout', function() {
    headerH1.textContent = originalText;
});

// 20. Selección con querySelectorAll: Agregar la clase highlighted-skill a cada span en la sección de habilidades al hacer doble-click en el span Figma
document.querySelector('.skills span:nth-child(7)').addEventListener('dblclick', function() {
    document.querySelectorAll('.skills span').forEach(function(span) {
        span.classList.add('highlighted-skill');
    });
});

// 21. Cambio de Contenido con textContent: Cambiar la descripción del primer elemento de la lista en experiencia laboral al hacer click en el span CSS
document.querySelector('.skills span:nth-child(2)').addEventListener('click', function() {
    document.querySelector('.experience ul li p').textContent = "Gestión de proyectos avanzados en desarrollo web.";
});

// 22. Cambio de Contenido con innerHTML: Reemplazar el contenido del último elemento de la lista en educación al hacer click en el span JavaScript
document.querySelector('.skills span:nth-child(3)').addEventListener('click', function() {
    const educationItems = document.querySelectorAll('.education ul li');
    educationItems[educationItems.length - 1].innerHTML = "<strong>Curso de Especialización en JavaScript</strong> - Academia Profesional (2022)";
});

// 23. Cambio de Atributos con setAttribute: Cambiar la URL del enlace de LinkedIn al hacer mouseover en el span React
document.querySelector('.skills span:nth-child(4)').addEventListener('mouseover', function() {
    document.querySelector('.contact-info a[href*="linkedin"]').setAttribute('href', 'https://linkedin.com/in/actualizado');
});

// 24. Cambio de Estilos con style: Cambiar el color de borde del contenedor principal
document.querySelector('.cv-container').style.borderColor = '#00ff00';

// 25. Manipulación de Clases con classList: Agregar y luego eliminar la clase section-highlight al encabezado de la sección de habilidades
const skillsHeader = document.querySelector('.skills h2');
skillsHeader.classList.add('section-highlight');
setTimeout(function() {
    skillsHeader.classList.remove('section-highlight');
}, 3000);

// 26. Agregar Elemento con appendChild: Crear un nuevo elemento li en la sección de experiencia laboral
const newExperience = document.createElement('li');
newExperience.innerHTML = "<strong>Freelancer</strong> - Proyectos Independientes (2023 - Presente)<p>Desarrollo de soluciones personalizadas para clientes internacionales.</p>";
document.querySelector('.experience ul').appendChild(newExperience);

// 27. Eliminar Elemento con removeChild: Eliminar el primer elemento de la lista en experiencia laboral
const firstExperience = document.querySelector('.experience ul li');
firstExperience.parentNode.removeChild(firstExperience);

// 28. Asociar Evento de Clic: Cambiar el color de texto del encabezado principal al hacer clic
document.querySelector('.header h1').addEventListener('click', function() {
    this.style.color = 'red';
});

// 29. Prevenir la Acción por Defecto de un Enlace: Prevenir la apertura del enlace de GitHub y mostrar un mensaje en la consola
document.querySelector('.contact-info a[href*="github"]').addEventListener('click', function(event) {
    event.preventDefault();
    console.log('Enlace de GitHub clicado, acción predeterminada prevenida.');
});

// 30. Detener la Propagación de Evento: Registrar un mensaje en la consola al hacer clic en un div dentro de contact-info y detener la propagación
document.querySelectorAll('.contact-info div').forEach(function(div) {
    div.addEventListener('click', function(event) {
        console.log('Div clicado:', this.textContent);
        event.stopPropagation();
    });
});

// 31. Delegación de Eventos: Detectar clics en enlaces dentro de contact-info y mostrar un mensaje con el texto del enlace clicado
document.querySelector('.contact-info').addEventListener('click', function(event) {
    if (event.target.tagName === 'A') {
        console.log('Enlace clicado:', event.target.textContent);
    }
});