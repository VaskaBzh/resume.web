<template>
    <div class="security-view scroll-section">
        <div class="security-view__container">
            <head-line class="security-view_btn">{{ $t("safety") }}</head-line>
            <div class="security-view__wrapper">
                <div  class="security-view__left">
                    <div class="security-view__left__item__wrapper">
                        <div class="security-view_item">
                            <h3 class="security-view_item_title">{{ $t("safety.encryption.title") }}</h3>
                            <p class="security-view_item_text">{{ $t("safety.encryption.text") }}</p>
                        </div>
                        <div class="security-view_item">
                            <h3 class="security-view_item_title">{{ $t("safety.updates.title") }}</h3>
                            <p class="security-view_item_text">{{ $t("safety.updates.text") }}</p>
                        </div>
                        <div class="security-view_item">
                            <h3 class="security-view_item_title">{{ $t("safety.DDoS.title") }}</h3>
                            <p class="security-view_item_text">{{ $t("safety.DDoS.text") }}</p>
                        </div>
                    </div>
                </div>
                <div class="security-view_right">
                    <div class="security-view_right_item"></div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
// import {animatedScroll} from "../../Services/ScrollAnime";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";

export default {

    name: "SecurityView",
    components: {HeadLine},
    i18n: {
        sharedMessages: HomeMessage,
    },
    mounted() {
        // animatedScroll()
    }

}
</script>


<style scoped lang="scss">
.security-view {
    width: 100vw;
    padding: 100px 0;
    height: 100vh;

    &__container {
        max-width: 1600px;
        display: flex;
        box-sizing: content-box;
        flex-flow: column nowrap;
        align-items: center;
        margin: 0 auto;
        justify-content: center;

    }

    &__wrapper {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        width: 100%;
        height: 100vh;
        position: relative;
    }

    &__left {
        width: 63%;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: flex-start;
        height: 100vh;
        position: absolute;
        z-index: 9;
        left: 10%;


        &__item__wrapper {
            height: 100vh;
            width: 100%;
            display: flex;
            flex-flow: column nowrap;
            align-items: center;
            position: absolute;
        }

    }


    &_item {
        display: flex;
        flex-flow: row nowrap;
        width: 100%;
        height: 100vh;
        align-items: center;
        justify-content: center;
        gap: 100px;
        position: absolute;

        &_title {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
        }

        &_text {
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }

    &_right {
        width: 50%;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: absolute;
        transform: translate(50%, 0%);

        &_item {
            width: 100%;
            height: 554px;
            border-radius: 40px;
            border-top: 2px solid #555353;
            border-bottom: 0.5px solid #555353;
            background: rgba(13, 13, 13, 0.5);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            position: absolute;
            flex-flow: column nowrap;
            justify-content: center;
        }

    }


}
</style>
