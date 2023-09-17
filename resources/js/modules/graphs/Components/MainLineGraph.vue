<template>
    <div ref="chart" class="container-chart">
        <div ref="tooltip" class="tooltip" style="opacity: 0">Tooltip</div>
    </div>
    <div class="y-axis-container"></div>
</template>

<script>
import { LineGraphService } from "@/modules/graphs/services/LineGraphService";
import { mapGetters } from "vuex";

export default {
    name: "main-line-graph",
    props: {
        graphData: Object,
        height: Number,
    },
    data() {
        return {
            graph: this.graphData,
            service: new LineGraphService(this.graphData, this.$t),
        };
    },
    computed: {
        ...mapGetters(["isDark", "viewportWidth"]),
    },
    watch: {
        "$refs.chart"(newChartHtml) {
            this.service.setChartHtml(newChartHtml).dropGraph();
            this.graphInit();
        },
        "$refs.tooltip"(newTooltipHtml) {
            this.service.setTooltipHtml(newTooltipHtml).dropGraph();
            this.graphInit();
        },
        graphData(newGraphData) {
            this.service.setGraphData(newGraphData).dropGraph();
            this.graphInit();
        },
        isDark(newIsDarkState) {
            this.service.setDarkState(newIsDarkState).dropGraph();
            this.graphInit();
        },
        viewportWidth(newViewportWidth) {
            this.service.setIsMobileState(newViewportWidth).dropGraph();
            this.graphInit();
        },
    },
    methods: {
        graphInit() {
            if (this.graphData) {
                this.service
                    .setContainerHeight(this.height)
                    .createSvg()
                    .gradientInit()
                    .setDefaultX()
                    .setNumberX()
                    .setY()
                    .setAxis()
                    .setXAxis(
                        this.service.isMobile
                            ? 12
                            : this.service.validateXAxis()
                    )
                    .setYAxis(6)
                    .setLineGenerator()
                    .setAreaGenerator()
                    .setYBand()
                    .graphAppends()
                    .setTooltip();

                if (this.service.isMobile) {
                    this.service.setSvgEventsMobile();
                } else {
                    this.service.setSvgEvents().setTooltipEvents();
                }
            }
        },
    },
    mounted() {
        this.service
            .setChartHtml(this.$refs.chart)
            .setTooltipHtml(this.$refs.tooltip)
            .setDarkState(this.isDark)
            .setIsMobileState(this.viewportWidth);

        this.graphInit();
    },
    unmounted() {
        this.service.dropGraph();
    },
};
</script>

<style scoped></style>
