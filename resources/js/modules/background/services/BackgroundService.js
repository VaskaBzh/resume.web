export function BackgroundService(cvs) {
    let canvas = cvs;
    let ctx = canvas.getContext("2d");
    let particles = [];
    let setWidth = window.innerWidth - 15;
    let setHeight = window.innerHeight;

    // Создаем градиент один раз
    let gradient = ctx.createLinearGradient(0, 0, setWidth, setHeight);
    gradient.addColorStop(0, "#194185");
    gradient.addColorStop(1, "#002564");

    const dist = (x1, y1, x2, y2) => {
        return Math.sqrt((x1 - x2) ** 2 + (y1 - y2) ** 2);
    };

    const draw = () => {
        for (let particle of particles) {
            ctx.beginPath();
            ctx.fillStyle = gradient;
            ctx.arc(particle.x, particle.y, particle.rad, 0, 2 * Math.PI);
            ctx.fill();

            particle.x += particle.vx;
            particle.y += particle.vy;

            if (
                particle.x < particle.rad ||
                particle.x + particle.rad > setWidth
            )
                particle.vx = -particle.vx;
            if (
                particle.y < particle.rad ||
                particle.y + particle.rad > setHeight
            )
                particle.vy = -particle.vy;
        }
    };

    const getMultiplier = () => {
        if (setWidth <= 480) return 0.5;
        if (setWidth <= 768) return 0.75;
        return 1;
    };

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
                rad: Math.random() * maxParticleSize + 10,
            });
        }
    };
    const render = () => {
        ctx.clearRect(0, 0, setWidth, setHeight);
        draw();
        requestAnimationFrame(render);
    };

    const resizeEventProcess = () => {
        setWidth = canvas.width = window.innerWidth - 15;
        setHeight = canvas.height = window.innerHeight;

        ctx.globalCompositeOperation = "lighter";
    };

    window.onresize = resizeEventProcess;
    resizeEventProcess();

    pushParticles();
    render();
}
