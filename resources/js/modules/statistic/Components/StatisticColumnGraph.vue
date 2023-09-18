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
            :graphData="service.graph"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import MainProgressBar from "@/modules/common/Components/UI/MainProgressBar.vue";
import MainColumnGraph from "@/modules/graphs/Components/MainBarGraph.vue";
import {StatisticService} from "@/modules/statistic/service/StatisticService";

export default {
    name: "statistic-column-graph",
    components: {
        MainColumnGraph,
        MainProgressBar
    },
    data() {
        return {
            height: 77,
            service: new StatisticService(
                [0, 1],
                this.$t,
                30
            ),
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
    watch: {
        async 'service.offset'() {
            await this.service.barGraphIndex();
        },
        async getActive(newActiveId) {
            this.service.setGroupId(newActiveId);
            await this.service.barGraphIndex();
        },
        async getAccount() {
            await this.service.barGraphIndex();
        }
    },
    async mounted() {
        this.service.setGroupId(this.getActive);
        await this.service.barGraphIndex();
    }
}
</script>

<style scoped>

</style>
