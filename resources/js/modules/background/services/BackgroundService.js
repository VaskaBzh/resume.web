import {DomElementService} from "@/modules/common/services/extends/base/DomElementService";

export class BackgroundService {
    constructor() {
        this.canvas = this.createDomElementService();
        this.ctx = null;
        this.particles = [];
        this.baseHue = 210;
        this.setWidth = 0;
        this.setHeight = 0;
    }

    createDomElementService() {
        return new DomElementService();
    }

    getContext() {
        this.ctx = this.canvas.element.getContext("2d");
    }

    // createCanvasElementService() {
    //     return new CanvasElementService();
    // }

    startProcess() {
        this.pushParticles();
        this.render();
    }

    render = () => {
        this.ctx.clearRect(0, 0, this.setWidth, this.setHeight);
        this.draw();
        requestAnimationFrame(this.render);
    };

    resizeEvent() {
        window.onresize = this.resizeEventProcess;

        window.onresize();
    }

    resizeEventProcess = () => {
        this.setWidth = this.ctx.canvas.width = window.innerWidth;
        this.setHeight = this.ctx.canvas.height = window.innerHeight;
        this.ctx.filter = "blur(70px) brightness(0.3)";
        this.ctx.globalCompositeOperation = "lighter";
    };

    mouseEvent() {
        this.canvas.element.onmousemove = this.mouseEventProcess;
    }

    mouseEventProcess = (e) => {
        let mx = e.clientX;
        let my = e.clientY;

        for (let i = 0; i < this.particles.length; i++) {
            if (
                this.dist(this.particles[i].x, this.particles[i].y, mx, my) < 80
            ) {
                this.particles[i].vx = (mx - this.particles[i].x) / 30;
                this.particles[i].vy = (my - this.particles[i].y) / 30;
            }
        }
    };

    dist(x1, y1, x2, y2) {
        let a = x1 - x2;
        let b = y1 - y2;
        return Math.sqrt(a * a + b * b);
    }

    draw() {
        for (let i = 0; i < this.particles.length; i++) {
            this.ctx.beginPath();
            let gradient = this.ctx.createLinearGradient(
                0,
                0,
                this.setWidth,
                this.setHeight
            );
            gradient.addColorStop(0, "#183ED7");
            gradient.addColorStop(1, "#2E90FA");


            this.ctx.fillStyle = gradient;
            this.ctx.arc(
                this.particles[i].x,
                this.particles[i].y,
                this.particles[i].rad,
                0,
                2 * Math.PI
            );
            this.ctx.fill();
            this.ctx.closePath();

            this.particles[i].x += this.particles[i].vx;
            this.particles[i].y += this.particles[i].vy;

            if (
                this.particles[i].x < 0 + this.particles[i].rad ||
                this.particles[i].x + this.particles[i].rad > this.setWidth
            )
                this.particles[i].vx = -this.particles[i].vx;
            if (
                this.particles[i].y - this.particles[i].rad < 0 ||
                this.particles[i].y + this.particles[i].rad > this.setHeight
            )
                this.particles[i].vy = -this.particles[i].vy;
        }
    }

    pushParticles() {
        for (let i = 0; i < 20; i++) {
            this.particles.push({
                x: Math.random() * this.setWidth,
                y: Math.random() * this.setHeight,
                vx: Math.random() * 4 - 2,
                vy: Math.random() * 4 - 2,
                hue: Math.random() * 80 - 40,
                rad: Math.random() * 300 + 10,
            });
        }
    }
}
