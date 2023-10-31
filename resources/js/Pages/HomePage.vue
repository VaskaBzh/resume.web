<template>
    <hero-view />
    <about-view />
    <calculator-land />
    <miners-info-view />
    <cabinet-view />
    <security-view />
    <app-mobile-view />
    <payments-view />
    <mission-view />
    <history-pool-view />
    <connect-with-us-view />
</template>

<script>
// import { ComponentsEnum } from "@/modules/home/enums/ComponentsEnum";
import ConnectWithUsView from "@/modules/home/Components/Views/ConnectWithUsView.vue";
import HistoryPoolView from "@/modules/home/Components/Views/HistoryPoolView.vue";
import MissionView from "@/modules/home/Components/Views/MissionView.vue";
import PaymentsView from "@/modules/home/Components/Views/PaymentsView.vue";
import AppMobileView from "@/modules/home/Components/Views/AppMobileView.vue";
import SecurityView from "@/modules/home/Components/Views/SecurityView.vue";
import CabinetView from "@/modules/home/Components/Views/CabinetView.vue";
import MinersInfoView from "@/modules/home/Components/Views/MinersInfoView.vue";
import CalculatorLand from "@/modules/home/Components/Views/CalculatorLand.vue";
import AboutView from "@/modules/home/Components/Views/AboutView.vue";
import HeroView from "@/modules/home/Components/Views/HeroView.vue";
import {NavMessages} from "@/modules/navs/lang/NavMessages";

export default {
    name: "HomePage",
    components: {
        ConnectWithUsView,
        HistoryPoolView,
        MissionView,
        PaymentsView,
        AppMobileView,
        SecurityView,
        CabinetView,
        MinersInfoView,
        CalculatorLand,
        AboutView,
        HeroView,
    },
    i18n: {
        sharedMessages: NavMessages,
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("nav_links.home");
        },
    },
    mounted() {
        document.title = this.$t("nav_links.home");
    }
};
</script>

<style scoped></style>
