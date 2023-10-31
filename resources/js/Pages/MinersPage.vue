<template>
    <hero-view/>
    <about-miners-view/>
    <our-offer/>
    <personal-area-card/>
    <mobile-app-card/>
    <guarantee-card/>
    <connect-card/>
</template>
<script>

import HeroView from "@/modules/miners/Components/HeroView.vue";
import AboutMinersView from "@/modules/miners/Components/AboutMinersView.vue";
import ourOffer from "@/modules/miners/Components/OurOffer.vue";
import PersonalAreaCard from "@/modules/hosting/Components/PersonalAreaCard.vue";
import MobileAppCard from "@/modules/hosting/Components/MobileAppCard.vue";
import GuaranteeCard from "@/modules/hosting/Components/GuaranteeCard.vue";
import CommunityCard from "@/modules/miners/Components/CommunityCard.vue";
import ConnectCard from "@/modules/hosting/Components/ConnectCard.vue";
import {NavMessages} from "@/modules/navs/lang/NavMessages";

export default {
    name: "miners-page",
    components: {
        HeroView,
        AboutMinersView,
        ourOffer,
        PersonalAreaCard,
        MobileAppCard,
        GuaranteeCard,
        CommunityCard,
        ConnectCard,
    },
    i18n: {
        sharedMessages: NavMessages,
    },
    watch: {
        "$i18n.locale"() {
            document.title = this.$t("nav_links.miners");
        },
    },
    mounted() {
        document.title = this.$t("nav_links.miners");
    }
};
</script>
<style scoped>
.first-text {
    flex-direction: column;
}

.miners-content {
    width: 660px;
    height: 381px;
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 55px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 66px */
    text-transform: uppercase;
    display: flex;
    flex-direction: column;
    align-items: center;
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

.text-mining {
    margin-right: 130px;
}

.text-bitcoin {
    margin-left: 211px;
}

.get-consultation {
    display: flex;
    width: 480px;
    height: 56px;
    padding: 8px 20px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 8px 20px;
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.6);
    background: var(--gray-480, rgba(13, 13, 13, 0.8));
    cursor: pointer;
}

.article-hosting {
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .miners-content {
        font-size: 36px;
        line-height: 120%; /* 43.2px */
        width: 400px;
    }

    .get-consultation {
        width: 400px;
    }
}

@media (max-width: 450px) {
    .miners-content {
        font-size: 22px;
        width: 322px;
        height: auto;
    }

    .get-consultation {
        width: 90vw;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        margin-top: 70px;
        line-height: 120%; /* 14.4px */
        padding: 8px 20px;
        height: 40px;
    }

    .footer-hosting {
        padding: 40px 16px;
    }

    .text-mining {
        margin-right: 52px;
    }

    .text-bitcoin {
        margin-left: 84px;
    }
}
</style>
