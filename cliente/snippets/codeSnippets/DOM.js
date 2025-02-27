// Biblioteca de manipulación DOM
const DOMUtils = {
    // Seleccionar elementos con sintaxis más concisa
    select: (selector, parent = document) => parent.querySelector(selector),
    selectAll: (selector, parent = document) => [...parent.querySelectorAll(selector)],
    
    // Manipular contenido de elementos
    setText: (element, text) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.textContent = text;
      return element;
    },
    
    setHTML: (element, html) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.innerHTML = html;
      return element;
    },
    
    // Manipulación de atributos
    setAttr: (element, attr, value) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.setAttribute(attr, value);
      return element;
    },
    
    getAttr: (element, attr) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      return element.getAttribute(attr);
    },
    
    removeAttr: (element, attr) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.removeAttribute(attr);
      return element;
    },
    
    // Manipulación de clases
    addClass: (element, ...classes) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.classList.add(...classes);
      return element;
    },
    
    removeClass: (element, ...classes) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.classList.remove(...classes);
      return element;
    },
    
    toggleClass: (element, className) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.classList.toggle(className);
      return element;
    },
    
    hasClass: (element, className) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      return element.classList.contains(className);
    },
    
    // Manipulación de estilos
    setStyle: (element, property, value) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.style[property] = value;
      return element;
    },
    
    setStyles: (element, styles) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      Object.entries(styles).forEach(([property, value]) => {
        element.style[property] = value;
      });
      return element;
    },
    
    // Creación y manipulación de elementos
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
    
    remove: (element) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.parentNode.removeChild(element);
    },
    
    // Gestión de eventos
    on: (element, event, handler, options = {}) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.addEventListener(event, handler, options);
      return element;
    },
    
    off: (element, event, handler) => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      element.removeEventListener(event, handler);
      return element;
    },
    
    // Delegación de eventos
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
    
    // Animación simple con transiciones CSS
    animate: (element, properties, duration = 300, easing = 'ease') => {
      if (typeof element === 'string') element = DOMUtils.select(element);
      return new Promise(resolve => {
        const originalTransition = element.style.transition;
        
        element.style.transition = `all ${duration}ms ${easing}`;
        
        // Establecer las propiedades CSS después de un pequeño retraso para asegurarse de que la transición se aplique
        setTimeout(() => {
          Object.entries(properties).forEach(([prop, value]) => {
            element.style[prop] = value;
          });
        }, 10);
        
        // Evento para cuando la transición termine
        const onTransitionEnd = () => {
          element.style.transition = originalTransition;
          element.removeEventListener('transitionend', onTransitionEnd);
          resolve(element);
        };
        
        element.addEventListener('transitionend', onTransitionEnd);
        
        // Resolver la promesa incluso si el evento transitionend no se dispara
        setTimeout(onTransitionEnd, duration + 50);
      });
    },
    
    // Utilidades para formularios
    serialize: (form) => {
      if (typeof form === 'string') form = DOMUtils.select(form);
      const formData = new FormData(form);
      return Object.fromEntries(formData.entries());
    },
    
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

  //Ejemplos de uso
  // Seleccionar y modificar un elemento
DOMUtils.select('.header h1').textContent = "Nuevo título";

// Crear un nuevo elemento y añadirlo al DOM
const newElement = DOMUtils.create('div', { 
  class: 'notification', 
  id: 'alert' 
}, '<strong>¡Atención!</strong> Este es un mensaje importante.');

DOMUtils.append('body', newElement);

// Animar un elemento
DOMUtils.animate('.notification', {
  opacity: '1',
  transform: 'translateY(20px)'
}, 500).then(() => {
  console.log('Animación completada');
});

// Eliminar el elemento después de 3 segundos
setTimeout(() => {
  DOMUtils.animate('.notification', {
    opacity: '0',
    transform: 'translateY(-20px)'
  }, 500).then(() => {
    DOMUtils.remove('.notification');
  });
}, 3000);