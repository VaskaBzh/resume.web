import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function scrollingAbout() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()
    gsap.timeline({
        paused: true
    })
    let animation = tl
        .fromTo(['.about_item_card', '.about_item_title'], {opacity: 0}, {
            opacity: 1,
            duration: 2
        })



    ScrollTrigger.create({
        animation: animation,
        trigger: ".about_stiky",
        start: "top top",
        end: document.querySelector('.about__wrapper').offsetHeight,
        pin: true,
        scrub: 1,
        id: '.about_stiky',
        markers: true,
        smoothChildTiming: true,
    })

}
