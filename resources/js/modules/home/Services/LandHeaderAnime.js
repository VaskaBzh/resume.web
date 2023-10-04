import {gsap} from "gsap";


export function animateHeader() {
    const sectionPoolTwo = document.querySelector('.app_back_transparent_two')
    const sectionPoolOne = document.querySelector('.app_back_transparent_one')


    gsap.fromTo([sectionPoolOne, sectionPoolTwo], {yPercent: 100}, {
        yPercent: 0,
        duration: 1

    }).then(() => {
        gsap.to([sectionPoolOne, sectionPoolTwo], {
            webkitTextFillColor: 'transparent'
        })
    })
}

