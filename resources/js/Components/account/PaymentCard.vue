<template>
    <div class="payment-card">
        <btc-calculator
            :title="this.titleFirst"
            :BTC="this.BTCValueFirst"
            :icon="this.iconFirst"
        />
        <btc-calculator
            :title="this.titleSecond"
            :BTC="this.BTCValueSecond"
            :icon="this.iconSecond"
        />
    </div>
</template>
<script>
import BtcCalculator from "@/Components/UI/BTCCalculator.vue";

export default {
    components: { BtcCalculator },
    props: {
        titleFirst: String,
        titleSecond: String,
        BTCValueFirst: Number,
        BTCValueSecond: Number,
        iconFirst: Number,
        iconSecond: Number,
    },
};
</script>
<style lang="scss" scoped>
.payment-card {
    @media (min-width: 767.98px) {
        width: 100%;
        background: #ffffff;
        border-radius: 21px;
        padding: 24px;
        gap: 24px;
    }
    gap: 8px;
    display: flex;
    flex-direction: column;
    width: 100%;
    background-color: transparent;
    padding: 0;
}
</style>
