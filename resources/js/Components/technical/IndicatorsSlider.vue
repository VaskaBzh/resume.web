<template>
    <div class="indicators__row">
        <div class="indicators__slider indicators__slider-image">
            <swiper
                ref="swiper1"
                :slides-per-view="1"
                :space-between="24"
                @swiper="onSwiper1Ready"
                :pagination="{
                    el: '.indicators__slider-main .swiper-pagination',
                    clickable: true,
                }"
                :loop="true"
                :modules="modules"
            >
                <swiper-slide class="wrap__row" v-for="option in options">
                    <img :src="option[0].img" alt="Option image" />
                </swiper-slide>
            </swiper>
        </div>
        <div class="indicators__slider indicators__slider-main">
            <div class="swiper-pagination"></div>
            <swiper
                ref="swiper2"
                @swiper="onSwiper2Ready"
                :slides-per-view="1"
                :space-between="24"
                class="indicators__slider wrap"
                :loop="true"
                :modules="modules"
                :pagination="{
                    el: '.indicators__slider-main .swiper-pagination',
                    clickable: true,
                }"
            >
                <swiper-slide class="wrap__row" v-for="option in options">
                    <indicator-block :option="option"> </indicator-block>
                </swiper-slide>
            </swiper>
        </div>
    </div>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import { Pagination, Controller } from "swiper";
import indicatorBlock from "@/Components/technical/blocks/IndicatorBlock.vue";

export default {
    name: "indicators-slider",
    components: {
        Swiper,
        SwiperSlide,
        indicatorBlock,
    },
    props: {
        options: Array,
    },
    methods: {
        onSwiper1Ready(swiper) {
            this.swiper1 = swiper;
            if (this.swiper2) {
                this.swiper1.controller.control = this.swiper2;
                this.swiper2.controller.control = this.swiper1;
            }
        },
        onSwiper2Ready(swiper) {
            this.swiper2 = swiper;
            if (this.swiper1) {
                this.swiper1.controller.control = this.swiper2;
                this.swiper2.controller.control = this.swiper1;
            }
        },
    },
    setup() {
        return {
            modules: [Pagination, Controller],
        };
    },
};
</script>

<style scoped lang="scss">
.indicators {
    &__slider {
        .swiper {
            &-pagination {
                top: -40px;
                height: 20px;
            }
        }
        .wrap {
            margin-bottom: 0;
            padding: 20px !important;
            @media (max-width: 767.98px) {
                padding: 10px !important;
            }

            &__block {
                justify-content: center;
            }
        }
        &-image {
            min-height: 760px;
            max-height: 760px;
            @media (max-width: 1270.98px) {
                min-height: 580px;
                max-height: 580px;
            }
            @media (max-width: 991.98px) {
                min-height: 460px;
                max-height: 460px;
            }
            @media (max-width: 767.98px) {
                min-height: 420px;
                max-height: 420px;
            }
            @media (max-width: 479.98px) {
                min-height: 280px;
                max-height: 280px;
            }
            @media (max-width: 320.98px) {
                min-height: 200px;
                max-height: 200px;
            }
            img {
                width: 100%;
            }
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
