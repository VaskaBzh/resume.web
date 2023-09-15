<template>
    <div ref="chart" class="container-chart">
        <div ref="tooltip" class="tooltip" style="opacity: 0">Tooltip</div>
    </div>
    <div class="y-axis-container"></div>
</template>

<script>
import { GraphService } from "@/modules/graphs/services/GraphService";

export default {
    name: "main-line-graph",
    props: {
        graphData: Object,
    },
    data() {
        return {
            graph: this.graphData,
            services: new GraphService(
                this.$refs.chart,
                this.$refs.tooltip,
                this.graphData,
                this.$t
            ),
        };
    },
};
</script>

<style scoped></style>
