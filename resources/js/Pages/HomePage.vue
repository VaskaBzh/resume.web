<template>
    <header-component />
    <div class="app_back_transparent">
        <div class="app_back_transparent__container">
            <div class="app_back_transparent_block-one">
                <span class="app_back_transparent_one">
                    <allbtc-logo-icon />
                </span>
            </div>
            <div class="app_back_transparent_block-two">
                <span class="app_back_transparent_two">
                    <pool-logo-icon />
                </span>
            </div>
        </div>
    </div>
    <div class="header-land">
        <landing-title class="header-land_title">
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
                        >{{ $t("title[3]")
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
        </landing-title>
        <button-blue class="header-land_btn">{{ $t("button") }}</button-blue>
    </div>
    <who-we-are />
    <calculator-land />
    <miners-info-view />
    <make-up-cab />
    <security-view />
    <app-mobile-view />
    <payments-view />
    <mission-view />
    <history-pool-view />
    <connect-with-us-view />
    <footer-component-land />
</template>
<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import WhoWeAre from "@/modules/home/Components/Views/WhoWeAre.vue";
import CalculatorLand from "@/modules/home/Components/Views/CalculatorLand.vue";
import MinersInfoView from "@/modules/home/Components/Views/MinersInfoView.vue";
import MakeUpCab from "@/modules/home/Components/Views/MakeUpCab.vue";
import SecurityView from "@/modules/home/Components/Views/SecurityView.vue";
import AppMobileView from "@/modules/home/Components/Views/AppMobileView.vue";
import PaymentsView from "@/modules/home/Components/Views/PaymentsView.vue";
import MissionView from "@/modules/home/Components/Views/MissionView.vue";
import ConnectWithUsView from "@/modules/home/Components/Views/ConnectWithUsView.vue";
import FooterComponentLand from "@/modules/common/Components/FooterComponentLand.vue";
import PoolLogoIcon from "@/modules/home/icons/PoolLogoIcon.vue";
import AllbtcLogoIcon from "@/modules/home/icons/AllbtcLogoIcon.vue";
import gsap from "gsap";
import {ScrollTrigger} from "gsap/ScrollTrigger";
import {animateHeader} from "@/modules/home/Services/LandHeaderAnime";
import HistoryPoolView from "../modules/home/Components/Views/HistoryPoolView.vue";
import HistoryPoolView from "@/modules/home/Components/Views/HistoryPoolView.vue";
import ButtonBlue from "@/modules/common/Components/UI/ButtonBlue.vue";

import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import { animateHeader } from "@/modules/home/Services/LandHeaderAnime";
import { scroolingHeader } from "@/modules/home/Services/ScrollAnime";

export default {
    name: "home-page",
    components: {
        ButtonBlue,
        HistoryPoolView,
        AllbtcLogoIcon,
        PoolLogoIcon,
        FooterComponentLand,
        ConnectWithUsView,
        MissionView,
        PaymentsView,
        AppMobileView,
        SecurityView,
        MakeUpCab,
        MinersInfoView,
        CalculatorLand,
        WhoWeAre,
        LandingTitle,
        HeaderComponent,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    mounted() {
        gsap.registerPlugin(ScrollTrigger)
        ScrollTrigger.refresh()
        animateHeader()
    }
}

        animateHeader();
        scroolingHeader();
    },
};
</script>

<style lang="scss" scoped>
.app_back {
    &_transparent {
        width: 100vw;
        height: 100vh;
        margin: 0 auto;
        position: absolute;
        top: 0;
        left: 0;

        &__container {
            max-width: 1580px;
            position: relative;
            width: 100%;
            height: 75%;
            display: flex;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
            flex-flow: column nowrap;
            font-feature-settings: "clig" off, "liga" off;
            text-shadow: 0px 5.13397216796875px 8.984451293945312px
                rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            color: transparent;
            //-webkit-text-stroke: 1px white;
            font-size: 290px;
            font-style: normal;
            font-weight: 600;
            -webkit-background-clip: text;

            //-webkit-text-fill-color: rgb(255,255,255,0.7);
            opacity: 0.7;

            line-height: 120%;
            background: transparent;
            padding-bottom: 12rem;
            z-index: 99;
        }

        &_block-one {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            align-self: flex-start;
            overflow: hidden;
            transform: translateX(0px);
        }

        &_block-two {
            align-self: flex-end;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            overflow: hidden;
        }

        &_one,
        &_two {
            display: block;
            padding: 3px;
        }

        &_one {
            width: clamp(1070px, 5vw, 324px);
        }

        &_two {
            width: clamp(778px, 5vw, 237px);
        }
    }
}

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
        //position: absolute;
        text-shadow: 0px 4.897561073303223px 8.570732116699219px
            rgba(14, 14, 14, 0.05);
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
