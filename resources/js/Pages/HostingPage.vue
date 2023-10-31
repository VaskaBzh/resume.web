<template>
    <hero-view/>
    <about-view/>
    <working-view/>
    <monitoring-system-card/>
    <support-system-card/>
    <clients-view/>
    <personal-area-card/>
    <mobile-app-card/>
    <guarantee-card/>
    <connect-card/>
</template>
<script>
import MonitoringSystemCard from "@/modules/hosting/Components/MonitoringSystemCard.vue";
import SupportSystemCard from "@/modules/hosting/Components/SupportSystemCard.vue";
import PersonalAreaCard from "@/modules/hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "@/modules/hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "@/modules/hosting/Components/GuaranteeCard.vue";
import ConnectCard from "@/modules/hosting/Components/ConnectCard.vue";
import AboutView from "@/modules/hosting/Components/AboutView.vue";
import HeroView from "@/modules/hosting/Components/HeroView.vue";
import WorkingView from "@/modules/hosting/Components/WorkingView.vue";
import ClientsView from "@/modules/hosting/Components/ClientsView.vue";
import OfferView from "@/modules/hosting/Components/OfferView.vue";
import {NavMessages} from "@/modules/navs/lang/NavMessages";


export default {
    name: "hosting-page",
    i18n: {
        sharedMessages: NavMessages,
    },
    components: {
        MonitoringSystemCard,
        SupportSystemCard,
        PersonalAreaCard,
        MobileAppCard,
        GuaranteeCard,
        ConnectCard,
        AboutView,
        ClientsView,
        WorkingView,
        HeroView,
        OfferView,
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("nav_links.hosting");
        },
    },
    mounted() {
        document.title = this.$t("nav_links.hosting");
    }
};
</script>
<style scoped>
.first-text {
    flex-direction: column;
}

.footer-hosting {
    /* height: 673px; */
    flex-shrink: 0;
    border-radius: 70px 70px 0px 0px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0d0d0d);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25),
    0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 100px 100px 50px;
}

@media (max-width: 850px) {
    .help-button {
        display: none;
    }
}

@media (max-width: 768px) {
    .get-consultation {
        width: 80%;
    }

    .second-text {
        width: 85%;
        gap: 50px;
    }
}

@media (max-width: 450px) {
    .hosting-content {
        font-size: 22px;
        width: 244px;
        height: auto;
    }

    .get-consultation {
        width: 90vw;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
    }

    .second-text {
        gap: 50px;
    }

    .third-text {
        gap: 50px;
    }

    .footer-hosting {
        padding: 40px 16px;
    }
}
</style>
