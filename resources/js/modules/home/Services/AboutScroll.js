import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function scrollingAbout() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()

    tl.addLabel('about')
    let animation = tl
        .fromTo(['.about_item_card', '.about_item_title'], {opacity: 1}, {
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
        .fromTo('.about_link', {opacity: 0, scale: 0, yPercent: 100, xPercent: 100}, {
            opacity: 1, scale: 1, yPercent: 0, xPercent: 0, duration: 2
        }, '>-0.2')

    gsap.timeline({
        paused: true
    })

    ScrollTrigger.create({
        animation: animation,
        trigger: ".about-view",
        start: "top top",
        end: '+=2000',
        pin: true,
        scrub: 3,
        id: '.about-view',
        smoothChildTiming: true,

    })

    tl.scrollTrigger.refresh();

}
