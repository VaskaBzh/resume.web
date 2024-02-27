<template>
    <div class="chart chart-bar">
        <main-title class="headline">{{ $t("statistic.graph[0]") }}</main-title>
        <div ref="chart" class="container-chart">
            <div
                v-if="facade.graphService?.tooltipContent"
                ref="tooltip"
                class="tooltip"
                :class="{ 'tooltip-left': facade.graphService.isTooltipLeft }"
                :style="{
                    opacity: facade.graphService.tooltipOpacity,
                    left: `${facade.graphService.tooltipPosition.left}px`,
                    top: `${facade.graphService.tooltipPosition.top}px`,
                }"
            >
                <div class="tooltip__content">
                    <p class="tooltip_text">
                        <span class="tooltip_value"
                            >{{ facade.graphService.tooltipContent.dayAt }}</span
                        >
                    </p>
                    <p class="tooltip_text tooltip_text-mining">
                        <span class="tooltip_label">
                            {{ $t("statistic.graph[1]") }}:
                        </span>
                        <span class="tooltip_value">
                            {{ facade.graphService.tooltipContent.mining || 0 }} BTC
                        </span>
                    </p>
                </div>
            </div>
            <tooltip-bar-icon
                ref="tooltip_icon"
                class="tooltip_icon"
                style="opacity: 0"
            />
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import TooltipBarIcon from "@/modules/graphs/icons/TooltipBarIcon.vue";

import { mapGetters } from "vuex";
import { GraphFacade } from "@/modules/graphs/facades/GraphFacade";

export default {
    name: "MainColumnGraph",
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
            facade: new GraphFacade(),
        };
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
    watch: {
        "$refs.chart"(newChartHtml) {
            this.facade.rebuildGraph(
                newChartHtml,
                "bar",
                this.graphData
            );
        },
        graphData(newGraphData) {
            this.facade.rebuildGraph(
                this.$refs.chart,
                "bar",
                newGraphData
            );
        },
        height() {
            this.facade.rebuildGraph(
                this.$refs.chart,
                "bar",
                this.graphData
            );
        },
        viewportWidth() {
            this.facade.rebuildGraph(
                this.$refs.chart,
                "bar",
                this.graphData
            );
        },
    },
    mounted() {
        this.facade.createGraph(
            this.$refs.chart,
            "bar",
            this.graphData
        );
    },
    unmounted() {
        this.facade.dropGraph();
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
    width: 100%;
}
.tooltip {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-tooltip, rgba(44, 47, 52, 0.9));
    box-shadow: 0px 2px 12px -1px rgba(16, 24, 40, 0.08);
    padding: 12px;
    min-width: 208px;
    transition: all 0.2s ease 0s;
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
    transition: all 0.2s ease 0s;
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
:global(.bar) {
    transition: all 0.2s ease 0s;
}
</style>
