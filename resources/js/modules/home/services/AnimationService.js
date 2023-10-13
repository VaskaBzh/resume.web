import anime from "animejs";

const timelineConfig = {
    easing: "easeInOutSine",
    duration: 450,
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
    const timeline = anime.timeline(timelineConfig)

    timeline.add({
        targets: '.calculator_title_base .calculator_title_two .calculator_title_four',
        translateY: ['100%', '0%']
    }, '+=1')
    timeline.add({
        targets: '.calculator_title_o .calculator_title_three',
        translateY: ['-100%', '0%']
    }, '+=1')
}

