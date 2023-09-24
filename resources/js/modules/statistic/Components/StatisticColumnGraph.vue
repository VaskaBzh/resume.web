<template>
    <div
        class="cabinet__block cabinet__block-graph cabinet__block-light statistic__block"
    >
        <main-progress-bar
            title="Начислено"
            hint="На вашем субаккаунте 0.00051380 BTC Автовыплата происходит при  балансе > 0.005 BTC"
            :progress="pendingAmount"
            :final="0.005"
            unit="BTC"
        />
        <main-preloader
            :wait="waitGraphChange"
            :interval="35"
            :end="!waitGraphChange"
            :empty="false"
        />
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
import { StatisticService } from "@/modules/statistic/service/StatisticService";
import NoInfoWait from "../../../Components/technical/blocks/NoInfoWait.vue";
import MainPreloader from "@/modules/preloader/Components/MainPreloader.vue";

export default {
    name: "statistic-column-graph",
    components: {
        MainPreloader,
        MainColumnGraph,
        MainProgressBar,
        NoInfoWait,
    },
    props: {
        waitGraphChange: Boolean,
        graph: Object,
    },
    data() {
        return {
            height: 85,
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
