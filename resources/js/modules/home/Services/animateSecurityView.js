import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function animatedSecurityView() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()

    const animateSecurityView = tl
        .fromTo('.security-view_item_title', {opacity: 0}, {
            opacity: 1,
            duration: 1
        })
        .fromTo('.security-view_item_cards__text', {opacity: 0}, {
            opacity: 1,
            duration: 1
        }, '>-0.5')
        .fromTo(['.security-view_item_title', '.security-view_item_cards__text'], {opacity: 1, yPercent: 0}, {
            opacity: 0,
            yPercent: -60,
            duration: 1
        })
        .fromTo('.security-view_item_title-two', {opacity: 0, yPercent: 50}, {
            opacity: 1,
            yPercent: 0,
            duration: 1
        }, '>-0.5')
        .fromTo('.security-view_item_cards__text-two', {opacity: 0, yPercent: 50}, {
            opacity: 1,
            yPercent: 0,
            duration: 1
        }, '>-0.5')
        .fromTo(['.security-view_item_title-two', '.security-view_item_cards__text-two'], {opacity: 1, yPercent: 0}, {
            opacity: 0,
            yPercent: -60,
            duration: 1
        })
        .fromTo('.security-view_item_title-three', {opacity: 0, yPercent: 50}, {
            opacity: 1,
            yPercent: 0,
            duration: 1
        }, '>-0.5')
        .fromTo('.security-view_item_cards__text-three', {opacity: 0, yPercent: 50}, {
            opacity: 1,
            yPercent: 0,
            duration: 1
        }, '>-0.5')
        .fromTo('.security-view__wrapper', {opacity: 1}, {
            opacity: 0
        }, '>+1')


    gsap.timeline({
        paused: true
    })

    ScrollTrigger.create({
        animation: animateSecurityView,
        trigger: ".security-view",
        start: "top top",
        end: "+=1300",
        pin: true,
        scrub: 2,
        markers: true,
        pinSpacing: true,
        id: ".security-view",
        smoothChildTiming: true,
    })

    tl.scrollTrigger.refresh();
}
