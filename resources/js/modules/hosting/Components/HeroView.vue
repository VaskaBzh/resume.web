<template>
    <article class="article-hosting first-text hosting__section" ref="view">
        <div class="hosting__content">
            <span class="text-on">{{ $t("title[0]") }}</span>
            <span class="text-fifty">{{ $t("title[1]") }} <br /></span>
            <span class="text-increase">{{ $t("title[2]") }} <br /></span>
            <span class="text-income">{{ $t("title[3]") }} <br /></span>
            <span class="text-cvt">{{ $t("title[4]") }}</span>
        </div>
        <landing-button class="get-consultation"
            ><template v-slot:text>{{ $t("button") }}</template>
        </landing-button>
    </article>
</template>

<script>
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";
export default {
    name: "hero-view",
    i18n: {
        sharedMessages: HostingMessage,
    },
    components: { LandingButton },
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
                        window.innerHeight >= 900
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
                        window.innerHeight >= 900
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
.hosting__content {
    max-width: 607px;
    width: 100%;
    max-height: 317px;
    color: var(--gray-1100, #f5faff);
    font-feature-settings: "clig" off, "liga" off;
    font-family: Unbounded, serif;
    font-size: clamp(44px, 7vw, 24px);
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
}
.text-income {
    display: flex;
    align-items: end;
    justify-content: end;
}
.text-fifty {
    font-size: clamp(156px, 11vw, 60px);
}
.get-consultation {
    margin-top: clamp(70px, 5vw, 50px);
    width: 100%;
    max-width: 534px;
}
@media (max-width: 768px) {
    .hosting__content {
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        max-width: 400px;
    }
    .text-fifty {
        font-size: 106px;
    }
}
@media (max-width: 450px) {
    .hosting__content {
        font-size: 22px;
        max-width: 244px;
        height: auto;
    }
    .text-fifty {
        font-size: 60px;
    }
}
</style>
