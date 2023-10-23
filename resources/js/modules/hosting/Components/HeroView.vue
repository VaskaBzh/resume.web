<template>
    <article class="article-hosting first-text hosting__section" ref="view">
        <div class="hosting__content">
            <span class="text-on">{{ $t("hosting_title[0]") }}</span>
            <span class="text-fifty">{{ $t("hosting_title[1]") }} <br/></span>
            <span class="text-increase">{{ $t("hosting_title[2]") }} <br/></span>
            <span class="text-income">{{ $t("hosting_title[3]") }} <br/></span>
            <span class="text-cvt">{{ $t("hosting_title[4]") }}</span>
        </div>
        <a
            href="https://t.me/allbtc_support"
            target="_blank"
            class="get-consultation"
        >
            {{ $t("button") }}
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
    font-size: 44px;
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
    display: flex;
    width: 480px;
    height: 56px;
    justify-content: center;
    align-items: center;
    gap: 10px;
    padding: 8px 20px;
    color: var(--gray-1100, #F5FAFF);
    font-family: Unbounded;
    font-size: 18px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 21.6px */
    text-transform: uppercase;
    border-radius: 40px;
    border: 1px solid rgba(192, 228, 255, 0.60);
    background: var(--gray-480, rgba(13, 13, 13, 0.80));
    cursor: pointer;
    margin-top: 5em;
}

@media (max-width: 1200px) {
    .hosting__content {
        text-align: center;
    }

    .text-income {
        display: block;
    }
}

@media (max-width: 768px) {
    .get-consultation {
        width: 400px;
    }

    .hosting__content {
        max-width: 400px;
        text-align: center;
        font-size: 36px;
        line-height: 120%;
        width: 400px;
    }
}

@media (max-width: 450px) {
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

    .hosting__content {
        max-width: 244px;
        height: auto;
        font-size: 22px;
    }
}
</style>
