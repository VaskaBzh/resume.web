<template>
    <div
        class="cabinet__block onboarding_block cabinet__block-card cabinet__block-light info"
        :class="{
            'onboarding_block-target': instructionConfig.isVisible && instructionConfig.step === 3
        }"
    >
        <btc-calculator
            :title="$t('statistic.info_blocks.payment.titles[0]')"
            :BTC="todayAmount"
        />
        <btc-calculator
            :title="$t('statistic.info_blocks.payment.titles[1]')"
            :BTC="yesterdayAmount"
        />
        <btc-calculator
            :title="$t('statistic.info_blocks.payment.titles[2]')"
            :BTC="monthAmount"
        />
        <instruction-step
            @next="instructionConfig.nextStep()"
            @prev="instructionConfig.prevStep()"
            @close="instructionConfig.nextStep(6)"
            :step_active="3"
            :steps_count="instructionConfig.steps_count"
            :step="instructionConfig.step"
            :isVisible="instructionConfig.isVisible"
            text="texts.statistic[2]"
            title="titles.statistic[2]"
            className="onboarding__card-bottom"
        />
    </div>
</template>

<script>
import BtcCalculator from "@/modules/common/Components/UI/BTCCalculator.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";
import { mapGetters } from "vuex";

export default {
    name: "info-block",
    components: {
        BtcCalculator,
        InstructionStep,
    },
    props: {
        instructionConfig: Object,
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
            let val = this.getAccount?.today_forecast * 30 || 0;
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
