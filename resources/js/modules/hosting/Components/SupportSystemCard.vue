<template>
    <div class="support__section support__section-wrap" ref="view">
        <div class="system-card-inf">
            <p class="system-card-title">{{ $t("support.title") }}</p>
            <p class="system-card-text">{{ $t("support.text") }}</p>
        </div>
        <div class="system-card-img">
            <img
                src="../assets/img/Mockup-iphone.png"
                class="img-iphone img-system"
            />
            <img
                src="../assets/img/Mockup-support.png"
                class="img-support img-system"
                v-if="$i18n.locale == 'ru'"
            />
            <img
                src="../assets/img/Mockup-support-en.png"
                class="img-support img-system"
                v-else
            />
        </div>
    </div>
</template>
<script>
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";

export default {
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
        handleTouchStart(e) {
            this.startY = e.touches[0].clientY;
        },
        handleTouchMove(e) {
            this.touchY = e.touches[0].clientY;
            this.handleWheel();
        },
        handleWheel(e) {
            if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    !this.validScroll
                ) {
                    this.$refs.view.style.transform =
                        window.innerHeight >= 900 || window.innerWidth < 991
                            ? `translateY(-${
                                  this.$refs.view.offsetHeight -
                                  document.scrollingElement.clientHeight
                              }px)`
                            : `translateY(-${
                                  this.$refs.view.offsetHeight -
                                  document.scrollingElement.clientHeight
                              }px) scale(0.8)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    this.validScroll
                ) {
                    this.$refs.view.style.transform =
                        window.innerHeight >= 900 || window.innerWidth < 991
                            ? `translateY(0px)`
                            : `translateY(0px) scale(0.8)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
                this.$refs.view.focus();
                this.$refs.view.addEventListener("wheel", this.handleWheel);
                this.$refs.view.addEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.addEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
                this.$refs.view.removeEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.removeEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
    },
    watch: {
        start(newStartState) {
            if (newStartState) {
                this.scroll();
            } else {
                this.remove();
            }
        },
    },
    mounted() {
        this.scroll();
    },
    unmounted() {
        this.remove();
    },
};
</script>
<style scoped>
.system-card-inf {
    width: 399px;
    margin-bottom: 50px;
}
.system-card-title {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}
.system-card-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}
.system-card-img {
    position: relative;
    width: 408px;
    height: 722px;
}
.img-system {
    position: absolute;
}
.img-support {
    left: 42px;
    top: 12px;
}
.img-iphone {
    z-index: 10;
}
@media (max-width: 768px) {
    .system-card-title {
        font-size: 24px;
    }
}
@media (max-width: 460px) {
    .system-card-title {
        font-size: 18px;
    }
    .system-card-text {
        font-size: 14px;
    }
    .system-card-inf {
        width: 244px;
    }
    .system-card-img,
    .img-iphone {
        width: 281px;
        height: 497px;
    }
    .img-support {
        width: 224px;
        height: 482px;
        left: 29px;
        top: 9px;
    }
}
</style>
