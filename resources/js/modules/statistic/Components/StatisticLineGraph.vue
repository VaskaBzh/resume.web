<template>
    <div
        class="cabinet__block onboarding_block cabinet__block-graph cabinet__block-light"
        :class="{
            'onboarding_block-target':
                instructionConfig.isVisible && instructionConfig.step === 1,
        }"
    >
        <div class="cabinet__head graph__head">
            <main-title class="chart-title-statistic">
                {{ $t("statistic.chart.title") }}
            </main-title>
            <main-tabs
                :tabs="graphOffsetTabs"
                :active="interval"
                @getValue="$emit('getValue', $event)"
            />
        </div>
        <wait-preloader :wait="waitGraphChange" />
        <main-line-graph
            v-if="!waitGraphChange"
            :graph-data="graph"
            :height="height"
        />
        <instruction-step
            :step_active="1"
            :steps_count="instructionConfig.steps_count"
            :step="instructionConfig.step"
            :is-visible="instructionConfig.isVisible"
            text="texts.statistic[0]"
            title="titles.statistic[0]"
            class-name="onboarding__card-top"
            @next="instructionConfig.nextStep()"
            @prev="instructionConfig.prevStep()"
            @close="instructionConfig.nextStep(6)"
        />
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainTabs from "@/modules/common/Components/UI/MainTabs.vue";
import MainLineGraph from "@/modules/graphs/Components/MainLineGraph.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";
import InstructionStep from "@/modules/instruction/Components/InstructionStep.vue";

import { mapGetters } from "vuex";

export default {
    name: "StatisticLineGraph",
    components: {
        WaitPreloader,
        MainTitle,
        MainTabs,
        MainLineGraph,
        InstructionStep,
    },
    props: {
        waitGraphChange: Boolean,
        interval: String,
        graph: Object,
        instructionConfig: Object,
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
        graphOffsetTabs() {
            return [
                { title: `24 ${this.$t("hours")}`, value: "day" },
                { title: `7 ${this.$t("days")}`, value: "week" },
                { title: `1 ${this.$t("month")}`, value: "month" },
            ];
        },
        height() {
            if (!this.heightVal) {
                if (this.viewportWidth < 479.98) return 246;
                else if (this.viewportWidth < 767.98) return 246;
                else if (this.viewportWidth < 991.98) return 246;
                else if (this.viewportWidth < 1320.98) return 246;
                else return 448;
            } else {
                return this.heightVal;
            }
        },
    },
};
</script>

<style scoped>
.graph__head {
    flex-wrap: nowrap;
}

@media (max-width: 500px) {
    .chart-title-statistic {
        display: none;
    }
}
</style>
