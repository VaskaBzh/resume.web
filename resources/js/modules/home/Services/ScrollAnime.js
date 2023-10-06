import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger)

export function animatedScroll() {
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
    const tl = gsap.timeline()
    tl.addLabel('my-label')
    tl.addLabel('transparent-logo', 0.5)
    gsap.timeline({
        paused: true
    })
    const animation = tl
        .to('.app_back_transparent', {
            position: 'fixed'
        }, 'my-label')
        .fromTo('.header-land_title_expert-one', {opacity: 1}, {
            xPercent: -100,
            opacity: 0,
            duration: 1,
        }, 'my-label')
        .fromTo('.header-land_title_expert-two', {opacity: 1}, {
            xPercent: -100,
            opacity: 0,
            duration: 1,
        }, 'my-label')
        .fromTo('.header-land_title_approach', {opacity: 1}, {
            xPercent: 100,
            opacity: 0,
            duration: 1,
        }, 'my-label')
        .fromTo('.header-land_title_mining-one', {opacity: 1}, {
            xPercent: -100,
            opacity: 0,
            duration: 1,
        }, 'my-label')
        .fromTo('.header-land_title_span', {opacity: 1}, {
            xPercent: -100,
            opacity: 0,
        }, 'my-label')
        .fromTo('.header-land_title_text', {opacity: 1}, {
            xPercent: 100,
            opacity: 0,
            duration: 1,
        }, 'my-label')
        .fromTo('.app_back_transparent_block-one', {
                // alignSelf: 'flex-start',
                duration: .6,
                xPercent: 0

            },
            {
                // alignSelf: 'center',
                duration: .6,
                xPercent: 40

            }, 'transparent-logo')

        .fromTo('.app_back_transparent_block-two', {
                // alignSelf: 'flex-end',
                duration: .6,
                xPercent: 0

            },
            {
                // alignSelf: 'center',
                xPercent: -40,
                duration: .6
            }, 'transparent-logo')
        .fromTo('.app_back_transparent__container', {rotateX: 0, opacity: 1, yPercent: 0, duration: 1.5, scale: 1}, {
            rotateX: 60,
            opacity: 0,
            yPercent: -30,
            duration: 1,
            scale: 0,

        })


    ScrollTrigger.create({
        animation: animation,
        trigger: ".header-land",
        start: "top 0",
        end: document.querySelector('.header-land').offsetHeight/2,
        pin: true,
        scrub: 2,
        id: '.header-land',
        smoothChildTiming: true

    })


}


