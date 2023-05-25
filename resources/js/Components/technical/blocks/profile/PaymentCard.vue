<template>
    <div class="wrap__block wrap__column">
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
import BtcCalculator from "@/Components/UI/profile/BTCCalculator.vue";

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
.wrap__block {
    min-height: 0 !important;
    @media (max-width: 991.98px) {
        padding: 12px 20px;
    }
    @media (max-width: 767.98px) {
        gap: 8px;
        background-color: transparent;
        padding: 0 !important;
        display: flex !important;
    }
}
</style>
