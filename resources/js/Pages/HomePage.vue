<template>
    <home-title/>
    <who-we-are/>
<!--    <calculator-land/>-->
    <miners-info-view/>
    <make-up-cab/>
    <security-view/>
    <app-mobile-view/>
    <payments-view/>
    <miners-info-view/>
    <history-pool-view/>
    <connect-with-us-view/>
</template>

<script>
// import { ComponentsEnum } from "@/modules/home/enums/ComponentsEnum";
import ConnectWithUsView from "@/modules/home/Components/Views/ConnectWithUsView.vue";
import HistoryPoolView from "@/modules/home/Components/Views/HistoryPoolView.vue";
import MissionView from "@/modules/home/Components/Views/MissionView.vue";
import PaymentsView from "@/modules/home/Components/Views/PaymentsView.vue";
import AppMobileView from "@/modules/home/Components/Views/AppMobileView.vue";
import SecurityView from "@/modules/home/Components/Views/SecurityView.vue";
import MakeUpCab from "@/modules/home/Components/Views/CabinetView.vue";
import MinersInfoView from "@/modules/home/Components/Views/MinersInfoView.vue";
import CalculatorLand from "@/modules/home/Components/Views/CalculatorLand.vue";
import WhoWeAre from "@/modules/home/Components/Views/AboutView.vue";
import HomeTitle from "@/modules/home/Components/Views/HeroView.vue";

export default {
    name: "home-page",
    components: {
        ConnectWithUsView,
        HistoryPoolView,
        MissionView,
        PaymentsView,
        AppMobileView,
        SecurityView,
        MakeUpCab,
        MinersInfoView,
        CalculatorLand,
        WhoWeAre,
        HomeTitle
    }
};
</script>

<style scoped></style>
