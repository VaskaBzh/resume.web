import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";

export function animateMissionView() {
    gsap.registerPlugin(ScrollTrigger)

    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: '.mission-view',
            start: 'top top',
            end: "+=2300",
            pin: true,
            scrub: 2,
            markers: true,
            id: '.mission-view',
        },
        duration: 1.5
    })
    gsap.timeline({
        paused: true
    })
    tl.addLabel('mission-one')

    tl.fromTo('.mission-view_item_title', {opacity: 1, yPercent: -100}, {
        opacity: 0,
        yPercent: 100,
        callbackScope: function onComplete() {
            gsap.to('.mission-view_item_title', {
                yPercent: -100,
                opacity: 0,

            })
        }

    }, 'mission-one')
    tl.fromTo(['.mission-view_item_title-two', '.mission-view_item_title-three'], {opacity: 1, yPercent: -100}, {
        opacity: 1,
        yPercent: 0,
    }, 'mission-one')
    tl.fromTo('.mission-view_item_title', {opacity: 0, yPercent: -100}, {
        yPercent: 0,
        opacity: 1,
        'webkitTextStroke': '0.5px rgb(255,255,255, 0.5)',
        'webkitTextFillColor': 'transparent',
        'webkitBackgroundClip': 'text',
        color: 'transparent'
    }, 'mission-one+=0.9')
        .fromTo('.mission-view_item_text', {opacity: 0}, {
            opacity: 1
        }, 'mission-one+=1')

    tl.fromTo('.mission-view_item_title-two', {yPercent: 0}, {
        yPercent: 100
    })

    tl.fromTo('.mission-view_item_transparent-two', {opacity: 0, yPercent: 0}, {
        yPercent: 100,
        opacity: 1
    }, '>-0.5')

    tl.fromTo('.mission-view_item_title', {yPercent: 0, opacity: 1}, {
        opacity: 0,
        yPercent: -100
    }, '>-0.5')

        .fromTo('.mission-view_item_text', {opacity: 1}, {
            opacity: 0
        }, '>-0.5')
        .fromTo('.mission-view_item_text-two', {opacity: 0}, {
            opacity: 1
        }, '>-0.5')


    tl.fromTo('.mission-view_item_transparent-one', {opacity: 0, yPercent: 0}, {
        yPercent: -100,
        opacity: 1
    }, '>-0.5')
    tl.fromTo('.mission-view_item_title-three', {yPercent: 0, opacity: 1}, {
        opacity: 0,
        yPercent: 100
    })
    tl.fromTo('.mission-view_item_transparent-three', {yPercent: 0, opacity: 0}, {
        opacity: 1,
        yPercent: 100
    }, '>-0.5')
        .fromTo('.mission-view_item_text-two', {opacity: 1}, {
            opacity: 0
        }, '>-0.5')
        .fromTo('.mission-view_item_text-three', {opacity: 0}, {
            opacity: 1
        }, '>-0.5')
    tl.fromTo('.mission-view_item_transparent-two', {yPercent: 100, opacity: 1}, {
        opacity: 1,
        yPercent: 0
    }, '>-0.5')
    tl.fromTo('.mission-view_item_title-two', {yPercent: 100, opacity: 1}, {
        opacity: 1,
        yPercent: 0
    }, '>-0.5')


    // tl.fromTo('.mission-view_item_title-three', {opacity: 0}, {
    //     opacity: 1
    // }, )
    tl.scrollTrigger.refresh()

}
