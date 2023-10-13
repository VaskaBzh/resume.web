import anime from "animejs";

const timelineConfig = {
    easing: "easeInOutSine",
    duration: 600,
};
const timelineConfigLonger = {
    easing: "easeInOutSine",
    duration: 1200,
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

export function upLeft() {
    const timeline = anime.timeline(timelineConfigLonger);

    timeline.add({
        targets: ".animation-left",
        translateX: ["100%", "0%"],
        opacity: [0, 1],
    });
}

export function upRight() {
    const timeline = anime.timeline(timelineConfigLonger);

    timeline.add({
        targets: ".animation-right",
        translateX: ["-100%", "0%"],
        opacity: [0, 1],
    });
}

export function destroy() {
    const timeline = anime.timeline(timelineConfig);

    timeline.add({
        targets: ".animation-destroy",
        maxHeight: [300, 0],
    });
}

export function reDestroy(margin) {
    const timeline = anime.timeline(timelineConfig);

    timeline.add({
        targets: ".animation-destroy",
        maxHeight: [0, 300],
    });
}

