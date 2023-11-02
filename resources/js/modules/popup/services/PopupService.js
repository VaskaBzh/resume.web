import { ref } from "vue";
import anime from "animejs";


export class PopupService {
    constructor(id, emit) {
        this.isOpened = ref(false);
        this.id = id;
        this.emit = emit;
        this.popupContentHtml = null;
        this.popupBlockHtml = null;
        this.popupLogoHtml = null;
        this.clicked = ref(false);

        this.animate = null;

        this.pageContainer = document.querySelector(".page-container");
    }

    setPopupContentHtml(newPopupContentHtml) {
        this.popupContentHtml = newPopupContentHtml;
    }

    setPopupBlockHtml(newPopupBlockHtml) {
        this.popupBlockHtml = newPopupBlockHtml;
    }

    setPopupLogoHtml(newPopupLogoHtml) {
        this.popupLogoHtml = newPopupLogoHtml;
    }

    setBodyHidden() {
        if (this.pageContainer) {
            this.pageContainer.style.overflowY = "hidden";
        }
    }

    setBodyScroll() {
        if (this.pageContainer) {
            this.pageContainer.removeAttribute("style");
        }
    }

    dropAnimate() {
        if (this.animate) {
            this.animate.remove(this.popupContentHtml);
            this.animate.remove(this.popupBlockHtml);
            this.animate.remove(this.popupLogoHtml);
        }
    }

    animateOnUpdate() {
        this.animate = anime({
            targets: this.popupBlockHtml,
            height: `${this.popupContentHtml.scrollHeight + 64}px`,
            easing: "easeInCubic",
            duration: 500,
            complete: () => {
                this.dropAnimate();
            },
        });
    }

    closeAnimate() {
        this.dropAnimate();

        this.animate = anime({
            targets: this.popupContentHtml,
            opacity: "0",
            easing: "easeInCubic",
            duration: 300,
        });

        this.animate = anime({
            targets: this.popupBlockHtml,
            height: "122px",
            width: "280px",
            translateY: 120,
            easing: "easeInCubic",
            duration: 300,
        });

        this.animate = anime({
            targets: this.popupLogoHtml,
            opacity: "1",
            easing: "easeInCubic",
            duration: 300,
        });
    }

    animateOpacity() {
        this.animate = anime({
            targets: this.popupContentHtml,
            opacity: 1,
            easing: "easeOutCubic",
            duration: 150,
            complete: () => {
                this.dropAnimate();
            },
        });
    }

    animateLogoOpacity() {
        this.animate = anime({
            targets: this.popupLogoHtml,
            opacity: 0,
            easing: "easeInCubic",
            duration: 150,
            complete: () => {
                this.dropAnimate();

                this.animateOpacity();
            },
        });
    }

    animateHeight() {
        this.animate = anime({
            targets: this.popupBlockHtml,
            height: ()=> {
                return `${this.popupContentHtml.scrollHeight + 64}px`
            },
            easing: "easeInCubic",
            duration: 350,
            complete: () => {
                this.dropAnimate();

                this.animateLogoOpacity();
            },
        });
    }

    animateWidth() {
        this.animate = anime({
            targets: this.popupBlockHtml,
            width: "560px",
            easing: "easeInOutCubic",
            duration: 250,
            complete: () => {
                this.dropAnimate();

                this.animateHeight();
            },
        });
    }

    animateTransform() {
        this.animate = anime({
            targets: this.popupBlockHtml,
            translateY: 0,
            easing: "easeInCubic",
            duration: 150,
            complete: () => {
                this.dropAnimate();

                this.animateWidth();
            },
        });
    }

    animateContent() {
        this.animateTransform();
    }

    popupOpen = () => {
        this.emit("opened");
        this.animateContent();
        this.isOpened.value = true;

        this.pageContainer = document.querySelector(".page-container");

        this.setBodyHidden();
    };

    popupClose = () => {
        this.emit("closed");
        this.closeAnimate();
        this.isOpened.value = false;

        this.pageContainer = document.querySelector(".page-container");

        this.setBodyScroll();
    };

    clickClosed = (e) => {
        if (!this.isOpened.value) {
            if (e.target.closest(`[data-popup="#${this.id}"]`)) {
                e.preventDefault();
                this.popupOpen();
            }
        } else if (
            !e.target.closest(".popup__content") &&
            !e.target.closest(".un-click")
        ) {
            this.popupClose();
        }
    };

    keyClosed = (e) => {
        if (e.keyCode === 27) this.popupClose(e);
    };

    initFunc() {
        document.addEventListener("mousedown", this.clickClosed, true);
        document.addEventListener("keydown", this.keyClosed);
    }

    destroyFunc() {
        document.removeEventListener("mousedown", this.clickClosed, true);
        document.removeEventListener("keydown", this.keyClosed);

        this.popupClose();
    }
}
