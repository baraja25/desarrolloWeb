document.addEventListener("DOMContentLoaded", function() {
  const menu = document.getElementById('menu');
  const leftPanel = document.getElementById('left-panel');
  const centralPanel = document.getElementById('central-panel');

  const categorias = ['Perros', 'Gatos', 'Pájaros', 'Roedores', 'Reptiles'];
  const razas = {
    'Perros': ['Labrador', 'Bulldog', 'Poodle'],
    'Gatos': ['Siames', 'Persa', 'Bengalí'],
    'Pájaros': ['Canario', 'Periquito', 'Loro'],
    'Roedores': ['Hámster', 'Cobaya', 'Rata'],
    'Reptiles': ['Iguana', 'Tortuga', 'Serpiente']
  };

  // Cargar menú inicial
  function cargarMenu() {
    menu.innerHTML = '';
    categorias.forEach(categoria => {
      const a = document.createElement('a');
      a.href = '#';
      a.textContent = categoria;
      a.onclick = (e) => {
        e.preventDefault();
        cargarRazas(categoria);
      };
      menu.appendChild(a);
    });
  }

  // Cargar razas según la categoría seleccionada
  function cargarRazas(categoria) {
    leftPanel.innerHTML = '';
    const razasCategoria = razas[categoria];
    razasCategoria.forEach(raza => {
      const a = document.createElement('a');
      a.href = '#';
      a.textContent = raza;
      a.onclick = (e) => {
        e.preventDefault();
        mostrarMascotas(raza);
      };
      leftPanel.appendChild(a);
    });
    const volverInicio = document.createElement('a');
    volverInicio.href = '#';
    volverInicio.textContent = 'Volver a Inicio';
    volverInicio.onclick = (e) => {
      e.preventDefault();
      cargarMenu();
      leftPanel.innerHTML = ''; // Limpiar el panel izquierdo
      mostrarMascotasAleatorias(); // Mostrar mascotas aleatorias
    };
    leftPanel.appendChild(volverInicio);
  }

  // Mostrar mascotas aleatorias
  function mostrarMascotas(raza) {
    centralPanel.innerHTML = `<h2>Mostrando mascotas de la raza: ${raza}</h2>`;
    const mascotas = obtenerMascotasPorRaza(raza);
    mascotas.forEach(mascota => {
      const div = document.createElement('div');
      div.className = 'mascota';
      div.innerHTML = `
                <h5>${mascota.nombre}</h5>
                <p>Raza: ${mascota.raza}</p>
            `;
      centralPanel.appendChild(div);
    });
  }

  // Función para obtener mascotas por raza
  function obtenerMascotasPorRaza(raza) {
    const todasLasMascotas = [
      { nombre: 'Rex', raza: 'Labrador' },
      { nombre: 'Max', raza: 'Bulldog' },
      { nombre: 'Bella', raza: 'Poodle' },
      { nombre: 'Miau', raza: 'Siames' },
      { nombre: 'Luna', raza: 'Persa' },
      { nombre: 'Gato', raza: 'Bengalí' },
      { nombre: 'Tweety', raza: 'Canario' },
      { nombre: 'Peri', raza: 'Periquito' },
      { nombre: 'Loro', raza: 'Loro' },
      { nombre: 'Nibbles', raza: 'Hámster' },
      { nombre: 'Coby', raza: 'Cobaya' },
      { nombre: 'Rata', raza: 'Rata' },
      { nombre: 'Iggy', raza: 'Iguana' },
      { nombre: 'Tortuga', raza: 'Tortuga' },
      { nombre: 'Serpiente', raza: 'Serpiente' }
    ];

    return todasLasMascotas.filter(mascota => mascota.raza === raza);
  }

  // Mostrar mascotas aleatorias al cargar la página
  function mostrarMascotasAleatorias() {
    centralPanel.innerHTML = '<h2>Mostrando mascotas aleatorias</h2>';
    const mascotasAleatorias = obtenerMascotasAleatorias(3);
    mascotasAleatorias.forEach(mascota => {
      const div = document.createElement('div');
      div.className = 'mascota ';
      div.innerHTML = `
                <h5>${mascota.nombre}</h5>
                <p>Raza: ${mascota.raza}</p>
            `;
      centralPanel.appendChild(div);
    });
  }

  // Función para obtener mascotas aleatorias
  function obtenerMascotasAleatorias(cantidad) {
    const todasLasMascotas = [
      { nombre: 'Rex', raza: 'Labrador' },
      { nombre: 'Max', raza: 'Bulldog' },
      { nombre: 'Bella', raza: 'Poodle' },
      { nombre: 'Miau', raza: 'Siames' },
      { nombre: 'Luna', raza: 'Persa' },
      { nombre: 'Gato', raza: 'Bengalí' },
      { nombre: 'Tweety', raza: 'Canario' },
      { nombre: 'Peri', raza: 'Periquito' },
      { nombre: 'Loro', raza: 'Loro' },
      { nombre: 'Nibbles', raza: 'Hámster' },
      { nombre: 'Coby', raza: 'Cobaya' },
      { nombre: 'Rata', raza: 'Rata' },
      { nombre: 'Iggy', raza: 'Iguana' },
      { nombre: 'Tortuga', raza: 'Tortuga' },
      { nombre: 'Serpiente', raza: 'Serpiente' }
    ];

    const seleccionadas = [];
    while (seleccionadas.length < cantidad) {
      const indiceAleatorio = Math.floor(Math.random() * todasLasMascotas.length);
      const mascotaAleatoria = todasLasMascotas[indiceAleatorio];
      if (!seleccionadas.includes(mascotaAleatoria)) {
        seleccionadas.push(mascotaAleatoria);
      }
    }
    return seleccionadas;
  }

  // Inicializar la aplicación
  cargarMenu();
  mostrarMascotasAleatorias();
});