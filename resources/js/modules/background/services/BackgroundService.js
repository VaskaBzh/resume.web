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
        // requestAnimationFrame(this.render);
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

        this.render();
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
        const drawParticle = (particle) => {
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
                particle.x,
                particle.y,
                particle.rad,
                0,
                2 * Math.PI
            );
            this.ctx.fill();
            this.ctx.closePath();

            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x < 0 + particle.rad || particle.x + particle.rad > this.setWidth)
                particle.vx = -particle.vx;
            if (particle.y - particle.rad < 0 || particle.y + particle.rad > this.setHeight)
                particle.vy = -particle.vy;
        }

        this.particles.forEach(drawParticle);
    }

    getMultiplier() {
        const width = window.innerWidth;
        if (width <= 480) return 0.5;
        if (width <= 768) return 0.75;
        return 1;
    }

    pushParticles() {
        const multiplier = this.getMultiplier();

        const numberOfParticles = Math.floor(20 * multiplier);
        const maxParticleSize = 300 * multiplier;

        for (let i = 0; i < numberOfParticles; i++) {
            this.particles.push({
                x: Math.random() * this.setWidth,
                y: Math.random() * this.setHeight,
                vx: Math.random() * 4 - 2,
                vy: Math.random() * 4 - 2,
                hue: Math.random() * 80 - 40,
                rad: Math.random() * maxParticleSize + 10,
            });
        }
    }
}
