<template>
    <div class="header-land">
        <landing-title tag="h1" class="header-land_title">
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
                    <landing-text tag="span" class="header-land_title_span">{{
                            $t("text")
                        }}</landing-text>
                </span>
            </div>
        </landing-title>

        <landing-button class="header-land_btn header_button button-full">
            <template v-slot:text>{{ $t("button") }}</template>
        </landing-button>
        <!--        <button-blue class="header-land_btn">{{ $t("button") }}</button-blue>-->
    </div>
</template>

<script>
import {HomeMessage} from "@/modules/home/lang/HomeMessage";
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import ButtonBlue from "@/modules/common/Components/UI/ButtonBlue.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import LandingText from "@/modules/common/Components/UI/LandingText.vue";

export default {
    name: "home-title",
    components: {LandingText, LandingTitle, LandingButton, ButtonBlue},
    i18n: {
        sharedMessages: HomeMessage,
    },
    mounted() {
        // scroolingHeader();
    },
};
</script>

<style scoped lang="scss">
.header {
    &_button {
        max-width: 860px;
    }

    &-land {
        display: flex;
        justify-content: center;
        background: transparent;
        flex-direction: column;
        min-height: 400px;
        height: 100vh;
        gap: 50px;
        max-width: 1060px;
        width: 100%;
        padding: 0 100px;
        margin: 0 auto;
        @media (max-width: 991.98px) {
            padding: 0 32px;
        }

        &_title {
            display: flex;
            flex-flow: column nowrap;
            max-width: 965px;

            &_expert-one,
            &_expert-two,
            &_approach,
            &_mining-one,
            &_mining-two,
            &_text,
            &_span {
                display: flex;
                //opacity: 0;
            }

            &_text {
                display: flex;
                position: relative;
            }

            &_span {
                display: flex;
                padding-left: 10px;
                align-self: center;
                min-width: 406px;
            }
        }

        &__block,
        &__block-two,
        &__block-three,
        &_title-btc {
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
}
</style>
