<template>
    <article class="article-hosting first-text hosting__section" ref="view">
        <div class="hosting__content">
            <span class="text-on">{{ $t("hosting_title[0]") }}</span>
            <span class="text-fifty">{{ $t("hosting_title[1]") }} <br/></span>
            <span class="text-increase">{{ $t("hosting_title[2]") }} <br/></span>
            <span class="text-income">{{ $t("hosting_title[3]") }} <br/></span>
            <span class="text-cvt">{{ $t("hosting_title[4]") }}</span>
        </div>
        <a href="https://t.me/allbtc_support" target="_blank">
            <landing-button class="get-consultation"
            >
                <template v-slot:text>{{ $t("hosting_button") }}</template>
            </landing-button>
        </a>
    </article>
</template>

<script>
import LandingButton from "@/modules/common/Components/UI/LandingButton.vue";
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";

export default {
    name: "hero-view",
    i18n: {
        sharedMessages: HostingMessage,
    },
    components: {LandingButton},
};
</script>

<style scoped>
.hosting__content {
    max-width: 607px;
    width: 100%;
    max-height: 317px;
    color: var(--gray-1100, #f5faff);
    font-feature-settings: "clig" off, "liga" off;
    font-family: Unbounded, serif;
    font-size: clamp(14px, 2.8vw, 44px);
    font-style: normal;
    font-weight: 600;
    line-height: 120%;
    text-transform: uppercase;
}

.text-income {
    display: flex;
    align-items: end;
    justify-content: end;
}

.text-fifty {
    font-size: clamp(32px, 8vw, 110px);
}

.get-consultation {
    margin-top: clamp(70px, 5vw, 50px);
    width: 100%;
    max-width: 534px;
}

@media (max-width: 768px) {
    .hosting__content {
        line-height: 120%; /* 43.2px */
        max-width: 400px;
    }
}

@media (max-width: 450px) {
    .hosting__content {
        max-width: 244px;
        height: auto;
    }
}
</style>
