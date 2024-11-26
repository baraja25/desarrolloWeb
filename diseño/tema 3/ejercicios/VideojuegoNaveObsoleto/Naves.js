// CONSTANTES
const JUEGO_FPS = 50;

window.onload = function () {
    const micanvas = document.getElementById("espacio");
    const contexto = micanvas.getContext("2d");
    const juego = new Juego(micanvas, contexto);
};

class ManejadorDeEventos {
    constructor(nave) {
        this.nave = nave;
        this.tecla = this.tecla.bind(this); // this se refiere a la instancia de la clase
        document.body.onkeydown = this.tecla;
    }

    tecla(e) {
        const evento = e;

        switch (evento.key) {
            case "a":
                this.nave.moverIzquierda();
                break;
            case "d":
                this.nave.moverDerecha();
                break;
            case "w":
                this.nave.moverArriba();
                break;
            case "s":
                this.nave.moverAbajo();
                break;
        }
        return 0;
    }
}

class Nave {
    constructor(micanvas, contexto) {
        this._posx = Math.round(micanvas.width / 2) - 40;
        this._posy = micanvas.height - 60;
        this._figura = new Image();
        this._figura.src = "img/viper.jpg";
        this.contexto = contexto; // Guardar el contexto para usarlo en dibujar

        // Esperar a que la imagen se cargue antes de dibujar
        this._figura.onload = () => {
            this.dibujar(); // Solo dibujar cuando la imagen esté lista
        };
    }

    dibujar() {
        const figura = this.figura;
        this.contexto.drawImage(figura, this._posx, this._posy, 60, 60);
    }

    moverIzquierda() {
        if (this._posx > 0) {
            this._posx -= 15;
        }
    }

    moverDerecha() {
        if (this._posx < this.contexto.canvas.width - 60) { // Ajustar para el ancho de la nave
            this._posx += 15;
        }
    }

    moverArriba() {
        if (this._posy > 0) {
            this._posy -= 15; // Cambiar a -= para mover hacia arriba
        }
    }

    moverAbajo() {
        if (this._posy < this.contexto.canvas.height - 60) { // Ajustar para la altura de la nave
            this._posy += 15; // Cambiar a += para mover hacia abajo
        }
    }

    get posx() {
        return this._posx;
    }

    set posx(value) {
        this._posx = value;
    }

    get posy() {
        return this._posy;
    }

    set posy(value) {
        this._posy = value;
    }

    get figura() {
        return this._figura;
    }

    set figura(value) {
        this._figura = value;
    }
}

class Juego {
    constructor(micanvas, contexto) {
        this.viper = new Nave(micanvas, contexto); // Pasar el contexto aquí
        this.contexto = contexto; // Guardar el contexto para limpiar el canvas
        this.intervalId = setInterval(this.correr.bind(this), 1000 / JUEGO_FPS);
        this.manejadorNave = new ManejadorDeEventos(this.viper); // Asegúrate de que el manejador de eventos esté aquí
    }

    correr() {
        limpiar(this.contexto); // Limpiar el canvas
        this.viper .dibujar(); // Dibujar la nave en su nueva posición
    }
}

const limpiar = (contexto) => {
    contexto.clearRect(0, 0, contexto.canvas.width, contexto.canvas.height); // Limpiar el canvas
}

