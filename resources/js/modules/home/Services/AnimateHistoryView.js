import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";

export function animeteHistoryView() {
    gsap.registerPlugin(ScrollTrigger)

    const races = document.querySelector(".history-pool__items");
    console.log(races.offsetWidth)

    function getScrollAmount() {
        let racesWidth = races.scrollWidth;
        return -(racesWidth - window.innerWidth);
    }

    const tween = gsap.to(races, {
        x: getScrollAmount,
        duration: 3,
        ease: "none",
    });


    ScrollTrigger.create({
        trigger:".history-pool",
        start:"top top",
        end: () => `+=${getScrollAmount() * -1}`,
        pin:true,
        animation:tween,
        scrub:1,
        invalidateOnRefresh:true,
    })

}
