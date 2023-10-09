import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";



export function animatedSecurityView() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()

    const animateSecurityView = tl
        .fromTo('.security-view_item_title', {opacity: 0}, {
            opacity: 1
        })

    gsap.timeline({
        paused: true
    })

    ScrollTrigger.create({
        animation: animateSecurityView,
        trigger: ".security-view",
        start: "top top",
        end: "+=1000",
        pin: true,
        scrub: 1.5,
        markers: true,
        id: ".security-view",
        smoothChildTiming: true,
    })
}
