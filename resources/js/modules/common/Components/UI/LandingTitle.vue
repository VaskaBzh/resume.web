<template>
    <div class="header-land">
        <div class="header-land_title">
            <div class="header-land__block">
                <span class="header-land_title_expert-one">{{
                        $t("title[0]")
                    }}</span>
                <span class="header-land_title_expert-two">{{
                        $t("title[1]")
                    }}</span>
            </div>
            <div class="header-land__block-two">
                <span class="header-land_title_approach">{{
                        $t("title[2]")
                    }}</span>
            </div>
            <div class="header-land__block-three">
                <span class="header-land_title_mining-one"
                >{{
                        $t("title[3]")
                    }}<span class="header-land_title_mining-two">{{
                            $t("title[4]")
                        }}</span></span
                >
            </div>
            <div class="header-land__block-four">
                <span class="header-land_title_text">
                    <span class="header-land_title_btc">Bitcoin</span>
                    <span class="header-land_title_span">
                        {{ $t("text") }}
                    </span>
                </span>
            </div>
        </div>
        <button-blue class="header-land_btn">{{ $t("button") }}</button-blue>
    </div>
</template>

<script>
import ButtonBlue from "./ButtonBlue.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import {scroolingHeader} from "../../../home/Services/ScrollAnime";

export default {
    name: "LandingTitle",
    components: {ButtonBlue},
    i18n: {
        sharedMessages: HomeMessage,
    },

    mounted() {
        scroolingHeader();
    },
};
</script>

<style scoped lang="scss">
.header-land {
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
    position: relative;
    min-height: 400px;

    &_title {
        color: #f5faff;
        display: flex;
        flex-flow: column nowrap;
        position: absolute;
        text-shadow: 0px 4.897561073303223px 8.570732116699219px rgba(14, 14, 14, 0.05);
        font-family: Unbounded, serif;
        font-size: 110px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
        text-transform: uppercase;
        max-width: 965px;

        &_expert-one,
        &_expert-two,
        &_approach,
        &_mining-one,
        &_mining-two,
        &_text,
        &_span {
            display: flex;
            opacity: 0;
        }

        &_text {
            display: flex;
            position: relative;
        }

        &_span {
            display: flex;
            font-family: NunitoSans, serif;
            color: rgba(245, 250, 255, 0.7);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
            padding-left: 10px;
            align-self: center;
        }
    }

    &__block,
    &__block-two,
    &__block-three,
    &__block-four {
        display: flex;
        flex-flow: row nowrap;
        overflow: hidden;
    }

    &__block-two {
        position: relative;
        left: -10%;
        top: 0;
    }

    .active {
        position: relative;
        top: 0;
        left: 0;
        transition: all 1s linear;
        animation: scrub 1s forwards ease-in;
        @keyframes scrub {
            0% {
                opacity: 1;
                left: 0;
            }
            100% {
                opacity: 0;
                left: -100%;
            }
        }
    }
}
</style>
