import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import LocomotiveScroll from "locomotive-scroll";
gsap.registerPlugin(ScrollTrigger)

export function animatedScroll () {
    ScrollTrigger.normalizeScroll(true)

    gsap.to(('.security-view_item'), {
        duration: 3,
        scrollTrigger: {
            trigger: '.security-view__wrapper',
            start: 'top top',
            end: 'bottom bottom',
            scrub: true,
            pin: '.security-view_right',
            pinSpacing: false,
            marker: true

        }
    })
}


export function scroolingHeader() {
   let loco = new LocomotiveScroll({
       el: document.querySelector('[data-scroll-container]')
       smooth: {
           mobileToDesktop: true,
           tablet: true
       }
   })
    console.log(loco)

}


