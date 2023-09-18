<template>
    <div
        class="cabinet__block cabinet__block-light info"
    >
        <btc-calculator
            :title="$t('statistic.info_blocks.payment.titles[1]')"
            :BTC="todayAmount"
        />
        <btc-calculator
            :title="$t('statistic.info_blocks.payment.titles[0]')"
            :BTC="yesterdayAmount"
        />
        <btc-calculator
            :title="$t('statistic.info_blocks.payment.titles[0]')"
            :BTC="monthAmount"
        />
    </div>
</template>

<script>
import BtcCalculator from "@/modules/common/Components/Ui/BTCCalculator.vue";
import { mapGetters } from "vuex";

export default {
    name: "info-block",
    components: {
        BtcCalculator,
    },
    computed: {
        todayAmount() {
            let val = this.getAccount?.today_forecast || 0;
            return Number(val).toFixed(8);
        },
        yesterdayAmount() {
            let val = this.getAccount?.yesterday_amount || 0;
            return Number(val).toFixed(8);
        },
        monthAmount() {
            let val = this.getAccount?.yesterday_amount || 0;
            return Number(val).toFixed(8);
        },
        ...mapGetters([
            "getAccount",
        ]),
    }
}
</script>

<style scoped>
.info {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
</style>
