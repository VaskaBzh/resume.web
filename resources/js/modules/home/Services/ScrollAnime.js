import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function scroolingHeader() {
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".app_back_transparent",
            start: "top -=30",
            end: "center center",
            pin: false,
            scrub: 3,
            id: ".app_back_transparent",
            smoothChildTiming: true,
        },
    });
    tl.addLabel("my-label");
    tl.addLabel("transparent-logo", 0.5);
    gsap.timeline({
        paused: true,
    });
    const animation = tl
        .fromTo(
            ".header-land_title_expert-one",
            {opacity: 1},
            {
                xPercent: -100,
                opacity: 0,
                duration: 1,
            },
            "my-label"
        )
        .fromTo(
            ".header-land_title_expert-two",
            {opacity: 1},
            {
                xPercent: -100,
                opacity: 0,
                duration: 1,
            },
            "my-label"
        )
        .fromTo(
            ".header-land_title_approach",
            {opacity: 1},
            {
                xPercent: 100,
                opacity: 0,
                duration: 1,
            },
            "my-label"
        )
        .fromTo(
            ".header-land_title_mining-one",
            {opacity: 1},
            {
                xPercent: -100,
                opacity: 0,
                duration: 1,
            },
            "my-label"
        )
        .fromTo(
            ".header-land_title_span",
            {opacity: 1},
            {
                xPercent: -100,
                opacity: 0,
            },
            "my-label"
        )
        .fromTo(
            ".header-land_title_text",
            {opacity: 1},
            {
                xPercent: 100,
                opacity: 0,
                duration: 1,
            },
            "my-label"
        )
        .fromTo(
            ".app_back_transparent_block-one",
            {
                duration: 0.6,
                xPercent: 0,
            },
            {
                duration: 0.6,
                xPercent: 35,
            },
            "transparent-logo"
        )

        .fromTo(
            ".app_back_transparent_block-two",
            {
                duration: 0.6,
                xPercent: 0,
            },
            {
                xPercent: -35,
                duration: 0.6,
            },
            "transparent-logo"
        )
        .fromTo(
            ".app_back_transparent__container",
            {rotateX: 0, opacity: 1, yPercent: 0, duration: 1.5, scale: 1},
            {
                rotateX: 60,
                opacity: 0,
                yPercent: -30,
                duration: 1,
                scale: 0,
            }
        );

    ScrollTrigger.create({
        animation: animation,
        trigger: ".header-land",
        start: "top -=30",
        end: "center center",
        pin: false,
        scrub: 3,
        id: ".header-land",
        invalidateOnRefresh: true,
        smoothChildTiming: true,
        onUpdate: (self) => {
            let btnHeaderScrooll = document.querySelector(".header-land_btn");
            console.log(self.progress)
            if (self.progress < 0.5) {
                btnHeaderScrooll.style.opacity = 1;
            } else {
                btnHeaderScrooll.style.opacity = 1 - self.progress;
            }
        },
    });
    ScrollTrigger.refresh();
    console.log(document.querySelectorAll('.scroll-section'))
}
