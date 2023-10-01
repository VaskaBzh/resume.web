<template>
<div class="mobile-view">
    <div class="mobile-view__container">
        <head-line class="mobile-view__title">Мобильное приложение</head-line>
        <button-blue class="mobile-view__btn">Скоро в APPStore</button-blue>
        <div
            class="mobile-view__run"

        >
            <img src="../../../../../assets/img/transparent-name.png" alt="">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
        </div>
    </div>
</div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";

export default {
    name: "AppMobileView",
    components: {ButtonBlue, HeadLine, Swiper, SwiperSlide},
    methods: {
        onSwiper(swiper) {
            console.log(swiper)
        },

        onSlideChange() {
            console.log('Slide Change')
        }
    }

}
</script>



<style scoped lang="scss">
.mobile-view {
    position: relative;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: space-evenly;

    &__run {
        display: flex;
        align-items: center;
        justify-content: center;

            img {
                width: 100%;
                height: 100%;
                margin-left: 170px;
                animation: animMarqueeRtl 7s linear infinite;

                @keyframes animMarqueeRtl {
                    0% {
                        transform: translateX(100%);
                    }
                    100% {
                        transform: translateX(0%);
                    }
                }
            }
    }
}
</style>
