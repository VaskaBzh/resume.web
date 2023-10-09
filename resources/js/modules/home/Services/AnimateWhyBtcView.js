import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function animateWhyBtcView() {
    gsap.registerPlugin(ScrollTrigger)

    let tl = gsap.timeline()
    tl.addLabel('why-btc-title')
    let animateWhyBtc = tl
        .fromTo('.miners-info-view_subtitle_base', {opacity: 0, xPercent: 50}, {
            opacity: 1,
            xPercent: 0,
            duration: 1
        }, 'why-btc-title')
        .fromTo('.miners-info-view_subtitle_one', {opacity: 0, xPercent: -50}, {
            opacity: 1,
            xPercent: 0,
            duration: 1
        }, 'why-btc-title')
        .fromTo('.miners-info-view_subtitle_two', {opacity: 0, xPercent: 50}, {
            opacity: 1,
            xPercent: 0,
            duration: 1
        }, 'why-btc-title')
        .fromTo('.miners-info-view_subtitle_three', {opacity: 0, xPercent: -50}, {
            opacity: 1,
            xPercent: 0,
            duration: 1
        }, 'why-btc-title')
        .fromTo('.miners-info-view_item-one', {opacity: 0}, {
            opacity: 1,
            duration: 1
        }, '>-0.5')
        .fromTo('.miners-info-view_item-two', {opacity: 0}, {
            opacity: 1,
            duration: 1
        }, '>-0.5')
        .fromTo('.miners-info-view_item-three', {opacity: 0}, {
            opacity: 1,
            duration: 1
        }, '>-0.8')

    ScrollTrigger.create({
        animation: animateWhyBtc,
        trigger: '.miners-info-view',
        start: 'top top',
        end: '+=1000',
        pin: true,
        scrub: 1.5,
        id: '.miners-info-view'
    })
}
