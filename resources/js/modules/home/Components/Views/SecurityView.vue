<template>
    <div class="security-view">
        <head-line class="security-view_btn">{{ $t("safety") }}</head-line>
        <div class="security-view__wrapper">
            <div class="security-view__inner">
                <div class="security-view__inner_wrap">
                    <div class="security-view_item">
                        <h2 class="security-view_item_title">{{ $t("safety.encryption.title") }}</h2>
                        <div class="security-view_item_cards">
                            <p class="security-view_item_cards__text">{{ $t("safety.encryption.text") }}</p>
                        </div>
                    </div>
                </div>
                <div class="security-view__inner_wrap">
                    <div class="security-view_item">
                        <h2 class="security-view_item_title-two">{{ $t("safety.updates.title") }}</h2>
                        <div class="security-view_item_cards">
                            <p class="security-view_item_cards__text-two">{{ $t("safety.updates.text") }}</p>
                        </div>
                    </div>
                </div>
                <div class="security-view__inner_wrap">
                    <div class="security-view_item">
                        <h2 class="security-view_item_title-three">{{ $t("safety.DDoS.title") }}</h2>
                        <div class="security-view_item_cards">
                            <p class="security-view_item_cards__text-three">{{ $t("safety.DDoS.text") }}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="security-view_stiky">
                <div class="security-view_stiky_block"></div>
            </div>
            <!--        <button-blue class="security_link">{{ $t("who_we_are.card_community.button[0]") }}</button-blue>-->
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import {animatedSecurityView} from "../../Services/animateSecurityView";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";

export default {

    name: "SecurityView",
    components: {HeadLine},
    i18n: {
        sharedMessages: HomeMessage,
    },
    mounted() {

        animatedSecurityView()
    }


}
</script>


<style scoped lang="scss">
.security-view {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-flow: column nowrap;
    gap: 30px;
    padding: 100px 0 186px;
    background: #1c293e;


    &__wrapper {
        position: relative;
        display: flex;
        flex-flow: row nowrap;
    }

    &__inner {
        position: absolute;
        height: 100vh;
        left: -25%;
        top: 0;
        width: 115%;
        display: flex;
        flex-flow: column nowrap;
        margin: 0 auto;

        &_wrap {
            height: 65vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;

        }


    }

    &_item {
        width: 100%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        top: 0;
        gap: 30px;
        z-index: 99;
        position: relative;


        &_title {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
            width: 70%;
        }

        &_title-two {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
            width: 70%;
            opacity: 0;
        }

        &_title-three {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
            width: 70%;
            opacity: 0;
        }

        &_cards {
            display: flex;
            flex-flow: column nowrap;
            align-items: flex-start;
            justify-content: center;
            overflow: hidden;

            &__text {
                color: rgba(245, 250, 255, 0.70);
                text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
                font-family: NunitoSans, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
            }
            &__text-two {
                color: rgba(245, 250, 255, 0.70);
                text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
                font-family: NunitoSans, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                opacity: 0;
            }
            &__text-three {
                color: rgba(245, 250, 255, 0.70);
                text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
                font-family: NunitoSans, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                opacity: 0;
            }

        }
    }
    &_stiky {
        position: relative;
        left: 0;
        top: 0;
        width: 100%;
        height: 75vh;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: flex-start;

        &_block {
            width: 860px;
            height: 680px;
            max-width: 860px;
            max-height: 680px;
            border-radius: 40px;
            border-top: 2px solid #555353;
            border-bottom: 0.5px solid #555353;
            background: rgba(13, 13, 13, 0.5);
            backdrop-filter: blur(10px);
        }
    }
}

//.security-view {
//    width: 100vw;
//    display: flex;
//    padding: 100px 0;
//    height: 100vh;
//
//    &__container {
//        width: 100%;
//        max-width: 1600px;
//        display: flex;
//        flex-flow: column nowrap;
//        align-items: center;
//        margin: 0 auto;
//        justify-content: center;
//
//    }
//
//    &__wrapper {
//        display: flex;
//        flex-flow: row nowrap;
//        align-items: center;
//        width: 100%;
//        height: 65vh;
//        position: relative;
//    }
//
//    &__left {
//        width: 63%;
//        display: flex;
//        flex-flow: column nowrap;
//        align-items: center;
//        justify-content: flex-start;
//        height: 100vh;
//        position: absolute;
//        z-index: 9;
//        left: 10%;
//
//
//        &__item__wrapper {
//            height: 100vh;
//            width: 100%;
//            display: flex;
//            flex-flow: column nowrap;
//            align-items: center;
//            position: absolute;
//        }
//
//    }
//
//
//    &_item {
//        display: flex;
//        flex-flow: row nowrap;
//        width: 100%;
//        height: 100vh;
//        align-items: center;
//        justify-content: center;
//        gap: 100px;
//        position: absolute;
//
//        &_title {
//            color: #F5FAFF;
//            font-family: Unbounded, serif;
//            font-size: clamp(14px, 5vw, 65px);
//            font-style: normal;
//            font-weight: 400;
//            line-height: 120%;
//            text-transform: uppercase;
//        }
//        &_title-two {
//            color: #F5FAFF;
//            font-family: Unbounded, serif;
//            font-size: clamp(14px, 5vw, 65px);
//            font-style: normal;
//            font-weight: 400;
//            line-height: 120%;
//            text-transform: uppercase;
//            opacity: 0;
//        }
//        &_title-three {
//            color: #F5FAFF;
//            font-family: Unbounded, serif;
//            font-size: clamp(14px, 5vw, 65px);
//            font-style: normal;
//            font-weight: 400;
//            line-height: 120%;
//            text-transform: uppercase;
//            opacity: 0;
//        }
//
//        &_text {
//            color: rgba(245, 250, 255, 0.70);
//            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
//            font-family: NunitoSans, serif;
//            font-size: 20px;
//            font-style: normal;
//            font-weight: 400;
//            line-height: 110%;
//        }
//        &_text-two {
//            color: rgba(245, 250, 255, 0.70);
//            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
//            font-family: NunitoSans, serif;
//            font-size: 20px;
//            font-style: normal;
//            font-weight: 400;
//            line-height: 110%;
//            opacity: 0;
//        }
//        &_text-three {
//            color: rgba(245, 250, 255, 0.70);
//            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
//            font-family: NunitoSans, serif;
//            font-size: 20px;
//            font-style: normal;
//            font-weight: 400;
//            line-height: 110%;
//            opacity: 0;
//        }
//
//    }
//
//    &_right {
//        width: 50%;
//        height: 100vh;
//        display: flex;
//        flex-direction: column;
//        justify-content: center;
//        position: absolute;
//        transform: translate(50%, 0%);
//
//        &_item {
//            width: 100%;
//            height: 554px;
//            border-radius: 40px;
//            border-top: 2px solid #555353;
//            border-bottom: 0.5px solid #555353;
//            background: rgba(13, 13, 13, 0.5);
//            backdrop-filter: blur(10px);
//            display: flex;
//            align-items: center;
//            position: absolute;
//            flex-flow: column nowrap;
//            justify-content: center;
//        }
//
//    }
//
//
//}
</style>
