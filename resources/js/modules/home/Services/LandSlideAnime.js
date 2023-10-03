import { gsap } from "gsap";


export function slideMobileView() {
    const titleBlocks = document.querySelectorAll(".mobile-view_item")
    const imageBlocks = document.querySelectorAll('.mobile-view_image')


    const slideNext = document.querySelector('.next')

    const slidePrev = document.querySelector('.prev')

    let indexBlock = 0;

    let clickButton = null

    function isShowSlide() {
        titleBlocks[indexBlock].classList.add('active-animation')
        titleBlocks[indexBlock].classList.add('active')

        imageBlocks[indexBlock].classList.add('active-animation')
        imageBlocks[indexBlock].classList.add('active')
    }

    function isCloseSlide() {
        titleBlocks[indexBlock].classList.remove('active')

        imageBlocks[indexBlock].classList.remove('active')

    }


    function nextSlide() {

        isCloseSlide()

        indexBlock++

        if (indexBlock > titleBlocks.length - 1 && indexBlock > imageBlocks.length - 1) {
            indexBlock = 0
        }

        isShowSlide()
    }

    function previousSlide() {

        isCloseSlide()

        indexBlock--

        if (indexBlock < 0 && indexBlock < 0) {
            indexBlock = titleBlocks.length - 1
        }

        isShowSlide()
    }


    slideNext.addEventListener('click', (e) => {
        clickButton = e.target
        nextSlide()
    })
    slidePrev.addEventListener('click', (e) => {
        clickButton = e.target
        previousSlide()
    })
}


