<template>
    <div ref="chart" class="container-chart">
        <div ref="tooltip" class="tooltip" style="opacity: 1">
            <div class="tooltip__content">
                <p class="tooltip_text">
                    <span class="tooltip_label">{{ $t("tooltip.hash") }}: </span>
                    <span class="tooltip_value">
                        {{ service.hashrate }} {{ service.unit }}h/s
                    </span>
                </p>
                <p class="tooltip_text">
                    <span class="tooltip_label">{{ $t("tooltip.workers") }}: </span>
                    <span class="tooltip_value">
                    <span class="tooltip_value tooltip_value-green">
                        {{ service.workersCountActive }}
                    </span>
                </span>
                </p>
                <p class="tooltip_text">
                    <span class="tooltip_label">{{ $t("tooltip.rejected") }}: </span>
                    <span class="tooltip_value">0.000%</span>
                </p>
                <p class="tooltip_text tooltip_text-date">
                    <span class="tooltip_value">
                        {{ service.fullDate }}
                    </span>
                        <span class="tooltip_label">
                        {{ service.time }}
                    </span>
                </p>
                <tooltip-icon class="tooltip_icon" />
            </div>
        </div>
    </div>
    <div class="y-axis-container"></div>
</template>

<script>
import { LineGraphService } from "@/modules/graphs/services/LineGraphService";
import { mapGetters } from "vuex";
import TooltipIcon from "../icons/TooltipIcon.vue";

export default {
    name: "main-line-graph",
    components: {
        TooltipIcon,
    },
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
                    .setY()
                    .setAxis()
                    .setXAxis(
                        this.service.isMobile
                            ? 12
                            : this.service.validateXAxis()
                    )
                    .setNumberX()
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

<style scoped>
.container-chart {
    margin-left: 48px;
}
.tooltip {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--main-gohan, #FFF);
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
    padding: 12px;
    min-width: 160px;
}
.tooltip__content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: relative;
}
.tooltip_icon {
    position: absolute;
    right: -20px;
    top: 50%;
    transform: translateY(-50%);
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
}
.tooltip_text {
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-weight: 600;
    line-height: 16px;
}
.tooltip_label {
    color: var(--text-teritary-day, #98A2B3);
}
.tooltip_value {
    color: var(--text-secondary-day, #475467);
}
.tooltip_value-green {
    color: var(--status-succesfull, #1FB96C);
}
.tooltip_value-red {
    color: var(--status-failed, #F1404A);
}
.tooltip_text-date {
    margin-top: 8px;
    display: inline-flex;
    justify-content: space-between;
}
</style>