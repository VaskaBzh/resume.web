<template>
    <div class="mobile-view mobile__section mobile__section-wrap" ref="view">
        <div class="mobile-view__block">
            <landing-headline class="mobile-view__title"
                >{{ $t("mobile_app.button") }}
            </landing-headline>
            <div class="mobile-view__wrapper">
                <div class="mobile-view_inner">
                    <div class="mobile-view_item active">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.title") }}
                        </landing-title>
                    </div>
                    <div class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Хороший> мониторинг и эффективное управление
                        </landing-title>
                    </div>
                    <div class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Четкий мониторинг и эффективное управление
                        </landing-title>
                    </div>
                    <div class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Прекрасный мониторинг и эффективное управление
                        </landing-title>
                    </div>
                    <div class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Офигенный мониторинг и эффективное управление
                        </landing-title>
                    </div>
                    <div class="mobile-view_prev_next">
                        <button-blue
                            class="mobile-view_prev prev"
                        ></button-blue>
                        <button-blue
                            class="mobile-view_prev next"
                        ></button-blue>
                    </div>
                </div>
                <div class="mobile-view__content">
                    <img
                        class="iphone"
                        src="../../../../../assets/img/iPhone-14.png"
                        alt=""
                    />
                    <div class="mobile-view_swiper-picture">
                        <div class="mobile-view_image active">
                            <img
                                src="../../../../../assets/img/iphone-14-screen1.png"
                                alt=""
                            />
                        </div>
                        <div class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-sreen2.png.png"
                                alt=""
                            />
                        </div>
                        <div class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-screen3.png"
                                alt=""
                            />
                        </div>
                        <div class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-screen4.png"
                                alt=""
                            />
                        </div>
                        <div class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-screen1.png"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
                <button-blue class="mobile-view__btn"
                    >{{ $t("mobile_app.note") }}
                </button-blue>
            </div>
        </div>
        <div class="mobile-view__run">
            <logo-run-icon />
            <logo-run-icon />
            <logo-run-icon />
            <logo-run-icon />
            <logo-run-icon />
            <logo-run-icon />
            <logo-run-icon />
        </div>
    </div>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import LandingTitle from "../../../common/Components/UI/LandingTitle.vue";
import LogoRunIcon from "../../icons/LogoRunIcon.vue";
import LandingHeadline from "../../../common/Components/UI/LandingHeadline.vue";

export default {
    name: "AppMobileView",
    components: { LandingHeadline, LogoRunIcon, LandingTitle, ButtonBlue },
    i18n: {
        sharedMessages: HomeMessage,
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
                setTimeout(this.scroll, 300);
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
                setTimeout(this.scroll, 300);

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

<style scoped lang="scss">
.mobile-view {
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: space-evenly;
    padding-bottom: clamp(30px, 5vw, 70px);

    &__block {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    &__wrapper {
        display: flex;
        min-height: 100vh;
        flex-flow: row nowrap;
        justify-content: space-between;
        width: 100%;
        position: relative;
    }

    &_inner {
        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
        align-self: center;
        width: 25%;
    }

    &__content {
        height: 875px;
        position: absolute;
        padding: 15px;
        max-height: 875px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);

        img.iphone {
            width: 100%;
            position: absolute;
            height: 100%;
            object-fit: unset;
            left: 50%;
            z-index: 10;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    }

    &_swiper-picture {
        display: flex;
        flex-flow: row nowrap;
        align-items: flex-start;
        justify-content: center;
        height: 100%;
        position: relative;
        max-width: 479px;
    }

    &_item {
        display: none;
        flex-flow: column nowrap;
        align-items: center;
        opacity: 0;
        justify-content: center;
        gap: 30px;
        overflow: hidden;
        @media (min-width: 767.98px) {
            margin-bottom: 60px;
        }
    }

    &_subtitle {
        color: #f5faff;
        font-family: Unbounded, serif;
        font-size: 44px;
        font-style: normal;
        font-weight: 400;
        line-height: 120%;
        text-transform: uppercase;
        padding: 32px 32px 0 0;
    }

    &_image {
        width: 100%;
        height: 100%;
        max-width: 100%;
        margin: 0 auto;
        border-radius: 70px;
        overflow: hidden;
        z-index: 1;
        justify-content: center;
        display: none;

        svg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 70px;
        }
    }

    &_text {
        color: rgba(245, 250, 255, 0.7);
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans, serif;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        padding: 0 32px 32px 0;
    }

    &_prev_next {
        display: flex;
        width: 100%;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: flex-start;
        gap: 30px;
    }

    &__run {
        display: flex;
        height: 232px;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        gap: clamp(30px, 5vw, 50px);

        svg {
            height: clamp(66px, 50vw, 187px);
            width: clamp(357px, 50vw, 1012px);
            animation: animMarqueeRtl 7s infinite linear;

            @keyframes animMarqueeRtl {
                0% {
                    transform: translateX(0%);
                }
                100% {
                    transform: translateX(105%);
                }
            }
        }
    }
}

.active {
    display: flex;
    opacity: 1;
    visibility: visible;
}
</style>
