<template>
    <article class="article-miners first-text miners__section" ref="view">
        <div class="miners-content">
            <span class="">{{ $t("miners_title[0]") }} <br /></span>
            <span class="">{{ $t("miners_title[1]") }}<br /></span>
            <span class="text-mining">{{ $t("miners_title[2]") }} <br /></span>
            <span class="text-bitcoin">{{ $t("miners_title[3]") }} <br /></span>
        </div>
        <a
            href="https://t.me/allbtc_support"
            target="_blank"
            class="get-consultation"
            >{{ $t("button") }}</a
        >
    </article>
</template>

<script>
import ButtonBlue from "../../common/Components/UI/ButtonBlue.vue";
import { MinersMessage } from "../lang/MinersMessage";

export default {
    name: "HeroView",
    i18n: {
        sharedMessages: MinersMessage,
    },
    components: [ButtonBlue],
}
</script>


<style scoped>
.first-text {
    flex-direction: column;
}

.article-hosting {
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
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

    .text-mining {
        margin-right: 52px;
    }

    .text-bitcoin {
        margin-left: 84px;
    }
}
</style>
