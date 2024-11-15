class card {
  constructor(suit, value) {
    this.suit = suit;
    this.value = value;
  }

  getBlackJackValue() {
    if (this.value == "A") {
      return 11;
    } else if (["J", "Q", "K"].includes(this.value)) {
      return 10;
    } else {
      return parseInt(this.value);
    }
  }
}

class deck {
  constructor() {
    this.cards = [];
    this.suits = ["corazones", "picas", "diamantes", "treboles"];
    this.values = [
      "2",
      "3",
      "4",
      "5",
      "6",
      "7",
      "8",
      "9",
      "10",
      "J",
      "Q",
      "K",
      "A",
    ];
    this.initializeDeck();
  }

  // metodo para inicializar la baraja
  initializeDeck() {
    for (const suit of this.suits) {
      for (const value of this.values) {
        this.cards.push(new card(suit, value));
      }
    }
  }
  // metodo para mezclar las cartas
  shuffle() {
    for (let i = this.cards.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      // mezclar
      [this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
    }
  }
  //metodo para sacar una carta
  drawCard() {
    return this.cards.pop();
  }

  // metodo para ver cuantas cartas quedan en la baraja
  cardsRemaining() {
    return this.cards.length;
  }
}

class hand {
  constructor() {
    this.cards = [];
  }

  addCard(card) {
    this.cards.push(card);
  }

  getTotalValue() {
    let total = 0;
    let aceCount = 0;

    //sumar el valor de cada carta
    for (const card of this.cards) {
      const cardValue = card.getBlackJackValue();
      total += cardValue;

      if (card.value === "A") {
        aceCount++;
      }
    }

    // ajustar el valor de los ases
    while (total > 21 && aceCount > 0) {
      total -= 10; //convertir el valor de as a 1
      aceCount--;
    }

    return total;
  }

  isbusted() {
    return this.getTotalValue() > 21; // verifica si ha superado 21
  }
}

class player {
  constructor(name) {
    this.name = name; //nombre del jugador o dealer
    this.hand = new hand(); //crear una nueva mano
  }

  addCard(card) {
    this.hand.addCard(card); //agregar una carta a la mano
  }

  getScore() {
    return this.hand.getTotalValue();
  }

  hasBusted() {
    return this.hand.isbusted(); //verificar si el jugador ha superado
  }
}

class blackjackGame {
  constructor(playerName) {
    this.deck = new deck();
    this.player = new player(playerName);
    this.dealer = new player("Dealer");
  }

  startGame() {
    this.deck.shuffle();
    this.player.addCard(this.deck.drawCard());
    this.player.addCard(this.deck.drawCard());
    this.dealer.addCard(this.deck.drawCard());
    this.dealer.addCard(this.deck.drawCard());
  }

  playerTurn() {
    while (!this.player.hasBusted()) {
      const action = prompt("¿Quieres pedir otra carta (p) o plantarte (s)?");
      if (action === "p") {
        this.player.addCard(this.deck.drawCard());
        console.log(
          `${this.player.name} tiene un puntaje de: ${this.player.getScore()}`
        );
      } else if (action === "s") {
        break; // El jugador se planta
      }
    }

    if (this.player.hasBusted()) {
      console.log(`${this.player.name} ha superado 21. ¡ Perdiste!`);
    } else {
      this.dealerTurn(); // Si el jugador no ha superado 21, es el turno del dealer
    }
  }

  dealerTurn() {
    console.log(
      `El turno del dealer comienza. El dealer tiene un puntaje de: ${this.dealer.getScore()}`
    );
    while (this.dealer.getScore() < 17) {
      this.dealer.addCard(this.deck.drawCard());
      console.log(
        `El dealer saca una carta. Puntaje actual: ${this.dealer.getScore()}`
      );
    }

    this.determineWinner(); // Determinar el ganador al final del turno del dealer
  }

  determineWinner() {
    const playerScore = this.player.getScore();
    const dealerScore = this.dealer.getScore();

    // Actualiza el contenido de los elementos HTML
    document.getElementById("score-player").innerText = `${this.player.name} tiene un puntaje de: ${playerScore}`;
    document.getElementById("score-dealer").innerText = `El dealer tiene un puntaje de: ${dealerScore}`;

    // Elementos para mostrar el resultado
    const resultPlayer = document.getElementById("result-player");
    const resultDealer = document.getElementById("result-dealer");

    if (this.player.hasBusted()) {
        resultPlayer.innerText = "El dealer gana porque el jugador ha superado 21.";
        resultDealer.innerText = "";
    } else if (this.dealer.hasBusted() || playerScore > dealerScore) {
        resultPlayer.innerText = `${this.player.name} gana!`;
        resultDealer.innerText = "";
    } else if (playerScore < dealerScore) {
        resultDealer.innerText = "El dealer gana!";
        resultPlayer.innerText = "";
    } else {
        resultPlayer.innerText = "Es un empate!";
        resultDealer.innerText = "";
    }
}
}


let game;

function nuevaPartida() {
    game = new blackjackGame("Jugador 1");
    game.startGame();
    updateUI();
}

function updateUI() {
    // Actualizar las cartas y puntuaciones del jugador
    document.getElementById("cards-player").innerText = `Cartas: ${game.player.hand.cards.map(card => `${card.value} de ${card.suit}`).join(', ')}`;
    document.getElementById("score-player").innerText = `Puntuación: ${game.player.getScore()}`;
    
    // Actualizar las cartas y puntuaciones del dealer
    document.getElementById("cards-dealer").innerText = `Cartas: ${game.dealer.hand.cards.map(card => `${card.value} de ${card.suit}`).join(', ')}`;
    document.getElementById("score-dealer").innerText = `Puntuación: ${game.dealer.getScore()}`;
    
    // Limpiar resultados
    document.getElementById("result-player").innerText = '';
    document.getElementById("result-dealer").innerText = '';
}

document.getElementById("hit-button").addEventListener("click", function() {
    game.player.addCard(game.deck.drawCard());
    updateUI();

    if (game.player.hasBusted()) {
        document.getElementById("result-player").innerText = "¡Has superado 21! Perdiste.";
        document.getElementById("result-dealer").innerText = "El dealer gana.";
    }
});

document.getElementById("stay-button").addEventListener("click", function() {
    game.dealerTurn();
    updateUI();
    game.determineWinner();
});
