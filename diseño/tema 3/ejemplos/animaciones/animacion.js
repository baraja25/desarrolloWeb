class Sprite {
    constructor(options) {
        this.context = options.context;
        this.image = options.image; // Path to image sprite sheet
        this.x = options.x; // Coordinates on canvas
        this.y = options.y;
        this.width = options.width; // Size of sprite frame
        this.height = options.height;
        this.frames = options.frames; // Number of frames in a row
        this.frameIndex = options.frameIndex; // Current frame
        this.row = options.row; // Row of sprites
        this.ticksPerFrame = options.ticksPerFrame; // Speed of animation
        this.tickCount = options.tickCount; // How much time has passed
    }

    update() {
        this.tickCount += 1;
        if (this.tickCount > this.ticksPerFrame) {
            this.tickCount = 0;
            if (this.frameIndex < this.frames - 1) {
                this.frameIndex += 1;
            } else {
                this.frameIndex = 0;
            }
        }
    }

    render() {
        this.context.drawImage(
            this.image,
            this.frameIndex * this.width, // The x-axis coordinate of the top left corner
            this.row * this.height, // The y-axis coordinate of the top left corner
            this.width, // The width of the sub-rectangle
            this.height, // The height of the sub-rectangle
            this.x, // The x coordinate
            this.y,// The y coordinate
            this.width, // The width to draw the image
            this.height // The width to draw the image
        );
    }
}

class Sonic extends Sprite {
    static src = 'sonic3_spritesheet.png';

    constructor(x, y, context, image) {
        super({
            context: context,
            image: image,
            x: x,
            y: y,
            width: 114,
            height: 120,
            frameIndex: 0,
            row: 1,
            tickCount: 0,
            ticksPerFrame: 4,
            frames: 8
        });
    }

    walk() {
        this.frames = 8;
        this.frameIndex = 0;
        this.row = 1;
        this.ticksPerFrame = 4;
    }

    run() {
        this.frames = 4;
        this.frameIndex = 0;
        this.row = 2;
        this.ticksPerFrame = 2;
    }

    idle() {
        this.frames = 9;
        this.frameIndex = 0;
        this.row = 0;
        this.ticksPerFrame = 12;
    }
}