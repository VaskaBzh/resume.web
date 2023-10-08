import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function animatedCalcView() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()
    tl.addLabel('titleCalc')
    let animateCalc = tl
        .fromTo('.calculator-land_title_base', {opacity: 0, xPercent: -50}, {
            opacity: 1,

            xPercent: 0
        }, 'titleCalc')
        .fromTo('.calculator-land_title_one', {opacity: 0, xPercent: 50}, {
            opacity: 1,
            duration: 1,
            xPercent: 0
        }, 'titleCalc')
        .fromTo('.calculator-land_title_two', {opacity: 0, xPercent: -50}, {
            opacity: 1,

            xPercent: 0
        }, 'titleCalc')
        .fromTo('.calculator-land_title_three', {opacity: 0, xPercent: 50}, {
            opacity: 1,

            xPercent: 0
        }, 'titleCalc')
        .fromTo('.calculator-land_title_four', {opacity: 0, xPercent: -50}, {
            opacity: 1,
            xPercent: 0
        }, 'titleCalc')

    let animateCalcTwo = tl
        .fromTo('.calculator-land_subtitle', {opacity: 0}, {
            opacity: 1
        })
    ScrollTrigger.create({
        animation: animateCalc,
        trigger: ".calculator-land",
        start: "top +=300",
        end: 'center center',
        pin: true,
        scrub: 1,
        id: '.calculator-land',
        markers: true,
        smoothChildTiming: true,
        onComplete: () => {
            ScrollTrigger.create({
                animation: animateCalcTwo,
                trigger: ".calculator-land",
                start: "top top",
                end: '+=1700',
                pin: true,
                scrub: 1,
                id: '.calculator-land',
                markers: true,
                smoothChildTiming: true,
            })
        }
    })


}
