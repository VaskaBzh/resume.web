<template>
    <div
        class="cabinet__block cabinet__block-card cabinet__block-graph cabinet__block-light statistic__block"
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
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainProgressBar from "@/modules/common/Components/UI/MainProgressBar.vue";
import MainColumnGraph from "@/modules/graphs/Components/MainBarGraph.vue";
import WaitPreloader from "@/modules/preloader/Components/WaitPreloader.vue";

export default {
    name: "statistic-column-graph",
    components: {
        WaitPreloader,
        MainColumnGraph,
        MainProgressBar,
    },
    props: {
        waitGraphChange: Boolean,
        graph: Object,
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
