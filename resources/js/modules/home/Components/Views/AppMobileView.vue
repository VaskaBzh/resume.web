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
                    :controller="{ control: secondSwiper }"
                    :set-wrapper-size="true"
                    :loop="true"
                    :pagination="{
                        clickable: true,
                        el: '.pagination_bulets',
                        type: 'bullets',
                    }"
                    :navigation="{ nextEl: '.next', prevEl: '.prev' }"
                    :space-between="0"
                    @swiper="setFirstSwiper"
                >
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.title") }}
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.slides[0]") }}
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.slides[1]") }}
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.slides[2]") }}
                        </landing-title>
                    </swiper-slide>
                    <swiper-slide class="mobile-view_item">
                        <landing-title tag="h3" class="mobile-view_subtitle">
                            {{ $t("mobile_app.slides[3]") }}
                        </landing-title>
                    </swiper-slide>
                    <div class="mobile-view_prev_next">
                        <button-blue
                            class="mobile-view_prev prev"
                            v-if="viewportWidth > 1200"
                        ></button-blue>
                        <button-blue
                            class="mobile-view_prev next"
                            v-if="viewportWidth > 1200"
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
                        :controller="{ control: firstSwiper }"
                        :allowTouchMove="true"
                        @swiper="setSecondSwiper"
                    >
                        <swiper-slide class="mobile-view_image">
                            <!--                            <img-->
                            <!--                                src="../../../../../assets/img/iphone-14-screen1-ru.png"-->
                            <!--                                alt=""-->
                            <!--                                v-show="$i18n.locale === 'ru'"-->
                            <!--                            />-->
                            <img
                                src="../../../../../assets/img/iphone-14-screen1-en.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <!--                            <img-->
                            <!--                                src="../../../../../assets/img/iphone-14-screen2-ru.png"-->
                            <!--                                alt=""-->
                            <!--                                v-show="$i18n.locale === 'ru'"-->
                            <!--                            />-->
                            <img
                                src="../../../../../assets/img/iphone-14-screen2-en.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <!--                            <img-->
                            <!--                                src="../../../../../assets/img/iphone-14-screen3-ru.png"-->
                            <!--                                alt=""-->
                            <!--                                v-show="$i18n.locale === 'ru'"-->
                            <!--                            />-->
                            <img
                                src="../../../../../assets/img/iphone-14-screen3-en.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <!--                            <img-->
                            <!--                                src="../../../../../assets/img/iphone-14-screen4-ru.png"-->
                            <!--                                alt=""-->
                            <!--                                v-show="$i18n.locale === 'ru'"-->
                            <!--                            />-->
                            <img
                                src="../../../../../assets/img/iphone-14-screen4-en.png"
                                alt=""
                            />
                        </swiper-slide>
                        <swiper-slide class="mobile-view_image">
                            <!--                            <img-->
                            <!--                                src="../../../../../assets/img/iphone-14-screen5-ru.png"-->
                            <!--                                alt=""-->
                            <!--                                v-show="$i18n.locale === 'ru'"-->
                            <!--                            />-->
                            <img
                                src="../../../../../assets/img/iphone-14-screen5-en.png"
                                alt=""
                            />
                        </swiper-slide>
                    </Swiper>
                </div>
                <div class="pagination_bulets" v-if="viewportWidth < 1200">
                </div>
                <div class="mobile-view__btn">{{ $t("mobile_app.note") }}</div>
            </div>
        </div>
        <div class="mobile-view__run">
            <logo-run-icon/>
            <logo-run-icon/>
            <logo-run-icon/>
            <logo-run-icon/>
            <logo-run-icon/>
            <logo-run-icon/>
            <logo-run-icon/>
        </div>
    </div>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingTitle from "../../../common/Components/UI/LandingTitle.vue";
import LogoRunIcon from "../../icons/LogoRunIcon.vue";
import LandingHeadline from "../../../common/Components/UI/LandingHeadline.vue";
import {Swiper, SwiperSlide} from "swiper/vue";
import {Controller, Navigation, Pagination} from "swiper";
import {ref} from "vue";
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
        const firstSwiper = ref(null);
        const secondSwiper = ref(null);
        const setFirstSwiper = (swiper) => {
            firstSwiper.value = swiper;
        };
        const setSecondSwiper = (swiper) => {
            secondSwiper.value = swiper;
        };

        return {
            Controller,
            Navigation,
            Pagination,
            firstSwiper,
            secondSwiper,
            setFirstSwiper,
            setSecondSwiper,
        };
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
};
</script>

<style scoped lang="scss">
.mobile-view__btn {
    width: 170px;
    height: 170px;
    border-radius: 50%;
    fill: rgba(208, 213, 221, 0.2);
    background: rgba(208, 213, 221, 0.2);
    backdrop-filter: unset;
    -webkit-backdrop-filter: unset;
    bottom: 50%;
    color: #d0d5dd;
    text-align: center;
    font-family: Unbounded, serif;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 120%;
    align-self: center;
    text-transform: uppercase;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

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
        flex-flow: row nowrap;
        justify-content: space-between;
        width: 100%;
        position: relative;

        @media (max-width: 1600px) {
            flex-flow: column nowrap;
            justify-content: flex-start;
            gap: 30px;
        }

        @media (min-width: 768.98px) {
            min-height: 1000px;
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
            //z-index: 10;
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
        padding: 32px 32px 0 0;

        @media (max-width: 1600px) {
            text-align: center;
            padding: 32px 32px 0 32px;
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
            border-radius: 30px;

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
    background: #43474e;
    border-radius: 50%;
}

.active-bullet {
    background: #2e90fa;
}
</style>
