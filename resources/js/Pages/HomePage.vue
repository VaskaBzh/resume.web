<template>
    <header-component/>
    <div class="app_back_transparent">
        <div class="app_back_transparent__container">
            <span class="app_back_transparent_one">Allbtc</span>
            <span class="app_back_transparent_two">Pool</span>
        </div>
    </div>
    <landing-title/>
    <who-we-are/>
    <calculator-land/>
    <miners-info-view></miners-info-view>
    <make-up-cab/>
    <security-view/>
    <app-mobile-view/>
    <paymants-view/>
    <mission-view/>
    <connect-with-us-view/>
    <footer-component-land/>
</template>
<script>

import HeaderComponent from "../modules/common/Components/HeaderComponent.vue";
import LandingTitle from "../modules/common/Components/UI/LandingTitle.vue";
import WhoWeAre from "../modules/home/Components/Views/WhoWeAre.vue";
import CalculatorLand from "../modules/home/Components/Views/CalculatorLand.vue";
import MinersInfoView from "../modules/home/Components/Views/MinersInfoView.vue";
import MakeUpCab from "../modules/home/Components/Views/MakeUpCab.vue";
import SecurityView from "../modules/home/Components/Views/SecurityView.vue";
import AppMobileView from "../modules/home/Components/Views/AppMobileView.vue";
import PaymantsView from "../modules/home/Components/Views/PaymantsView.vue";
import MissionView from "../modules/home/Components/Views/MissionView.vue";
import ConnectWithUsView from "../modules/home/Components/Views/ConnectWithUsView.vue";
import FooterComponentLand from "../modules/common/Components/FooterComponentLand.vue";

export default {
    name: 'homa-page',
    components: {
        FooterComponentLand,
        ConnectWithUsView,
        MissionView,
        PaymantsView,
        AppMobileView,
        SecurityView, MakeUpCab, MinersInfoView, CalculatorLand, WhoWeAre, LandingTitle, HeaderComponent}
}

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
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            margin: 0 auto;
            align-items: center;
            justify-content: center;
            flex-flow: column nowrap;
            font-feature-settings: 'clig' off, 'liga' off;
            text-shadow: 0px 4.914285659790039px 8.600000381469727px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            color: transparent;
            -webkit-text-stroke: 1px white;
            font-size: 290px;
            font-style: normal;
            font-weight: 600;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 120%;
            background: transparent;
            padding-bottom: 12rem;
        }

        &_one {
            margin-right: auto;
        }

        &_two {
            margin-left: auto;
        }

    }
}
</style>
