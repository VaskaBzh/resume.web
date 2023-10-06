<template>
    <div
        class="cabinet__block onboarding_block cabinet__block-card cabinet__block-graph cabinet__block-light statistic__block"
        :class="{
            'onboarding_block-target': instructionConfig.isVisible && instructionConfig.step === 4
        }"
    >
        <main-progress-bar
            :title="$t('statistic.graph[2]')"
            hint="На вашем субаккаунте 0.00051380 BTC Автовыплата происходит при  балансе > 0.005 BTC"
            :progress="pendingAmount"
            :final="0.005"
            unit="BTC"
        />
        <wait-preloader :wait="waitGraphChange" :interval="35" />
        <main-column-graph
            v-if="!waitGraphChange"
            :height="height"
            :graphData="graph"
        />
        <instruction-step
            @next="instructionConfig.nextStep()"
            @prev="instructionConfig.prevStep()"
            @close="instructionConfig.nextStep(6)"
            :step_active="4"
            :steps_count="instructionConfig.steps_count"
            :step="instructionConfig.step"
            :isVisible="instructionConfig.isVisible"
            text="texts.statistic[3]"
            title="titles.statistic[3]"
            className="onboarding__card-bottom"
        />
    </div>
</template>

<script>
import MainProgressBar from "@/modules/common/Components/UI/MainProgressBar.vue";
import MainColumnGraph from "@/modules/graphs/Components/MainBarGraph.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

import { mapGetters } from "vuex";

export default {
    name: "statistic-column-graph",
    components: {
        WaitPreloader,
        MainColumnGraph,
        MainProgressBar,
        InstructionStep,
    },
    props: {
        waitGraphChange: Boolean,
        graph: Object,
        instructionConfig: Object,
    },
    data() {
        return {
            height: 75,
        };
    },
    computed: {
        ...mapGetters(["viewportWidth", "getAccount", "getActive"]),
        pendingAmount() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.pending_amount;
            }
            return Number(sum).toFixed(8);
        },
    },
};
</script>

<style scoped>
.statistic__block {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
</style>
