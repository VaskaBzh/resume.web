<template>
    <div class="mobile-view mobile__section mobile__section-wrap" ref="view">
        <div class="mobile-view__block">
            <landing-headline class="mobile-view__title"
                >{{ $t("mobile_app.button") }}
            </landing-headline>
            <div class="mobile-view__wrapper">
                <Swiper
                    class="mobile-view_inner"
                    :modules="[Controller, Navigation, Pagination]"
                    :controller="{ control: controllerSlide }"
                    :set-wrapper-size="true"
                    :loop="true"
                    :pagination="{clickable:true,
                    el: '.pagination_bulets',
                    type: 'custom',
                    bulletClass: 'bulets-one',
                    bulletActiveClass:'active-bullet',}"
                    :navigation="{nextEl: '.next', prevEl: '.prev'}"
                    :space-between="0"
                >
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.title") }}
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Хороший> мониторинг и эффективное управление
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Четкий мониторинг и эффективное управление
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Прекрасный мониторинг и эффективное управление
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            Офигенный мониторинг и эффективное управление
                        </landing-title>
                    </swiper-slide>
                    <div class="mobile-view_prev_next">
                        <button-blue
                            class="mobile-view_prev prev"
                            v-if="viewportWidth>1200"
                        ></button-blue>
                        <button-blue
                            class="mobile-view_prev next"
                            v-if="viewportWidth>1200"
                        ></button-blue>
                    </div>
                </Swiper>
                <div class="mobile-view__content">
                    <img
                        class="iphone"
                        src="../../../../../assets/img/iPhone-14.png"
                        alt=""
                    />
                    <Swiper
                        class="mobile-view_swiper-picture"
                        :loop="true"
                        :modules="[Controller, Navigation, Pagination]"
                        @swiper="setControlledSwiper"
                    >
                        <swiper-slide class="mobile-view_image active">
                            <img
                                src="../../../../../assets/img/iphone-14-screen1.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-sreen2.png.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-screen3.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-screen4.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <img
                                src="../../../../../assets/img/iphone-14-screen1.png"
                                alt=""
                            />
                        </swiper-slide>
                    </Swiper>
                </div>
                <div class="pagination_bulets" v-if="viewportWidth < 1200">
                    <div class="bulets-one"></div>
                    <div class="bulets-one"></div>
                    <div class="bulets-one"></div>
                    <div class="bulets-one"></div>
                    <div class="bulets-one"></div>
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
import { Swiper, SwiperSlide } from "swiper/vue";
import { Controller,Navigation, Pagination } from "swiper";
import { ref } from "vue";
import {mapGetters} from "vuex";

export default {
    name: "AppMobileView",
    components: {
        LandingHeadline,
        LogoRunIcon,
        LandingTitle,
        ButtonBlue,
        Swiper,
        SwiperSlide,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },

    setup() {
        const controllerSlide = ref(null);

        // onMounted(()=> {
        //     const swiper = new Swiper()
        //     swiper.nextEl = '.next'
        //         swiper.prevEl = '.prev'
        // })
        const setControlledSwiper = (swiper) => {
            controllerSlide.value = swiper;
        };

        return {
            Controller,
            Navigation,
            Pagination,
            controllerSlide,
            setControlledSwiper,
        };
    },

    data() {
        return {
            validScroll: false,
            validHalfScroll: false,
            startY: null,
            touchY: null,
        };
    },
    props: {
        start: Boolean,
    },

    computed: {
        ...mapGetters([
            "viewportWidth"
        ])
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
                    !this.validHalfScroll
                ) {
                    this.$refs.view.style.transform = `translateY(-${
                        (this.$refs.view.offsetHeight -
                            document.scrollingElement.clientHeight) /
                        2
                    }px)`;

                    this.validHalfScroll = true;
                } else if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    !this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

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
                    this.validHalfScroll
                ) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validHalfScroll = false;
                } else if (
                    this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight >
                        20 &&
                    this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(-${
                        (this.$refs.view.offsetHeight -
                            document.scrollingElement.clientHeight) /
                        2
                    }px)`;

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
        setTimeout(this.scroll, 500);
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

    &__btn {
        @media (max-width: 1600px) {
            margin-top: 20px;
        }
    }

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

        @media (max-width: 1600px) {
            flex-flow: column nowrap;
            justify-content: flex-start;
            gap: 30px;
        }
    }

    &_inner {
        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
        align-self: center;
        max-width: 557px;
        height: auto;
        gap: 0;
        margin: 0 auto 0 0;

        @media (max-width: 1600px) {
            margin: 0 auto;
            max-width: 80%;
        }

        @media (max-width: 768px) {
            margin: 0 auto;
            max-width: 100%;
        }
    }

    &__content {
        max-width: 429px;
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

        @media (max-width: 1600px) {
            max-width: 330px;
            height: 655px;
            padding: 15px;
            max-height: 655px;
            margin: 0 auto;
            position: relative;
            display: flex;
            left: 0;
            top: 0;
            transform: unset;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            max-width: 70%;
            height: 430px;
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
        border-radius: 50px;

        @media (max-width: 768px) {
            border-radius: 25px;
            max-width: 195px;
        }
    }

    &_item {
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        @media (min-width: 767.98px) {
            margin-bottom: 60px;
        }
    }

    &_subtitle {
        padding: 32px 32px 0 32px;

        @media (max-width: 1600px) {
            text-align: center;
        }
        @media (max-width: 768px) {
            text-align: center;
            padding: 0;
            font-size: 14px;
        }

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

        @media (max-width: 768px) {
            border-radius: 25px;
        }

        img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 50px;

            @media (max-width: 768px) {
                border-radius: 20px;
            }
        }

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

        @media (max-width: 1600.98px) {
            justify-content: center;
            order: -1;
        }
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

//.active {
//    display: flex;
//    opacity: 1;
//    visibility: visible;
//}

.mobile-view_inner .swiper-wrapper {
    gap: 0;
}

.pagination_bulets {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.bulets-one {
    width: 10px;
    height: 10px;
    background: #43474E;
    border-radius: 50%;
}

.active-bullet {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #2E90FA;
}

</style>
