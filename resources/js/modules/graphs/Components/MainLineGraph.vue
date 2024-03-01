<template>
    <div ref="chart" :style="{ height: `${height}px` }" class="container-chart">
        <div
            v-if="facade.graphService?.tooltipContent"
            ref="tooltip"
            class="tooltip"
            :class="{ 'tooltip-left': Boolean(facade.graphService.tooltipOut) }"
            :style="{
                opacity: facade.graphService.tooltipOpacity,
                left: `${facade.graphService.tooltipPosition.left}px`,
                top: `${facade.graphService.tooltipPosition.top}px`,
            }"
        >
            <div class="tooltip__content">
                <p class="tooltip_text">
                    <span class="tooltip_label"
                        >{{ $t("tooltip.hash") }}:
                    </span>
                    <span class="tooltip_value">
                        {{ facade.graphService.tooltipContent.convertedValues }}
                        {{ facade.graphService.tooltipContent.unit }}h/s
                    </span>
                </p>
                <p
                    v-if="facade.graphService.tooltipContent.amount >= 0"
                    class="tooltip_text"
                >
                    <span class="tooltip_label"
                        >{{ $t("tooltip.workers") }}:
                    </span>
                    <span class="tooltip_value">
                        <span class="tooltip_value tooltip_value-green">
                            {{ facade.graphService.tooltipContent.amount }}
                        </span>
                    </span>
                </p>
                <p class="tooltip_text">
                    <span class="tooltip_label"
                        >{{ $t("tooltip.rejected") }}:
                    </span>
                    <span class="tooltip_value">0.000%</span>
                </p>
                <p class="tooltip_text tooltip_text-date">
                    <span class="tooltip_value">
                        {{ facade.graphService.tooltipContent.dayAt }}
                    </span>
                    <span class="tooltip_label">
                        {{ facade.graphService.tooltipContent.hourAt }}
                    </span>
                </p>
                <tooltip-icon class="tooltip_icon" />
            </div>
        </div>
    </div>
    <div class="y-axis-container"></div>
</template>

<script>
import TooltipIcon from "@/modules/graphs/icons/TooltipIcon.vue";

import { mapGetters } from "vuex";
import { GraphFacade } from "@/modules/graphs/facades/GraphFacade";

export default {
    name: "MainLineGraph",
    components: {
        TooltipIcon,
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
        ...mapGetters(["isDark", "viewportWidth"]),
    },
    watch: {
        "$refs.chart"(newChartHtml) {
            this.facade.rebuildGraph(newChartHtml, "line", this.graphData);
        },
        graphData(newGraphData) {
            this.facade.rebuildGraph(this.$refs.chart, "line", newGraphData);
        },
        height() {
            this.facade.rebuildGraph(this.$refs.chart, "line", this.graphData);
        },
        isDark() {
            this.facade.rebuildGraph(this.$refs.chart, "line", this.graphData);
        },
        viewportWidth() {
            this.facade.rebuildGraph(this.$refs.chart, "line", this.graphData);
        },
    },
    mounted() {
        this.facade.createGraph(this.$refs.chart, "line", this.graphData);
    },
    unmounted() {
        this.facade.dropGraph();
    },
};
</script>

<style scoped lang="scss">
.container-chart {
    margin-left: 48px;
}
.tooltip {
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-tooltip, rgba(44, 47, 52, 0.9));
    box-shadow: 0 2px 12px -1px rgba(16, 24, 40, 0.08);
    padding: 12px;
    min-width: 160px;
}
.tooltip__content {
    display: flex;
    flex-direction: column;
    gap: 4px;
    position: relative;
}
.tooltip {
    &-left {
        .tooltip_icon {
            right: auto;
            left: -20px;
            transform: rotate(180deg) translateY(8px);
        }
    }
    &_icon {
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        box-shadow: 0 2px 12px -1px rgba(16, 24, 40, 0.08);
    }
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
