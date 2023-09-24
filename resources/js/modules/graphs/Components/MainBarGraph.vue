<template>
    <div class="chart">
        <main-title class="headline"> График дохода за месяц </main-title>
        <div ref="chart" class="container-chart">
            <div ref="tooltip" class="tooltip" style="opacity: 0">
                <div class="tooltip__content">
                    <p class="tooltip_text">
                        <span class="tooltip_value"
                            >{{ isNaN(service.time) ? "" : service.time }}.{{
                                isNaN(service.fullDate)
                                    ? ".."
                                    : service.fullDate
                            }}</span
                        >
                    </p>
                    <p class="tooltip_text tooltip_text-minnig">
                        <span class="tooltip_label"> Майнинг </span>
                        <span class="tooltip_value">
                            {{ service.mining || 0 }} BTC
                        </span>
                    </p>
                    <tooltip-bar-icon class="tooltip_icon" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ColumnGraphService } from "../services/ColumnGraphService";
import MainTitle from "../../common/Components/UI/MainTitle.vue";
import TooltipBarIcon from "../icons/TooltipBarIcon.vue";

export default {
    name: "main-column-graph",
    components: {
        TooltipBarIcon,
        MainTitle,
    },
    props: {
        graphData: Object,
        height: Number,
    },
    data() {
        return {
            graph: this.graphData,
            service: new ColumnGraphService(this.graphData, this.$t),
        };
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
                    .setY()
                    .setNumberX()
                    .graphAppends()
                    .setTooltip();

                // if (this.service.isMobile) {
                // 	this.service.setSvgEventsMobile();
                // } else {
                this.service.setSvgEvents().setTooltipEvents();
                // }
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
};
</script>

<style scoped>
.chart {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.container-chart {
    width: calc(100% - 18px);
    margin-right: 18px;
}
.tooltip {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-island, #fff);
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
    padding: 12px;
    min-width: 208px;
}
.tooltip__content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: relative;
}
.tooltip_icon {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: -20px;
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
}
.tooltip_text {
    font-family: NunitoSans, serif;
    font-size: 12px;
    font-weight: 600;
    line-height: 16px;
}
.tooltip_label {
    color: var(--text-teritary-day, #98a2b3);
}
.tooltip_value {
    color: var(--text-secondary, #475467);
}
.tooltip_value-green {
    color: var(--status-succesfull, #1fb96c);
}
.tooltip_value-red {
    color: var(--status-failed, #f1404a);
}
.tooltip_text-date {
    margin-top: 8px;
    display: inline-flex;
    justify-content: space-between;
}
</style>
