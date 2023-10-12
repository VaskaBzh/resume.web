import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";


export function paralaxLayot() {
    gsap.registerPlugin(ScrollTrigger)
    const go = ()=> {
        gsap.fromTo('.hero', {opacity: 1, yPercent: 0}, {opacity: 1, yPercent: -100, duration: 1})
        gsap.fromTo('.about__section', {position: 'relative', top: 0, opacity: 0}, {
            position: 'relative',
            top: () => {
                let aboutElemHeight = document.querySelector('.about__section').offsetHeight
                return -(aboutElemHeight-window.scrollY)
            },
            opacity: 1,
            duration: 2
        })
        console.log('ab')
    }

    const goBack = ()=> {
        gsap.fromTo('.hero', {opacity: 1, }, {opacity: 1, yPercent: 0, duration: 1})
        gsap.fromTo('.about__section', {position: 'relative', opacity: 0}, {
            position: 'relative',
            top: () => {
                let aboutElemHeight = document.querySelector('.about__section').offsetHeight
                return (aboutElemHeight-window.scrollY)
            },
            opacity: 1,
            duration: 2
        })
    }
    ScrollTrigger.create({
        trigger: '.layout__container',
        start: '+=200',
        end: '+=200 top',
        invalidateOnRefresh: true,
        scrub: 0.5,
        fastScrollEnd: true,
        markers: {
                    fontSize: '2rem'
                },
        smoothTouch: true,
        onLeave: () => {
            go()
        },
        onEnterBack: () => {
            goBack()

        },
    })
    // ScrollTrigger.refresh()
    // ScrollTrigger.create({
    //     invalidateOnRefresh: true,
    //     trigger: '.about__section',
    //     start: `+=300 top`,
    //     end:  'bottom bottom',
    //     markers: {
    //         fontSize: '2rem'
    //     },
    // })

    // animate.fromTo('.alculator__section', {y: '0'}, {
    //     y: '-100%',
    //     duration: 2
    // })
    // animate.fromTo('.miners__section', {y: '0'}, {
    //     y: '-100%',
    //     duration: 2
    // })
    // animate.fromTo('.cabinet__section', {y: '0'}, {
    //     y: '-100%',
    //     duration: 2
    // })
    // animate.fromTo('.security__section', {y: '0'}, {
    //     y: '-100%',
    //     duration: 2
    // })
    // animate.fromTo('.mobile__section', {y: '0'}, {
    //     y: '100%',
    //     duration: 2
    // })
    // animate.fromTo('.payments__section', {y: '0%'}, {
    //     y: '100%'
    // })
    // animate.fromTo('.mission-view', {y: '0%'}, {
    //     y: '100%'
    // })
    // animate.fromTo('.history__section', {x: '0%'}, {
    //     x: '100%'
    // })
    // animate.fromTo('.connect-withus', {x: '0%'}, {
    //     x: '100%'
    // })

    // ScrollTrigger.create({
    //     animation: animate,
    //     trigger: '.layout__container',
    //     start: '+=100 top',
    //     markers: {
    //         fontSize: '2rem'
    //     },
    //     toggleActions: 'restart none none none',
    //     scrub: false,
    //     end: 'bottom bottom',
    //     invalidateOnRefresh: true
    // })
}
