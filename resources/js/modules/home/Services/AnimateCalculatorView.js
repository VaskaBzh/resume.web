import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function animatedCalcView() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()
    tl.addLabel('titleCalc')
    let animateCalc = tl
        .fromTo(['.calculator-land_title_base','.calculator-land_title_two','.calculator-land_title_four'], {opacity: 0, xPercent: -50}, {
            opacity: 1,
            xPercent: 0,
            duration: 1
        }, 'titleCalc')
        .fromTo(['.calculator-land_title_one','.calculator-land_title_three'], {opacity: 0, xPercent: 50}, {
            opacity: 1,
            duration: 1,
            xPercent: 0
        }, 'titleCalc')
        .fromTo('.calculator-land_subtitle', {opacity: 0}, {
            opacity: 1,
            duration: 1
        }, 'titleCalc')

    gsap.timeline({
        paused: true
    })

    ScrollTrigger.create({
        animation: animateCalc,
        trigger: ".calculator-land",
        start: "top +=200",
        end: 'bottom bottom',
        pin: true,
        scrub: false,
        id: '.calculator-land',
        smoothChildTiming: true,
        invalidateOnRefresh: true

    })

    tl.scrollTrigger.refresh();
}
