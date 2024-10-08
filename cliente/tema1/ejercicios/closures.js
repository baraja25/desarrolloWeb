/* Ejercicio 1  */
function createCounter() {
  let contador = 0;
  

  // Definimos una función interna llamada 'incrementar' que aumenta el valor de 'contador'
  function incrementar() {
    return ++contador; // Incrementa el valor de 'contador' en 1 y lo devuelve
  }

  return incrementar;
}

// Al llamar 'createCounter()', obtenemos la función 'incrementar' con su propio 'contador'
const counter = createCounter();

console.log(counter()); // Llamamos a 'counter()', lo que ejecuta 'incrementar' y devuelve 1
console.log(counter()); // Llamamos a 'counter()' de nuevo, lo que incrementa y devuelve 2
console.log(counter()); // Tercera llamada, incrementa y devuelve 3

/* Ejercicio 2 */

function createGreeting(saludo) {
  return function (nombre) {
    return `${saludo}, ${nombre}`;
  };
}

// Ejemplo de uso
const greetInSpanish = createGreeting("Hola");
console.log(greetInSpanish("Juan")); // "Hola, Juan"
console.log(greetInSpanish("María")); // "Hola, María"

const greetInEnglish = createGreeting("Hello");
console.log(greetInEnglish("John")); // "Hello, John"

/* Ejercicio 3 */

function createBankAccount(balanceInicial) {
  let balance = balanceInicial;

  return {
    deposit: function (cantidad) {
      balance += cantidad;
      console.log(`Depósito de ${cantidad} realizado. Balance: ${balance}`);
      return balance;
    },
    withdraw: function (cantidad) {
      if (cantidad > balance) {
        console.log(`No suficiente saldo. Balance: ${balance}`);
      } else {
        balance -= cantidad;
        console.log(`Retiro de ${cantidad} realizado. Balance: ${balance}`);
      }
      return balance;
    },
  };
}
// Ejemplo de uso
const myAccount = createBankAccount(100);
myAccount.deposit(50); // Balance: 150
myAccount.withdraw(30); // Balance: 120
myAccount.withdraw(150); // No suficiente saldo, Balance: 120
