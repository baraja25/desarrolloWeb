// Biblioteca de manipulación DOM
const DOMUtils = {
  /**
   * Selecciona un elemento del DOM
   * @param {string} selector - Selector CSS
   * @param {Element} parent - Elemento padre (por defecto: document)
   * @returns {Element} El elemento seleccionado
   * @example DOMUtils.select('#miElemento')
   * @example DOMUtils.select('.clase', otroElemento)
   */
  select: (selector, parent = document) => parent.querySelector(selector),
  
  /**
   * Selecciona todos los elementos que coinciden con el selector
   * @param {string} selector - Selector CSS
   * @param {Element} parent - Elemento padre (por defecto: document)
   * @returns {Array} Array con los elementos seleccionados
   * @example DOMUtils.selectAll('.item')
   */
  selectAll: (selector, parent = document) => [...parent.querySelectorAll(selector)],
  
  /**
   * Establece el texto de un elemento
   * @param {Element|string} element - Elemento o selector
   * @param {string} text - Texto a establecer
   * @returns {Element} El elemento modificado
   * @example DOMUtils.setText('#titulo', 'Nuevo título')
   */
  setText: (element, text) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.textContent = text;
    return element;
  },
  
  /**
   * Establece el HTML de un elemento
   * @param {Element|string} element - Elemento o selector
   * @param {string} html - HTML a establecer
   * @returns {Element} El elemento modificado
   * @example DOMUtils.setHTML('#contenido', '<p>Nuevo párrafo</p>')
   */
  setHTML: (element, html) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.innerHTML = html;
    return element;
  },
  
  /**
   * Establece un atributo de un elemento
   * @param {Element|string} element - Elemento o selector
   * @param {string} attr - Nombre del atributo
   * @param {string} value - Valor del atributo
   * @returns {Element} El elemento modificado
   * @example DOMUtils.setAttr('#miImagen', 'src', 'nueva-imagen.jpg')
   */
  setAttr: (element, attr, value) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.setAttribute(attr, value);
    return element;
  },
  
  /**
   * Obtiene el valor de un atributo
   * @param {Element|string} element - Elemento o selector
   * @param {string} attr - Nombre del atributo
   * @returns {string} Valor del atributo
   * @example DOMUtils.getAttr('#miImagen', 'src')
   */
  getAttr: (element, attr) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    return element.getAttribute(attr);
  },
  
  /**
   * Elimina un atributo de un elemento
   * @param {Element|string} element - Elemento o selector
   * @param {string} attr - Nombre del atributo
   * @returns {Element} El elemento modificado
   * @example DOMUtils.removeAttr('#miElemento', 'disabled')
   */
  removeAttr: (element, attr) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.removeAttribute(attr);
    return element;
  },
  
  /**
   * Añade clases a un elemento
   * @param {Element|string} element - Elemento o selector
   * @param {...string} classes - Clases a añadir
   * @returns {Element} El elemento modificado
   * @example DOMUtils.addClass('#miBoton', 'activo', 'destacado')
   */
  addClass: (element, ...classes) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.classList.add(...classes);
    return element;
  },
  
  /**
   * Elimina clases de un elemento
   * @param {Element|string} element - Elemento o selector
   * @param {...string} classes - Clases a eliminar
   * @returns {Element} El elemento modificado
   * @example DOMUtils.removeClass('#miBoton', 'activo', 'destacado')
   */
  removeClass: (element, ...classes) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.classList.remove(...classes);
    return element;
  },
  
  /**
   * Activa o desactiva una clase
   * @param {Element|string} element - Elemento o selector
   * @param {string} className - Clase a alternar
   * @returns {Element} El elemento modificado
   * @example DOMUtils.toggleClass('#miBoton', 'activo')
   */
  toggleClass: (element, className) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.classList.toggle(className);
    return element;
  },
  
  /**
   * Comprueba si un elemento tiene una clase
   * @param {Element|string} element - Elemento o selector
   * @param {string} className - Clase a comprobar
   * @returns {boolean} true si tiene la clase, false si no
   * @example DOMUtils.hasClass('#miBoton', 'activo')
   */
  hasClass: (element, className) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    return element.classList.contains(className);
  },
  
  /**
   * Establece un estilo CSS
   * @param {Element|string} element - Elemento o selector
   * @param {string} property - Propiedad CSS
   * @param {string} value - Valor CSS
   * @returns {Element} El elemento modificado
   * @example DOMUtils.setStyle('#miElemento', 'color', 'red')
   */
  setStyle: (element, property, value) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.style[property] = value;
    return element;
  },
  
  /**
   * Establece múltiples estilos CSS
   * @param {Element|string} element - Elemento o selector
   * @param {Object} styles - Objeto con propiedades y valores CSS
   * @returns {Element} El elemento modificado
   * @example DOMUtils.setStyles('#miElemento', {color: 'red', fontSize: '20px'})
   */
  setStyles: (element, styles) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    Object.entries(styles).forEach(([property, value]) => {
      element.style[property] = value;
    });
    return element;
  },
  
  /**
   * Crea un nuevo elemento HTML
   * @param {string} tagName - Tipo de elemento (div, span, etc)
   * @param {Object} attributes - Atributos del elemento
   * @param {string} content - Contenido HTML
   * @returns {Element} El elemento creado
   * @example DOMUtils.create('div', {class: 'card', id: 'card1'}, '<p>Contenido</p>')
   */
  create: (tagName, attributes = {}, content = '') => {
    const element = document.createElement(tagName);
    
    // Establecer atributos
    Object.entries(attributes).forEach(([attr, value]) => {
      if (attr === 'class') {
        value.split(' ').forEach(cls => element.classList.add(cls));
      } else {
        element.setAttribute(attr, value);
      }
    });
    
    // Establecer contenido
    if (content) element.innerHTML = content;
    
    return element;
  },
  
  /**
   * Añade hijos a un elemento
   * @param {Element|string} parent - Elemento padre o selector
   * @param {...(Element|string)} children - Elementos hijo o strings
   * @returns {Element} El elemento padre
   * @example DOMUtils.append('#contenedor', nuevoElemento, 'Texto adicional')
   */
  append: (parent, ...children) => {
    if (typeof parent === 'string') parent = DOMUtils.select(parent);
    children.forEach(child => {
      if (typeof child === 'string') {
        parent.appendChild(document.createTextNode(child));
      } else {
        parent.appendChild(child);
      }
    });
    return parent;
  },
  
  /**
   * Añade hijos al inicio de un elemento
   * @param {Element|string} parent - Elemento padre o selector
   * @param {...(Element|string)} children - Elementos hijo o strings
   * @returns {Element} El elemento padre
   * @example DOMUtils.prepend('#contenedor', nuevoElemento, 'Texto al inicio')
   */
  prepend: (parent, ...children) => {
    if (typeof parent === 'string') parent = DOMUtils.select(parent);
    children.reverse().forEach(child => {
      if (typeof child === 'string') {
        parent.prepend(document.createTextNode(child));
      } else {
        parent.prepend(child);
      }
    });
    return parent;
  },
  
  /**
   * Elimina un elemento del DOM
   * @param {Element|string} element - Elemento a eliminar o selector
   * @example DOMUtils.remove('#elementoAEliminar')
   */
  remove: (element) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.parentNode.removeChild(element);
  },
  
  /**
   * Añade un listener de evento
   * @param {Element|string} element - Elemento o selector
   * @param {string} event - Nombre del evento (click, input, etc)
   * @param {Function} handler - Función manejadora
   * @param {Object} options - Opciones del evento
   * @returns {Element} El elemento
   * @example DOMUtils.on('#miBoton', 'click', () => alert('Clic!'))
   */
  on: (element, event, handler, options = {}) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.addEventListener(event, handler, options);
    return element;
  },
  
  /**
   * Elimina un listener de evento
   * @param {Element|string} element - Elemento o selector
   * @param {string} event - Nombre del evento
   * @param {Function} handler - Función manejadora a eliminar
   * @returns {Element} El elemento
   * @example DOMUtils.off('#miBoton', 'click', miManejadorAnterior)
   */
  off: (element, event, handler) => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    element.removeEventListener(event, handler);
    return element;
  },
  
  /**
   * Delega eventos a elementos hijos
   * @param {Element|string} parent - Elemento padre o selector
   * @param {string} event - Nombre del evento
   * @param {string} childSelector - Selector para elementos hijos
   * @param {Function} handler - Función manejadora
   * @returns {Element} El elemento padre
   * @example DOMUtils.delegate('#lista', 'click', 'li', e => alert('Clic en item!'))
   */
  delegate: (parent, event, childSelector, handler) => {
    if (typeof parent === 'string') parent = DOMUtils.select(parent);
    
    parent.addEventListener(event, function(e) {
      let target = e.target;
      while (target && target !== parent) {
        if (target.matches(childSelector)) {
          handler.call(target, e);
          break;
        }
        target = target.parentNode;
      }
    });
    
    return parent;
  },
  
  /**
   * Anima un elemento con CSS transitions
   * @param {Element|string} element - Elemento o selector
   * @param {Object} properties - Propiedades CSS a animar
   * @param {number} duration - Duración en ms
   * @param {string} easing - Tipo de easing (ease, linear, etc)
   * @returns {Promise} Promesa que se resuelve al terminar la animación
   * @example DOMUtils.animate('#elemento', {opacity: '1', transform: 'scale(1.2)'}, 500)
   */
  animate: (element, properties, duration = 300, easing = 'ease') => {
    if (typeof element === 'string') element = DOMUtils.select(element);
    return new Promise(resolve => {
      const originalTransition = element.style.transition;
      
      element.style.transition = `all ${duration}ms ${easing}`;
      
      setTimeout(() => {
        Object.entries(properties).forEach(([prop, value]) => {
          element.style[prop] = value;
        });
      }, 10);
      
      const onTransitionEnd = () => {
        element.style.transition = originalTransition;
        element.removeEventListener('transitionend', onTransitionEnd);
        resolve(element);
      };
      
      element.addEventListener('transitionend', onTransitionEnd);
      
      setTimeout(onTransitionEnd, duration + 50);
    });
  },
  
  /**
   * Convierte un formulario a objeto
   * @param {Element|string} form - Formulario o selector
   * @returns {Object} Datos del formulario como objeto key-value
   * @example const datos = DOMUtils.serialize('#miFormulario')
   */
  serialize: (form) => {
    if (typeof form === 'string') form = DOMUtils.select(form);
    const formData = new FormData(form);
    return Object.fromEntries(formData.entries());
  },
  
  /**
   * Valida un campo de formulario
   * @param {Element|string} field - Campo a validar o selector
   * @param {Element|string} errorSpan - Elemento para mensajes de error
   * @param {Object} errorMessages - Mensajes personalizados
   * @returns {boolean} true si es válido, false si no
   * @example DOMUtils.validateField('#email', '#error-email', {valueMissing: 'Email requerido'})
   */
  validateField: (field, errorSpan, errorMessages = {}) => {
    if (typeof field === 'string') field = DOMUtils.select(field);
    if (typeof errorSpan === 'string') errorSpan = DOMUtils.select(errorSpan);
    
    if (field.validity.valid) {
      errorSpan.textContent = "";
      field.classList.remove("error");
      field.classList.add("success");
      return true;
    } else {
      DOMUtils.showFieldError(field, errorSpan, errorMessages);
      field.classList.remove("success");
      field.classList.add("error");
      return false;
    }
  },
  
  /**
   * Muestra mensajes de error para un campo
   * @param {Element} field - Campo de formulario
   * @param {Element} errorSpan - Elemento para mostrar el error
   * @param {Object} errorMessages - Mensajes personalizados por tipo de error
   * @example DOMUtils.showFieldError(campoEmail, errorSpan, {typeMismatch: 'Email inválido'})
   */
  showFieldError: (field, errorSpan, errorMessages = {}) => {
    let message = "";
    
    if (field.validity.valueMissing) {
      message = errorMessages.valueMissing || "Este campo es obligatorio";
    } else if (field.validity.typeMismatch) {
      message = errorMessages.typeMismatch || "Por favor, introduce un valor válido";
    } else if (field.validity.tooShort) {
      message = errorMessages.tooShort || `El valor debe tener al menos ${field.minLength} caracteres`;
    } else if (field.validity.rangeUnderflow) {
      message = errorMessages.rangeUnderflow || `El valor debe ser mayor o igual a ${field.min}`;
    } else if (field.validity.rangeOverflow) {
      message = errorMessages.rangeOverflow || `El valor debe ser menor o igual a ${field.max}`;
    } else if (field.validity.patternMismatch) {
      message = errorMessages.patternMismatch || "Por favor, sigue el formato requerido";
    } else if (field.validity.customError) {
      message = field.validationMessage;
    }
    
    errorSpan.textContent = message;
  },
  
  /**
   * Valida un formulario completo
   * @param {string} formSelector - Selector del formulario
   * @param {Object} errorMessageConfig - Mensajes de error personalizados
   * @returns {boolean} true si todo es válido, false si hay errores
   * @example DOMUtils.validateForm('#miFormulario', {valueMissing: 'Campo requerido'})
   */
  validateForm: (formSelector, errorMessageConfig = {}) => {
    const form = DOMUtils.select(formSelector);
    let isValid = true;
    
    const fields = DOMUtils.selectAll('input, select, textarea', form);
    fields.forEach(field => {
      const errorSpan = DOMUtils.select(`#error-${field.id}`) || DOMUtils.select(`.error-${field.id}`);
      if (errorSpan && !DOMUtils.validateField(field, errorSpan, errorMessageConfig)) {
        isValid = false;
      }
    });
    
    return isValid;
  }
};