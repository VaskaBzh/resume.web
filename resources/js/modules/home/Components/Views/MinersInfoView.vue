<template>
    <div class="miners-info-view scroll-section">
        <div class="miners-info-view__container">
            <head-line class="miners-info-view_title"> {{ $t("why_allbtc.button") }}</head-line>
            <h3 class="miners-info-view_subtitle">
                <span class="miners-info-view_subtitle_base">{{ $t("why_allbtc.title[0]") }}</span>
                <span class="miners-info-view_subtitle_one">{{ $t("why_allbtc.title[1]") }}</span>
                <span class="miners-info-view_subtitle_two">{{ $t("why_allbtc.title[2]") }}</span>
                <span class="miners-info-view_subtitle_three">{{ $t("why_allbtc.title[3]") }}</span>
            </h3>
            <div class="miners-info-view__items">
                <div class="miners-info-view_item miners-info-view_item-one">
                    <p class="miners-info-view_item_text">{{ $t("why_allbtc.list.text[0]") }}
                    </p>
                    <h3 class="miners-info-view_item_title">{{ $t("why_allbtc.list.title[0]") }}</h3>
                </div>
                <div class="miners-info-view_item miners-info-view_item-two">
                    <p class="miners-info-view_item_text">{{ $t("why_allbtc.list.text[1]") }}
                    </p>
                    <h3 class="miners-info-view_item_title">{{ $t("why_allbtc.list.title[1]") }}</h3>

                </div>
                <div class="miners-info-view_item miners-info-view_item-three">
                    <p class="miners-info-view_item_text">{{ $t("why_allbtc.list.text[2]") }}
                    </p>
                    <h3 class="miners-info-view_item_title">{{ $t("why_allbtc.list.title[2]") }}</h3>

                </div>
            </div>
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import {animateWhyBtcView} from "../../Services/AnimateWhyBtcView";

export default {
    name: "MinersInfoView",
    components: {HeadLine},
    i18n: {
            sharedMessages: HomeMessage,
    },
    mounted() {
        animateWhyBtcView()
    }

}
</script>


<style scoped lang="scss">
.miners-info-view {
    display: flex;
    width: 100vw;
    padding-top: 100px;
    align-items: center;
    justify-content: center;
    flex-flow: column nowrap;

    &__container {
        margin: 0 auto;
        max-width: 1636px;
    }

    &_subtitle {
        width: fit-content;
        color: #F5FAFF;
        display: flex;
        flex-flow: column nowrap;
        margin: 0 auto 40px;
        justify-content: center;
        text-shadow: 0px 4.897561073303223px 8.570732116699219px rgba(14, 14, 14, 0.05);
        font-family: Unbounded, serif;
        font-size: 46px;
        font-style: normal;
        font-weight: 600;
        line-height: 100%;
        text-transform: uppercase;

        &_one {
            display: block;
            position: relative;
            left: -100px;
        }
    }

    &__items {
        display: flex;
        flex-flow: column nowrap;
        align-items: flex-start;
        justify-content: center;
        margin-top: 140px;
    }

    &_item {
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 32px 0;
        max-height: 15vh;
        transition: max-height 5s linear;


        &:nth-child(1) {
            border-top: .5px solid rgba(228, 231, 236, 0.40);
            border-bottom: .5px solid rgba(228, 231, 236, 0.40);
        }

        &:nth-child(2) {
            border-bottom: .5px solid rgba(228, 231, 236, 0.40);
        }

        &:nth-child(3) {
            border-bottom: .5px solid rgba(228, 231, 236, 0.40);
        }

        &:hover {
            max-height: 1000px;
            grid-template-columns: repeat(1, 400px 1fr);
            transition: max-height 5s linear;
    }

        &:hover &_text {
            max-height: 100%;
            overflow: unset;
            opacity:1;
            transition: opacity .2s;
        }

        &:hover &_title {
            white-space: unset;
            transition: all 2s linear;
        }


        &_text {
            width: 430px;
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
            overflow: hidden;
            max-height: 0;
            opacity: 0;
            transition: opacity .2s linear;

        }

        &_title {
            color: #F5FAFF;
            text-align: right;
            font-family: Unbounded, serif;
            font-size: 65px;
            font-style: normal;
            font-weight: 600;
            line-height: 120%;
            text-transform: uppercase;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            white-space: nowrap;
            -ms-word-break: break-all;
            word-break: break-word;
            transition: white-space .3s linear;
        }
    }


}

</style>
