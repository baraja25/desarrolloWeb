// Datos iniciales
const categories = {
    inicio: ["Perros", "Gatos", "Pájaros", "Roedores", "Reptiles"],
    perros: ["Labrador", "Bulldog", "Golden Retriever", "Beagle"],
    gatos: ["Siameses", "Persas", "Maine Coon", "Bengalí"],
    pájaros: ["Canarios", "Periquitos", "Loros"],
    roedores: ["Hámsters", "Cobayas", "Ratones"],
    reptiles: ["Iguanas", "Tortugas", "Camaleones"]
  };
  
  // Función para cargar el menú principal
  function loadMenu(menuName = "inicio") {
    const menu = document.getElementById("menu");
    menu.innerHTML = ""; // Limpiamos el menú actual
    const options = categories[menuName];
    options.forEach((option) => {
      const link = document.createElement("a");
      link.textContent = option;
      link.href = "#";
      link.addEventListener("click", () => {
        loadMenu(option.toLowerCase());
        loadLeftPanel(option.toLowerCase());
        if (categories[option.toLowerCase()]) {
          loadRandomPets(option.toLowerCase());
        }
      });
      menu.appendChild(link);
    });
  }
  
  // Función para cargar el panel izquierdo
  function loadLeftPanel(menuName = "inicio") {
    const leftPanel = document.getElementById("left-panel");
    leftPanel.innerHTML = "<h3>Categorías</h3>";
    const options = categories[menuName];
    const list = document.createElement("ul");
    options.forEach((option) => {
      const listItem = document.createElement("li");
      listItem.textContent = option;
      list.appendChild(listItem);
    });
    leftPanel.appendChild(list);
  }
  
  // Función para mostrar mascotas aleatorias en el panel central
  function loadRandomPets(menuName = "inicio") {
    const centralPanel = document.getElementById("central-panel");
    centralPanel.innerHTML = "<h3>Mascotas Destacadas</h3>";
    const pets = categories[menuName];
    if (!pets) return;
  
    // Seleccionamos 3 mascotas aleatorias
    const randomPets = pets
      .sort(() => Math.random() - 0.5)
      .slice(0, 3);
  
    randomPets.forEach((pet) => {
      const petDiv = document.createElement("div");
      petDiv.style.marginBottom = "10px";
      petDiv.innerHTML = `<strong>${pet}</strong><p>Información sobre ${pet}.</p>`;
      centralPanel.appendChild(petDiv);
    });
  }
  
  // Inicializar la página
  window.addEventListener("DOMContentLoaded", () => {
    loadMenu();
    loadLeftPanel();
    loadRandomPets();
  });
  