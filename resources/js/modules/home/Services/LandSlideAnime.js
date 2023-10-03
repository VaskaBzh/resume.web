import { gsap } from "gsap";


export function slideMobileView() {
    const titleBlocks = document.querySelectorAll(".mobile-view_item")
    const imageBlocks = document.querySelectorAll('.mobile-view_image')

    const slideNext = document.querySelector('.next')

    const slidePrev = document.querySelector('.prev')

    let indexBlock = 0;


    function isShowSlide() {
        titleBlocks[indexBlock].classList.add('active')

        imageBlocks[indexBlock].classList.add('active')
    }

    function isCloseSlide() {
        titleBlocks[indexBlock].classList.remove('active')

        imageBlocks[indexBlock].classList.remove('active')
    }


    function nextSlide() {

        gsap.fromTo(imageBlocks[indexBlock].children, {opacity: 1}, {
            opacity: 1,
            xPercent: 100,
            duration: 0,
            stagger: { // wrap advanced options in an object
                amount: 0,
                each: 0,
                from: "center",
                grid: "auto",
                ease: "power2.inOut",
                repeat: -1 // Repeats immediately, not waiting for the other staggered animations to finish
            }
        })

        gsap.fromTo([titleBlocks[indexBlock].children[0]], {opacity: 1}, {
            opacity: 0,
            duration: .5,
            xPercent: 10
        })

        gsap.fromTo(titleBlocks[indexBlock].children[1], {opacity: 1}, {
            opacity: 0,
            duration: .5,
            xPercent: 10
        }).then(()=> {
            isCloseSlide()

            indexBlock++

            if (indexBlock > titleBlocks.length - 1 && indexBlock > imageBlocks.length - 1) {
                indexBlock = 0
            }

            isShowSlide()

            gsap.fromTo(imageBlocks[indexBlock].children, {opacity: 1, xPercent:-100}, {
                opacity: 1,
                xPercent: 0,
                duration: 0,
                stagger: { // wrap advanced options in an object
                    amount: 0,
                    each: 0,
                    from: "center",
                    grid: "auto",
                    ease: "power2.inOut",
                    repeat: -1 // Repeats immediately, not waiting for the other staggered animations to finish
                }
            })


            gsap.fromTo(titleBlocks[indexBlock].children[0], {opacity: 0, xPercent:-10}, {
                opacity: 1,
                xPercent: 0,
                duration: .5,
            })


            gsap.fromTo(titleBlocks[indexBlock].children[1], {opacity: 0, xPercent:-10}, {
                opacity: 1,
                xPercent: 0,
                duration: .5,
            })
        })

    }



    function previousSlide() {

        gsap.fromTo(imageBlocks[indexBlock].children,{opacity:1}, {
            opacity: 1,
            xPercent: -100,
            duration: 0,
            stagger: { // wrap advanced options in an object
                amount: 0,
                each: 0,
                from: "center",
                grid: "auto",
                ease: "power2.inOut",
                repeat: -1 // Repeats immediately, not waiting for the other staggered animations to finish
            }
        })


        gsap.fromTo([titleBlocks[indexBlock].children[0]], {opacity: 1}, {
            opacity: 0,
            duration: .5,
            xPercent: -10
        })


        gsap.fromTo(titleBlocks[indexBlock].children[1],{opacity:1}, {
            opacity: 0,
            duration: .5,
            xPercent: -10
        }).then(()=> {
            isCloseSlide()

            indexBlock--

            if (indexBlock < 0 && indexBlock < 0) {
                indexBlock = titleBlocks.length - 1
            }

            isShowSlide()

            gsap.fromTo(imageBlocks[indexBlock].children, {opacity: 1, xPercent:10}, {
                opacity: 1,
                xPercent: 0,
                duration: 0,
                stagger: { // wrap advanced options in an object
                    amount: 0,
                    each: 0,
                    from: "center",
                    grid: "auto",
                    ease: "power2.inOut",
                    repeat: -1 // Repeats immediately, not waiting for the other staggered animations to finish
                }
            })

            gsap.fromTo(titleBlocks[indexBlock].children[0], {opacity: 0, xPercent: 10}, {
                opacity: 1,
                xPercent: 0,
                duration: .5,
            })

            gsap.fromTo(titleBlocks[indexBlock].children[1], {opacity: 0, xPercent: 10}, {
                opacity: 1,
                xPercent: 0,
                duration: .5,

            })
        })








    }


    slideNext.addEventListener('click', nextSlide)
    slidePrev.addEventListener('click', previousSlide)
}


