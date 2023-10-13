<template>
    <div class="faq__row" ref="view">
        <div class="faq__block">
            <span class="faq_subtitle" v-show="preTitle">{{ preTitle }}</span>
            <landing-text class="faq_text">{{ text }}</landing-text>
        </div>
        <landing-title class="faq_title" tag="h2">{{ title }}</landing-title>
    </div>
</template>

<script>
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
import {closeOpacityTimeOut, showOpacityTimeOut} from "../../services/AnimationService";

export default {
    name: "faq-row",
    components: {LandingTitle, LandingText},
    props: {
        title: String,
        text: String,
        preTitle: String,
    },

};
</script>

<style scoped>
.faq__row {
    padding: clamp(20px, 5vw, 32px) clamp(16px, 5vw, 100px);
    display: flex;
    justify-content: space-between;
    cursor: pointer;
    width: 100%;
    position: relative;
}

@media (max-width: 767.98px) {
    .faq__row {
        flex-direction: column;
        gap: 10px;
    }

    .faq_title {
        order: -1;
    }

    .faq_subtitle {
        padding-top: 0;
    }
}

.faq__block {
    max-width: 530px;
    display: flex;
    flex-direction: column;
    gap: clamp(25px, 5vw, 34px);
}

.faq_subtitle {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: clamp(4px, 5vw, 24px);
    font-weight: 400;
    line-height: 120%;
    text-transform: uppercase;
    padding-top: 24px;
}

.faq__row::after {
    content: "";
    position: absolute;
    background: var(--gray-240, rgba(228, 231, 236, 0.4));
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 0.5px;
    width: 100vw;
}

.faq__row::before {
    content: "";
    position: absolute;
    background: var(--gray-240, rgba(228, 231, 236, 0.4));
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 0.5px;
    width: 100vw;
}

.faq_text {
    max-height: 0;
    transition: all 0.5s ease 0s, opacity 0.3s ease 0s;
    overflow: hidden;
    opacity: 0;
}

.faq__row:hover .faq_text {
    max-height: 250px;
    opacity: 1;
    transition: all 0.5s ease 0s, opacity 0.3s ease 0.1s;
}
</style>
