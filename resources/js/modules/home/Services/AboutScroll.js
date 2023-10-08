import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function scrollingAbout() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()

    tl.addLabel('about')
    let animation = tl
        .fromTo(['.about_item_card', '.about_item_title'], {opacity: 0}, {
            opacity: 1,
            duration: 2
        })
        .fromTo(['.about_item_card', '.about_item_title'], {opacity: 1, yPercent: 0}, {
            opacity: 0,
            yPercent: -100,
            duration: 1,
        })
        .fromTo('.about_item_title-two', {opacity: 0, yPercent: 50}, {
            opacity: 1,
            yPercent: 0,
            duration: 1.5
        }, '<0.8')
        .fromTo('.about_item_card-two', {opacity: 0, yPercent: 100}, {
            opacity: 1,
            yPercent: 0,
            duration: 1.7
        }, '>-0.7')

    gsap.timeline({
        paused: true
    })

    ScrollTrigger.create({
        animation: animation,
        trigger: ".about-view",
        start: "top top",
        end: '+=1700',
        pin: true,
        scrub: 1,
        id: '.about-view',
        smoothChildTiming: true,
        // onUpdate: self => {
        //     console.log(self.progress)
        // }
    })

}
