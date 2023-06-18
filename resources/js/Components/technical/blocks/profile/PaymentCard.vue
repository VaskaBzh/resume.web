<template>
    <div class="cabinet__block cabinet__block-light">
        <span class="title title-blue">{{
            $t("statistic.info_blocks.title")
        }}</span>
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
<style lang="scss" scoped></style>
