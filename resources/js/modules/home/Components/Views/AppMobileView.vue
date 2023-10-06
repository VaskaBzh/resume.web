<template>
    <div class="mobile-view scroll-section">
        <div class="mobile-view__container">
            <head-line class="mobile-view__title">{{ $t("mobile_app.button") }}</head-line>
            <div class="mobile-view__wrapper">
                <div class="mobile-view_inner">
                    <div class="mobile-view_item active">
                        <h3 class="mobile-view_subtitle">{{ $t("mobile_app.title") }}</h3>
                        <p class="mobile-view_text">{{ $t("mobile_app.text") }}</p>
                    </div>
                    <div class="mobile-view_item">
                        <h3 class="mobile-view_subtitle">Хороший мониторинг
                            и эффективное управление</h3>
                        <p class="mobile-view_text">Наша команда, будучи экспертами
                            и практикующими майнерами, специализируется на биткоине, знает все тонкости
                            добычи криптовалюты и внедряет новые идеи и механизмы в
                            развитие пула. Все внедренные инструменты помогают зарабатывать больше.</p>
                    </div>
                    <div class="mobile-view_item">
                        <h3 class="mobile-view_subtitle">Четкий мониторинг
                            и эффективное управление</h3>
                        <p class="mobile-view_text">Наша команда, будучи экспертами
                            и практикующими майнерами, специализируется на биткоине, знает все тонкости
                            добычи криптовалюты и внедряет новые идеи и механизмы в
                            развитие пула. Все внедренные инструменты помогают зарабатывать больше.</p>
                    </div>
                    <div class="mobile-view_item">
                        <h3 class="mobile-view_subtitle">Прекрасный мониторинг
                            и эффективное управление</h3>
                        <p class="mobile-view_text">Наша команда, будучи экспертами
                            и практикующими майнерами, специализируется на биткоине, знает все тонкости
                            добычи криптовалюты и внедряет новые идеи и механизмы в
                            развитие пула. Все внедренные инструменты помогают зарабатывать больше.</p>
                    </div>
                    <div class="mobile-view_item">
                        <h3 class="mobile-view_subtitle">Офигенный мониторинг
                            и эффективное управление</h3>
                        <p class="mobile-view_text">Наша команда, будучи экспертами
                            и практикующими майнерами, специализируется на биткоине, знает все тонкости
                            добычи криптовалюты и внедряет новые идеи и механизмы в
                            развитие пула. Все внедренные инструменты помогают зарабатывать больше.</p>
                    </div>
                    <div class="mobile-view_prev_next">
                        <button-blue class="mobile-view_prev prev"></button-blue>
                        <button-blue class="mobile-view_prev next"></button-blue>
                    </div>
                </div>
                <div class="mobile-view__content">
                    <img class="iphone" src="../../../../../assets/img/iPhone-14.png" alt="">
                    <div class="mobile-view_swiper-picture">
                        <div class="mobile-view_image active">
                            <img src="../../../../../assets/img/iphone-14-screen1.png" alt="">
                        </div>
                        <div class="mobile-view_image" >
                            <img src="../../../../../assets/img/iphone-14-sreen2.png.png" alt="">
                        </div>
                        <div class="mobile-view_image" >
                            <img src="../../../../../assets/img/iphone-14-screen3.png" alt="">
                        </div>
                        <div class="mobile-view_image" >
                            <img src="../../../../../assets/img/iphone-14-screen4.png" alt="">
                        </div>
                        <div class="mobile-view_image" >
                            <img src="../../../../../assets/img/iphone-14-screen1.png" alt="">
                        </div>
                    </div>
                </div>
                <button-blue class="mobile-view__btn">{{ $t("mobile_app.note") }}</button-blue>
            </div>
        </div>
        <div class="mobile-view__run">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
            <img src="../../../../../assets/img/transparent-name.png" alt="">
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {slideMobileView} from "../../Services/LandSlideAnime";
import {onMounted} from "vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";

export default {
    name: "AppMobileView",
    components: {ButtonBlue, HeadLine},
    i18n: {
        sharedMessages: HomeMessage,
    },
    setup() {

        onMounted(()=> {
            slideMobileView()
        })
        return {

        }
    }
}
</script>


<style scoped lang="scss">
.mobile-view {
    width: 100vw;
    top: 0;
    left: 0;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: space-evenly;

    &__container {
        margin: 0 auto;

    }

    &__wrapper {
        display: flex;
        height: 100vh;
        flex-flow: row nowrap;
        justify-content: space-between;
        margin: 0 calc(-50vw + 75%);
    }

    &_inner {
        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
        align-self: center;
        width: 25%;
    }
    &__content {
        height: 100%;
        position: relative;
        padding: 15px;
        max-height: 875px;

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
    }

    &_subtitle {
        color: #F5FAFF;
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

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 70px;
        }
    }

    &_text {
        color: rgba(245, 250, 255, 0.70);
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
        align-items: center;
        justify-content: center;

        img {
            width: 100%;
            height: 100%;
            margin-left: 170px;
            animation: animMarqueeRtl 7s infinite linear;

            @keyframes animMarqueeRtl {
                0% {
                    transform: translateX(0%);
                }
                100% {
                    transform: translateX(100%);
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
