<template>
    <div class="chart">
        <main-title class="headline">{{ $t("statistic.graph[0]") }}</main-title>
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
                    <p class="tooltip_text tooltip_text-mining">
                        <span class="tooltip_label">
                            {{ $t("statistic.graph[1]") }}:
                        </span>
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
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import TooltipBarIcon from "@/modules/graphs/icons/TooltipBarIcon.vue";

import { ColumnGraphService } from "@/modules/graphs/services/ColumnGraphService";
import { mapGetters } from "vuex";

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
    computed: {
        ...mapGetters(["viewportWidth"]),
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

                this.service.setSvgEvents().setTooltipEvents();
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
    background: var(--background-tooltip, rgba(44, 47, 52, 0.90));
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
    color: var(--text-teritary);
}
.tooltip_value {
    color: var(--text-secondary, #475467);
}
.tooltip_text-mining {
    display: inline-flex;
    justify-content: space-between;
    width: 100%;
}
</style>
