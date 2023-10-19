<template>
    <div class="faq__row">
        <div class="faq__head" :class="className" data-spoller>
            <landing-title class="faq_title" tag="h2">
                <span class="faq_subtitle" v-show="preTitle">
                    {{ preTitle }}
                </span>
                {{ title }}
            </landing-title>
        </div>
        <landing-text class="faq_text">{{ text }}</landing-text>
    </div>
</template>

<script>
import LandingText from "@/modules/common/Components/UI/LandingText.vue";
import LandingTitle from "@/modules/common/Components/UI/LandingTitle.vue";
// import {closeOpacityTimeOut, showOpacityTimeOut} from "../../services/AnimationService";

export default {
    name: "faq-row",
    components: {LandingTitle, LandingText},
    props: {
        title: String,
        text: String,
        preTitle: String,
        className: String,
    },
};
</script>

<style scoped>
/* padding: clamp(20px, 2.8vw, 32px) clamp(16px, 2.8vw, 100px)*/
.faq__row {
    position: relative;
}

.faq_title {
    font-size: clamp(22px, 2.2vw, 65px);
    align-items: center;
    display: flex;
    gap: 6px;
    max-width: 1920px;
    width: 100%;
    padding: 0 clamp(16px, 5vw, 100px);
    margin: 0 auto;
}

@media (min-width: 768.98px) {
    .faq_title {
        text-align: right;
        justify-content: flex-end;
    }
}

@media (max-width: 479.98px) {
    .faq_title {
        flex-direction: column;
        align-items: flex-start;
    }
}

.faq_text {
    max-width: 530px;
    margin-right: auto;
    padding-top: clamp(20px, 2.8vw, 32px);
    padding-bottom: clamp(20px, 2.8vw, 32px);
}

@media (max-width: 991.98px) {
    .faq__row {
        flex-direction: column;
    }
}

@media (max-width: 767.98px) {
    .faq__row {
        gap: 10px;
    }

    .faq_subtitle {
        order: 2;
    }

    .faq_subtitle {
        padding-top: 0;
    }
}

.faq__head {
    align-items: center;
    display: flex;
    gap: 6px;
    padding: clamp(20px, 2.8vw, 32px) 0 clamp(20px, 2.8vw, 32px);
    position: relative;
    width: 100vw;
    left: 50%;
    transform: translateX(-50%);
}

.faq__block {
    display: flex;
    flex-direction: column;
    gap: clamp(25px, 5vw, 34px);
}

.faq_subtitle {
    color: var(--gray-3100, #d0d5dd);
    font-family: Unbounded, serif;
    font-size: clamp(4px, 2.8vw, 24px);
    font-weight: 400;
    line-height: 120%;
    text-transform: uppercase;
    margin-right: auto;
}

.faq__row:last-child::after {
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

/*
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
 */
</style>
