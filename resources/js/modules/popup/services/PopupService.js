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

        this.animate = null;
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

    dropAnimate() {
        this.animate.remove(this.popupContentHtml);
        this.animate.remove(this.popupBlockHtml);
        this.animate.remove(this.popupLogoHtml);
    }

    closeAnimate() {
        this.dropAnimate();

        this.animate = anime({
            targets: this.popupContentHtml,
            opacity: '0',
            easing: 'easeInCubic',
            duration: 300,
        });

        this.animate = anime({
            targets: this.popupBlockHtml,
            height: '122px',
            width: '280px',
            translateY: 120,
            easing: 'easeInCubic',
            duration: 300,
        });

        this.animate = anime({
            targets: this.popupLogoHtml,
            opacity: '1',
            easing: 'easeInCubic',
            duration: 300,
        });
    }

    animateOpacity() {
        this.animate = anime({
            targets: this.popupContentHtml,
            opacity: 1,
            easing: 'easeOutCubic',
            duration: 300,
            complete: () => {
                this.dropAnimate();
            },
        });
    }

    animateLogoOpacity() {
        this.animate = anime({
            targets: this.popupLogoHtml,
            opacity: 0,
            easing: 'easeInCubic',
            duration: 300,
            complete: () => {
                this.dropAnimate();

                this.animateOpacity()
            },
        });
    }

    animateHeight() {
        this.animate = anime({
            targets: this.popupBlockHtml,
            height: `${this.popupContentHtml.scrollHeight + 32}px`,
            easing: 'easeInCubic',
            duration: 500,
            complete: () => {
                this.dropAnimate();

                this.animateLogoOpacity();
            },
        });
    }

    animateWidth() {
        this.animate = anime({
            targets: this.popupBlockHtml,
            width: '560px',
            easing: 'easeInOutCubic',
            duration: 400,
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
            easing: 'easeInCubic',
            duration: 300,
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
    }

    popupClose = () => {
        this.emit("closed");
        this.closeAnimate();
        this.isOpened.value = false;
    }

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
    }

    keyClosed = (e) => {
        if (e.keyCode === 27) this.popupClose(e);
    }

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
