// import gsap from "gsap";
// import {ScrollTrigger} from "gsap/ScrollTrigger";
// import {scrollingAbout} from "./AboutScroll";
//
//
// export function paralax() {
//
// gsap.registerPlugin(ScrollTrigger)
//     const tl = gsap.timeline()
//     tl.fromTo(['.nav','.app_back_transparent', '.header-land'], {
//         yPercent: 0,
//         opacity: 1,
//
//     }, {
//         yPercent: -100,
//         opacity: 1,
//         duration: 2,
//     })
//         .fromTo('.about-view', {yPercent: 0}, {
//             yPercent:-80,
//             duration: 1,
//             onComplete: ()=> {
//                 tl.scrollTrigger.refresh()
//                 scrollingAbout()
//             }
//         })
//     ScrollTrigger.create({
//         animation: tl,
//         trigger: '.app-back',
//         start: 'top top',
//         end: '+=1000',
//         scrub: false,
//         pin: true
//     })
// }
