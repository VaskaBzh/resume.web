import * as d3 from "d3";

export class GraphListenersService {
    mouseMoveListener = null;
    mouseLeaveListener = null;
    touchStartListener = null;
    touchMoveListener = null;
    touchLeaveListener = null;

    setSvgMouseEvents(element, callbackResolve, callbackReject) {
        this.touchMoveListener = element.addEventListener(
            "touchstart",
            (event) => {
                const mouseX =
                    event.touches[0].clientX -
                    event.target.getBoundingClientRect().left;

                callbackResolve(event, mouseX);
            }
        );

        this.mouseMoveListener = element.addEventListener(
            "mousemove",
            (event) => {
                const mouseX = d3.pointer(event)[0];

                callbackResolve(event, mouseX);
            }
        );
        this.touchStartListener = element.addEventListener(
            "touchmove",
            (event) => {
                const mouseX =
                    event.touches[0].clientX -
                    event.target.getBoundingClientRect().left;

                callbackResolve(event, mouseX);
            }
        );

        this.mouseLeaveListener = element.addEventListener("mouseleave", () =>
            callbackReject()
        );
        this.touchLeaveListener = element.addEventListener("touchend", () =>
            callbackReject()
        );

        return this;
    }

    dropSvgMouseEvents() {
        this.mouseMoveListener = null;
        this.mouseLeaveListener = null;

        this.touchStartListener = null;
        this.touchMoveListener = null;
        this.touchLeaveListener = null;
    }
}
