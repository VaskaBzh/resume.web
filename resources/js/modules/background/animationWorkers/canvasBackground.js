const canvas = new OffscreenCanvas(self.innerWidth, self.innerHeight);
const ctx = canvas.getContext('2d');
const particles = [];

function updateAnimationFrame() {
    // Очистить холст
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let i = 0; i < particles.length; i++) {
        ctx.beginPath();
        let gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
        gradient.addColorStop(0, "#183ED7");
        gradient.addColorStop(1, "#2E90FA");

        ctx.fillStyle = gradient;
        ctx.arc(
            particles[i].x,
            particles[i].y,
            particles[i].rad,
            0,
            2 * Math.PI
        );
        ctx.fill();
        ctx.closePath();

        particles[i].x += particles[i].vx;
        particles[i].y += particles[i].vy;

        if (
            particles[i].x < 0 + particles[i].rad ||
            particles[i].x + particles[i].rad > canvas.width
        )
            particles[i].vx = -particles[i].vx;
        if (
            particles[i].y - particles[i].rad < 0 ||
            particles[i].y + particles[i].rad > canvas.height
        )
            particles[i].vy = -particles[i].vy;
    }

    self.postMessage('animationFrame');
}

self.addEventListener('message', (e) => {
    if (e.data === 'startAnimation') {
        // Запустить анимацию
        startAnimation();
    } else if (e.data === 'stopAnimation') {
        stopAnimation();
    }
});

function startAnimation() {
    const multiplier = getMultiplier();

    const numberOfParticles = Math.floor(20 * multiplier);
    const maxParticleSize = 300 * multiplier;

    for (let i = 0; i < numberOfParticles; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            vx: Math.random() * 4 - 2,
            vy: Math.random() * 4 - 2,
            rad: Math.random() * maxParticleSize + 10,
        });
    }

    function animate() {
        updateAnimationFrame();
        requestAnimationFrame(animate);
    }

    animate();
}

function getMultiplier() {
    const width = self.innerWidth;
    if (width <= 480) return 0.5;
    if (width <= 768) return 0.75;
    return 1;
}

startAnimation();
