<template>
    <header-component/>
    <div class="app_back_transparent">
        <div class="app_back_transparent__container">
            <div class="app_back_transparent_block-one">
                <span class="app_back_transparent_one">
                    <allbtc-logo-icon/>
                </span>
            </div>
            <div class="app_back_transparent_block-two">
                <span class="app_back_transparent_two">
                    <pool-logo-icon/>
                </span>
            </div>
        </div>
    </div>
    <home-title/>
    <who-we-are/>
    <calculator-land/>
    <miners-info-view/>
    <make-up-cab/>
    <security-view/>
    <app-mobile-view/>
    <payments-view/>
    <mission-view/>
    <history-pool-view/>
    <connect-with-us-view/>
    <footer-component-land/>
</template>
<script>
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import HomeTitle from "@/modules/home/Components/Views/HomeTitle.vue";
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
import HistoryPoolView from "../modules/home/Components/Views/HistoryPoolView.vue";

export default {
    name: "home-page",
    components: {
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
        HomeTitle,
        HeaderComponent,
    },
    mounted() {
        // gsap.registerPlugin(ScrollTrigger);
        // ScrollTrigger.refresh();
        // animateHeader();
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
        z-index: 0;

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
            text-shadow: 0px 5.13397216796875px 8.984451293945312px rgba(14, 14, 14, 0.05);
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
            // z-index: 99;
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
</style>
