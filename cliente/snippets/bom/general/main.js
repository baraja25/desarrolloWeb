// Objeto con métodos para obtener información del navegador
const BrowserInfo = {
    // Devuelve información completa del navegador
    getFullInfo() {
      return {
        screenResolution: `${window.screen.width} x ${window.screen.height}`,
        windowSize: `${window.innerWidth} x ${window.innerHeight}`,
        currentURL: window.location.href,
        userAgent: window.navigator.userAgent,
        language: window.navigator.language,
        platform: window.navigator.platform,
        cookiesEnabled: window.navigator.cookieEnabled,
        onlineSatus: window.navigator.onLine
      };
    },
    
    // Comprueba si el dispositivo es móvil
    isMobileDevice() {
      return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    },
    
    // Comprueba si el navegador es Internet Explorer
    isIE() {
      return /MSIE|Trident/.test(navigator.userAgent);
    }
  };
  
  // Ejemplo de uso:
  console.log(BrowserInfo.getFullInfo());
  if (BrowserInfo.isMobileDevice()) {
    console.log("Estás usando un dispositivo móvil");
  }

  // Objeto para manejar ventanas
const WindowManager = {
    // Abre una nueva ventana y devuelve la referencia
    openWindow(url, name, features) {
      return window.open(url, name || '_blank', features || 'width=600,height=400');
    },
    
    // Cierra la ventana actual
    closeCurrentWindow() {
      window.close();
    },
    
    // Redimensiona la ventana actual
    resizeTo(width, height) {
      window.resizeTo(width, height);
    },
    
    // Mueve la ventana a una posición específica
    moveTo(x, y) {
      window.moveTo(x, y);
    },
    
    // Centra la ventana en la pantalla
    centerWindow(width, height) {
      const left = (screen.width - width) / 2;
      const top = (screen.height - height) / 2;
      window.resizeTo(width, height);
      window.moveTo(left, top);
    }
  };
  
  // Ejemplo de uso:
  const popupWindow = WindowManager.openWindow('popup.html', 'popup', 'width=400,height=300');
  // Para centrar la ventana emergente:
  if (popupWindow) {
    WindowManager.centerWindow.call(popupWindow, 400, 300);
  }

  // Objeto para manejar temporizadores de forma avanzada
const TimerManager = {
    timers: {},
    
    // Crea un temporizador que se ejecuta después de un retraso
    setTimeout(callback, delay, id) {
      const timerId = id || `timer_${Date.now()}`;
      this.timers[timerId] = window.setTimeout(callback, delay);
      return timerId;
    },
    
    // Crea un temporizador que se ejecuta repetidamente
    setInterval(callback, interval, id) {
      const timerId = id || `interval_${Date.now()}`;
      this.timers[timerId] = window.setInterval(callback, interval);
      return timerId;
    },
    
    // Cancela un temporizador por su ID
    clear(id) {
      if (this.timers[id]) {
        if (id.startsWith('interval_')) {
          clearInterval(this.timers[id]);
        } else {
          clearTimeout(this.timers[id]);
        }
        delete this.timers[id];
        return true;
      }
      return false;
    },
    
    // Cancela todos los temporizadores
    clearAll() {
      Object.keys(this.timers).forEach(id => this.clear(id));
    }
  };
  
  // Ejemplo de uso:
  // Crear un contador que se incrementa cada segundo
  let count = 0;
  const counterId = TimerManager.setInterval(() => {
    count++;
    console.log(`Contador: ${count}`);
    if (count >= 10) {
      TimerManager.clear(counterId);
      console.log("Contador detenido");
    }
  }, 1000);
  
  // Cancelar todos los temporizadores cuando la ventana se cierra
  window.addEventListener('beforeunload', () => {
    TimerManager.clearAll();
  });

  // Objeto para manejar la comunicación entre ventanas
const WindowCommunicator = {
    // Almacena referencias a ventanas abiertas
    windows: {},
    
    // Abre una ventana y guarda su referencia
    openWindow(url, name, features) {
      const win = window.open(url, name || '_blank', features || 'width=600,height=400');
      if (win) {
        this.windows[name || url] = win;
      }
      return win;
    },
    
    // Envía un mensaje a una ventana específica
    sendMessage(windowKey, message, targetOrigin = '*') {
      if (this.windows[windowKey] && !this.windows[windowKey].closed) {
        this.windows[windowKey].postMessage(message, targetOrigin);
        return true;
      } else if (windowKey === 'opener' && window.opener) {
        window.opener.postMessage(message, targetOrigin);
        return true;
      }
      return false;
    },
    
    // Configura un receptor de mensajes
    setupReceiver(callback) {
      window.addEventListener('message', event => {
        callback(event.data, event.source, event.origin);
      });
    }
  };
  
  // Ejemplo de uso:
  // En la ventana principal:
  const chatWindow = WindowCommunicator.openWindow('chat.html', 'chat', 'width=400,height=500');
  WindowCommunicator.setupReceiver((message, source) => {
    console.log(`Mensaje recibido: ${message}`);
    // Responder al mensaje
    source.postMessage('Mensaje recibido', '*');
  });
  
  // Para enviar un mensaje:
  document.getElementById('sendButton').addEventListener('click', () => {
    const message = document.getElementById('messageInput').value;
    WindowCommunicator.sendMessage('chat', message);
  });
  
  // En la ventana secundaria:
  WindowCommunicator.setupReceiver((message) => {
    console.log(`Mensaje de la ventana principal: ${message}`);
  });
  
  // Para responder a la ventana principal:
  document.getElementById('replyButton').addEventListener('click', () => {
    const reply = document.getElementById('replyInput').value;
    WindowCommunicator.sendMessage('opener', reply);
  });

  // Objeto para manejar la navegación y el historial del navegador
const NavigationManager = {
    // Navega a una URL específica
    navigateTo(url) {
      window.location.href = url;
    },
    
    // Recarga la página actual
    reload(forceReload = false) {
      window.location.reload(forceReload);
    },
    
    // Navega atrás en el historial
    goBack() {
      window.history.back();
    },
    
    // Navega adelante en el historial
    goForward() {
      window.history.forward();
    },
    
    // Navega un número específico de páginas en el historial
    go(steps) {
      window.history.go(steps);
    },
    
    // Agrega una entrada al historial sin recargar la página (para SPAs)
    pushState(state, title, url) {
      window.history.pushState(state, title, url);
    },
    
    // Reemplaza la entrada actual en el historial
    replaceState(state, title, url) {
      window.history.replaceState(state, title, url);
    },
    
    // Configura un controlador para cambios en el historial
    onPopState(callback) {
      window.addEventListener('popstate', event => {
        callback(event.state);
      });
    }
  };
  
  // Ejemplo de uso:
  document.getElementById('backButton').addEventListener('click', () => {
    NavigationManager.goBack();
  });
  
  // Para una SPA (Single Page Application):
  function loadContent(page) {
    fetch(`/api/content/${page}`)
      .then(response => response.json())
      .then(data => {
        document.getElementById('content').innerHTML = data.html;
        NavigationManager.pushState({ page }, `Page: ${page}`, `/pages/${page}`);
      });
  }
  
  NavigationManager.onPopState(state => {
    if (state && state.page) {
      loadContent(state.page);
    }
  });

  // Objeto para manejar cookies y almacenamiento
const StorageManager = {
    // COOKIES
    setCookie(name, value, days = 7, path = '/') {
      const expires = new Date();
      expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
      document.cookie = `${name}=${encodeURIComponent(value)};expires=${expires.toUTCString()};path=${path}`;
    },
    
    getCookie(name) {
      const cookies = document.cookie.split(';');
      for (let cookie of cookies) {
        const [cookieName, cookieValue] = cookie.trim().split('=');
        if (cookieName === name) {
          return decodeURIComponent(cookieValue);
        }
      }
      return null;
    },
    
    deleteCookie(name, path = '/') {
      this.setCookie(name, '', -1, path);
    },
    
    // LOCAL STORAGE
    setLocalItem(key, value) {
      try {
        localStorage.setItem(key, JSON.stringify(value));
        return true;
      } catch (e) {
        console.error('Error al guardar en localStorage:', e);
        return false;
      }
    },
    
    getLocalItem(key) {
      try {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
      } catch (e) {
        console.error('Error al leer de localStorage:', e);
        return null;
      }
    },
    
    removeLocalItem(key) {
      localStorage.removeItem(key);
    },
    
    // SESSION STORAGE
    setSessionItem(key, value) {
      try {
        sessionStorage.setItem(key, JSON.stringify(value));
        return true;
      } catch (e) {
        console.error('Error al guardar en sessionStorage:', e);
        return false;
      }
    },
    
    getSessionItem(key) {
      try {
        const item = sessionStorage.getItem(key);
        return item ? JSON.parse(item) : null;
      } catch (e) {
        console.error('Error al leer de sessionStorage:', e);
        return null;
      }
    },
    
    removeSessionItem(key) {
      sessionStorage.removeItem(key);
    }
  };
  
  // Ejemplo de uso:
  // Guardar preferencias de usuario
  const userPreferences = {
    theme: 'dark',
    fontSize: 16,
    notifications: true
  };
  
  // Guardar en localStorage (persiste entre sesiones)
  StorageManager.setLocalItem('userPreferences', userPreferences);
  
  // Recuperar preferencias
  const savedPreferences = StorageManager.getLocalItem('userPreferences');
  if (savedPreferences) {
    console.log(`Tema seleccionado: ${savedPreferences.theme}`);
    document.body.classList.add(savedPreferences.theme);
  }
  
  // Para datos temporales de sesión
  StorageManager.setSessionItem('currentSearch', 'javascript snippets');
  
  // Para cookies (útil para autenticación, etc.)
  StorageManager.setCookie('lastVisit', new Date().toISOString());

  // Objeto para detectar características del navegador y estados de la conexión
const FeatureDetector = {
    // Comprueba si una característica está soportada
    supports(feature) {
      switch (feature.toLowerCase()) {
        case 'geolocation':
          return 'geolocation' in navigator;
        case 'notifications':
          return 'Notification' in window;
        case 'localstorage':
          return 'localStorage' in window;
        case 'sessionstorage':
          return 'sessionStorage' in window;
        case 'websockets':
          return 'WebSocket' in window;
        case 'serviceworkers':
          return 'serviceWorker' in navigator;
        default:
          return false;
      }
    },
    
    // Comprueba si el dispositivo está conectado a Internet
    isOnline() {
      return navigator.onLine;
    },
    
    // Configura listeners para cambios en la conexión
    onConnectionChange(onlineCallback, offlineCallback) {
      window.addEventListener('online', () => {
        onlineCallback();
      });
      window.addEventListener('offline', () => {
        offlineCallback();
      });
    },
    
    // Solicita geolocalización
    getGeolocation(successCallback, errorCallback) {
      if (this.supports('geolocation')) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        return true;
      }
      return false;
    },
    
    // Solicita permiso para notificaciones
    requestNotificationPermission() {
      if (this.supports('notifications')) {
        return Notification.requestPermission();
      }
      return Promise.reject('Notifications not supported');
    }
  };
  
  // Ejemplo de uso:
  // Comprobar si el navegador soporta geolocalización
  if (FeatureDetector.supports('geolocation')) {
    document.getElementById('locationButton').style.display = 'block';
    
    document.getElementById('locationButton').addEventListener('click', () => {
      FeatureDetector.getGeolocation(
        position => {
          const { latitude, longitude } = position.coords;
          console.log(`Tu ubicación es: ${latitude}, ${longitude}`);
          // Mostrar mapa o información basada en la ubicación
        },
        error => {
          console.error('Error al obtener la ubicación:', error.message);
        }
      );
    });
  } else {
    console.log('Tu navegador no soporta geolocalización');
  }
  
  // Monitorizar el estado de la conexión
  FeatureDetector.onConnectionChange(
    () => {
      console.log('Conexión restablecida');
      document.getElementById('offlineMessage').style.display = 'none';
    },
    () => {
      console.log('Conexión perdida');
      document.getElementById('offlineMessage').style.display = 'block';
    }
  );
  
  // Solicitar permiso para notificaciones
  document.getElementById('notifyButton').addEventListener('click', () => {
    FeatureDetector.requestNotificationPermission()
      .then(permission => {
        if (permission === 'granted') {
          new Notification('¡Notificaciones activadas!', {
            body: 'Ahora recibirás notificaciones importantes'
          });
        }
      });
  });

  // Objeto con utilidades para manejar tamaños y posiciones en la ventana
const ViewportUtils = {
    // Comprueba si un elemento está visible en el viewport
    isElementInViewport(el) {
      const rect = el.getBoundingClientRect();
      return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      );
    },
    
    // Hace scroll suave a un elemento
    scrollToElement(el, offset = 0) {
      const rect = el.getBoundingClientRect();
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const targetY = rect.top + scrollTop - offset;
      
      window.scrollTo({
        top: targetY,
        behavior: 'smooth'
      });
    },
    
    // Obtiene la posición actual del scroll
    getScrollPosition() {
      return {
        x: window.pageXOffset || document.documentElement.scrollLeft,
        y: window.pageYOffset || document.documentElement.scrollTop
      };
    },
    
    // Configura un observador para elementos que entran/salen del viewport
    observeElements(elements, onEnterViewport, onExitViewport) {
      if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              onEnterViewport(entry.target);
            } else {
              onExitViewport(entry.target);
            }
          });
        });
        
        elements.forEach(el => observer.observe(el));
        return observer;
      } else {
        // Fallback para navegadores antiguos
        window.addEventListener('scroll', () => {
          elements.forEach(el => {
            if (this.isElementInViewport(el)) {
              onEnterViewport(el);
            } else {
              onExitViewport(el);
            }
          });
        });
        return null;
      }
    }
  };
  
  // Ejemplo de uso:
  // Animación al hacer scroll
  const sections = document.querySelectorAll('.animate-on-scroll');
  
  ViewportUtils.observeElements(
    sections,
    element => {
      // Cuando el elemento entra en el viewport
      element.classList.add('visible');
    },
    element => {
      // Cuando el elemento sale del viewport
      element.classList.remove('visible');
    }
  );
  
  // Botón "Volver arriba"
  document.getElementById('backToTop').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
  
  // Mostrar/ocultar el botón basado en la posición del scroll
  window.addEventListener('scroll', () => {
    const scrollPos = ViewportUtils.getScrollPosition();
    const backToTopBtn = document.getElementById('backToTop');
    
    if (scrollPos.y > 300) {
      backToTopBtn.style.display = 'block';
    } else {
      backToTopBtn.style.display = 'none';
    }
  });