import {gsap} from "gsap";


export function animateHeader() {

    const sectionPoolTwo = document.querySelector('.app_back_transparent_two')

    const sectionPoolOne = document.querySelector('.app_back_transparent_one')


    const elemExpertOne = document.querySelector('.header-land_title_expert-one')
    const elemExpertTwo = document.querySelector('.header-land_title_expert-two')

    const elemMiningOne = document.querySelector('.header-land_title_mining-one')
    const elemMiningTwo = document.querySelector('.header-land_title_mining-two')

    const elemApproach = document.querySelector('.header-land_title_approach')
    const bitcoin = document.querySelector('.header-land_title_text')
    const headerText = document.querySelector('.header-land_title_span')
    const elemNav = document.querySelector('.nav')
    const buttonHeader = document.querySelector('.header-land_btn')

    let tl = new gsap.timeline()

    tl.fromTo([sectionPoolOne, sectionPoolTwo], {yPercent: 100}, {
        yPercent: 0,
        duration: 1.2
    })

    tl.fromTo([elemExpertOne, elemMiningOne], {opacity: 0, yPercent: -100}, {
        opacity: 1,
        yPercent: 110,
        duration: 1.2,
        callbackScope: function onComplete() {
            tl.fromTo([elemExpertOne, elemMiningOne], {opacity: 0}, {
                opacity: 0,
                yPercent: -100
            })
        }


    })
    tl.addLabel('my-label', 2)

    tl.fromTo([elemExpertOne, elemMiningOne], {opacity: 0, yPercent: -100}, {
        opacity: 1,
        yPercent: 0,
        duration: 1.2,
    }, 'my-label')

    tl.fromTo([elemExpertTwo, elemMiningTwo, elemApproach], {opacity: 0, yPercent: 100}, {
        opacity: 1,
        yPercent: 0,
        duration: 1.2,
    }, 'my-label')

    tl.fromTo(bitcoin, {opacity: 0, yPercent: 100}, {
        opacity: 1,
        yPercent: 0,
        duration: 1.2,
    }, 'my-label')
    tl.fromTo(headerText, {opacity: 1}, {
        opacity: 1,
        duration: 2,
    }, 'my-label+=0.5')
    tl.to(elemNav, {
        opacity: 1,
        duration: 1,
    }, 'my-label+=0.5')

    tl.to([sectionPoolOne, sectionPoolTwo], {
        webkitTextFillColor: 'transparent',
        duration: 1,
    }, 'my-label+=1')
    tl.to(buttonHeader, {
        opacity: 1
    }, 'my-label+=2')

}

