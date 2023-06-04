<template>
    <div class="indicators__row">
        <div class="indicators__slider indicators__slider-image">
            <swiper
                :allowTouchMove="false"
                :slides-per-view="1"
                :space-between="24"
                :navigation="{
                    nextEl: '.next',
                    prevEl: '.prev',
                }"
                :modules="modules"
            >
                <swiper-slide class="wrap__row" v-for="option in options">
                    <img :src="option[0].img" alt="Option image" />
                </swiper-slide>
            </swiper>
        </div>
        <div class="indicators__slider indicators__slider-main">
            <div class="prev swiper-button">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M14 18L8 12L14 6"
                        stroke="#131A29"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>
            <swiper
                :allowTouchMove="false"
                :slides-per-view="1"
                :space-between="24"
                class="indicators__slider wrap"
                :navigation="{
                    nextEl: '.next',
                    prevEl: '.prev',
                }"
                :modules="modules"
            >
                <swiper-slide class="wrap__row" v-for="option in options">
                    <div class="wrap__block wrap__block-blue wrap__column">
                        <main-title
                            tag="h3"
                            class="wrap_title wrap_title-white wrap_title-no-before"
                            >{{ option[0].title }}</main-title
                        >
                        <p class="text text-sm text-ligth">
                            {{ option[0].text }}
                        </p>
                    </div>
                    <div class="wrap__block wrap__column">
                        <p class="text text-sm" v-for="opt in option[1]">
                            {{ opt }}
                        </p>
                    </div>
                </swiper-slide>
            </swiper>
            <div class="next swiper-button">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M10 6L16 12L10 18"
                        stroke="#131A29"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import "swiper/css";
import "swiper/css/pagination";
import { Navigation } from "swiper";

export default {
    name: "indicators-slider",
    components: {
        Swiper,
        SwiperSlide,
        MainTitle,
    },
    props: {
        options: Array,
    },
    setup() {
        return {
            modules: [Navigation],
        };
    },
};
</script>

<style scoped lang="scss">
.indicators {
    &__slider {
        .wrap {
            margin-bottom: 0;
            padding: 20px 20px 20px !important;
            &__row {
                min-height: 263px;
            }

            &__block {
                justify-content: center;
            }
        }
        &-image {
            min-height: 760px;
            //position: relative;
            //&:before {
            //    content: "";
            //    background-image: url("../../../assets/img/indicators_img-wrap.png");
            //    background-position: top;
            //    background-repeat: no-repeat;
            //    min-height: 760px;
            //    position: absolute;
            //    left: 50%;
            //    transform: translateX(-50%);
            //    top: 0;
            //    width: 100vw;
            //}
            //.swiper {
            //    max-width: 845px;
            //    transform: skew(-45deg, 20.4deg) translateY(133px) translateX(79px);
            //    img {
            //        width: 100%;
            //        border-radius: 24px;
            //    }
            //}
        }
        &-main {
            position: relative;
            .swiper-button {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: #ffffff;
                border-radius: 13px;
                width: 40px;
                height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                &.next {
                    right: -64px;
                }
                &.prev {
                    left: -64px;
                }
            }
        }
    }
    &__row {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
}
</style>
