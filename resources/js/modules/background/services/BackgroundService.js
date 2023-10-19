export function BackgroundService(cvs) {
    let canvas = cvs;
    let ctx = null;
    let particles = [];
    let baseHue = 210;
    let setWidth = 0;
    let setHeight = 0;

    ctx = canvas.getContext("2d");
    const dist = (x1, y1, x2, y2) => {
        let a = x1 - x2;
        let b = y1 - y2;
        return Math.sqrt(a * a + b * b);
    }

    const mouseEventProcess = (e) => {
        let mx = e.clientX;
        let my = e.clientY;

        for (let i = 0; i < particles.length; i++) {
            if (
                dist(particles[i].x, particles[i].y, mx, my) < 80
            ) {
                particles[i].vx = (mx - particles[i].x) / 30;
                particles[i].vy = (my - particles[i].y) / 30;
            }
        }
    };


    const draw = () => {
        const drawParticle = (particle) => {
            ctx.beginPath();
            let gradient = ctx.createLinearGradient(
                0,
                0,
                setWidth,
                setHeight
            );
            gradient.addColorStop(0, "#183ED7");
            gradient.addColorStop(1, "#2E90FA");
            ctx.fillStyle = gradient;
            ctx.arc(
                particle.x,
                particle.y,
                particle.rad,
                0,
                2 * Math.PI
            );
            ctx.fill();
            ctx.closePath();

            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x < 0 + particle.rad || particle.x + particle.rad > setWidth)
                particle.vx = -particle.vx;
            if (particle.y - particle.rad < 0 || particle.y + particle.rad > setHeight)
                particle.vy = -particle.vy;
        }

        particles.forEach(drawParticle);
    }

    const getMultiplier = () => {
        const width = window.innerWidth;
        if (width <= 480) return 0.5;
        if (width <= 768) return 0.75;
        return 1;
    }

    const pushParticles = () => {
        const multiplier = getMultiplier();

        const numberOfParticles = Math.floor(20 * multiplier);
        const maxParticleSize = 300 * multiplier;

        for (let i = 0; i < numberOfParticles; i++) {
            particles.push({
                x: Math.random() * setWidth,
                y: Math.random() * setHeight,
                vx: Math.random() * 4 - 2,
                vy: Math.random() * 4 - 2,
                hue: Math.random() * 80 - 40,
                rad: Math.random() * maxParticleSize + 10,
            });
        }
    }
    const render = () => {
        ctx.clearRect(0, 0, setWidth, setHeight);
        draw();
        requestAnimationFrame(render);
    }

    const resizeEventProcess = () => {
        setWidth = ctx.canvas.width = window.innerWidth;
        setHeight = ctx.canvas.height = window.innerHeight;
        ctx.filter = "blur(70px) brightness(0.3)";
        ctx.globalCompositeOperation = "lighter";

        render();
    };

    canvas.onmousemove = mouseEventProcess;
    window.onresize = resizeEventProcess;

    window.onresize();

    pushParticles();
    render();
}
