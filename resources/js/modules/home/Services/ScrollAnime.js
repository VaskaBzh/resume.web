import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger)

export function animatedScroll () {
    ScrollTrigger.normalizeScroll(true)
    let tl = new gsap.timeline()
    gsap.to(('.security-view_item'), {
        duration: 3,
        scrollTrigger: {
            trigger: '.security-view__wrapper',
            start: 'top top',
            end: 'bottom bottom',
            scrub: true,
            pin: '.security-view_right',
            pinSpacing: false,
            marker: true

        }
    })
}


export function scroolingHeader() {

    gsap.to(".header-land_title_expert-one", {
        scrollTrigger: {
            trigger: ".header-land_title",
            scrub: true,
            start: "top top",
            end: "bottom bottom",
            toggleClass: "active",
            ease: "power2",
            markers: true
        }
    });

    gsap.to(".header-land_title_expert-one", {
        scrollTrigger: {
            trigger: ".header-land_title",
            scrub: 1.5,
            start: "top top",
            end: "bottom bottom",
            ease: "power2"
        },
        xPercent: -100
    });

}


