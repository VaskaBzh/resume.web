import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function animatePayView() {

    gsap.registerPlugin(ScrollTrigger)

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".payments-view",
            start: 'top top',
            end: 'center center',
            pin: false,
            scrub: 1.5,
            id: '.payments-view',
            markers: true,
        }
    })


    tl.fromTo('.payments-view__item-one', {opacity: 0}, {
        opacity: 1,
    })
    tl.fromTo('.payments-view__item-two', {opacity: 0}, {
        opacity: 1,
    }, '>+0.9')
    tl.fromTo('.payments-view__item-three', {opacity: 0}, {
        opacity: 1,
    }, '>+1')

    tl.scrollTrigger.refresh();

}
