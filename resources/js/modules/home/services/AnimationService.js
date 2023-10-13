import anime from "animejs";

const timelineConfig = {
    easing: "easeInOutSine",
    duration: 600,
};

export function LineUp() {
    const timeline = anime.timeline(timelineConfig);

    timeline.add({
        targets: ".animation-up",
        translateY: ["110%", "0%"],
        opacity: [0, 1],
    });
}

export function LineUpBack() {
    const timeline = anime.timeline(timelineConfig);

    timeline.add({
        targets: ".animation-up",
        translateY: ["0%", "-110%"],
        opacity: [1, 0],
    });
}

export function opacity() {
    const timeline = anime.timeline(timelineConfig);

    timeline.add({
        targets: ".animation-opacity",
        opacity: [0, 1],
    });
}
