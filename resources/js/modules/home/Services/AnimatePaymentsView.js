import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function animatePayView() {

    gsap.registerPlugin(ScrollTrigger)

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: ".payments-view",
            start: 'top +=300',
            end: 'bottom bottom',
            pin: false,
            scrub: false,
            id: '.payments-view',
        }
    })


    tl.fromTo('.payments-view__item-one', {opacity: 0}, {
        opacity: 1,
    })
    tl.fromTo('.payments-view__item-two', {opacity: 0}, {
        opacity: 1,
    })
    tl.fromTo('.payments-view__item-three', {opacity: 0}, {
        opacity: 1,
    })

    tl.scrollTrigger.refresh();

}
