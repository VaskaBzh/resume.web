<template>
    <div class="card" ref="card">
        <div class="card_icon" v-html="content.svg"></div>
        <p class="text text-gray card_text">{{ content.text }}</p>
        <span class="card_value">{{
            Number(cardService.cardValue) === 0 ? "-" : cardService.cardValue
        }}</span>
    </div>
</template>

<script>
import { ReferralStatsCards } from "../../services/ReferralStatsCards";

export default {
    name: "stats-card",
    props: {
        content: Object,
    },
    data() {
        return {
            cardService: new ReferralStatsCards(this.content.value),
        };
    },
    watch: {
        "content.value"(newValue, oldValue) {
            this.cardService.setHtmlCard(this.$refs.card);

            this.cardService.cardsIndex(newValue, oldValue);
        },
    },
    mounted() {}


};
</script>

<style scoped lang="scss">
.card {
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.5s ease 0s;
    &_icon {
        margin-bottom: 8px;
        svg {
            width: 48px;
            height: 48px;
        }
    }
    &_text {
        font-size: 14px;
        white-space: nowrap;
    }
    &_value {
        color: var(--light-theme-gray-3, #818c99);
        font-size: 22px;
        font-weight: 500;
        line-height: 130%;
        white-space: nowrap;
    }
}
</style>
