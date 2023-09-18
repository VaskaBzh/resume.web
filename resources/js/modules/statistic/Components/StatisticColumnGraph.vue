<template>
    <div
        class="cabinet__block cabinet__block-graph cabinet__block-light"
    >
        <main-progress-bar
            title="Начислено"
            hint="На вашем субаккаунте 0.00051380 BTC Автовыплата происходит при  балансе > 0.005 BTC"
            :progress="pendingAmount"
            :final="0.005"
            unit="BTC"
        />
        <main-column-graph
            :height="height"
            :graphData="graph"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainProgressBar from "../../common/Components/UI/MainProgressBar.vue";
import MainColumnGraph from "../../graphs/Components/MainColumnGraph.vue";

export default {
    name: "statistic-column-graph",
    components: {
        MainColumnGraph,
        MainProgressBar
    },
    data() {
        return {
            graph: {},
            height: 77,
        };
    },
    computed: {
        ...mapGetters(["viewportWidth", "getAccount"]),
        pendingAmount() {
            let sum = 0;
            if (Object.values(this.getAccount).length > 0) {
                sum = this.getAccount.pending_amount;
            }
            return Number(sum).toFixed(8);
        },
    }
}
</script>

<style scoped>

</style>
