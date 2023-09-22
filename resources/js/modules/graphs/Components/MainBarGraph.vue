<template>
    <div class="chart">
        <main-title class="headline">
            График дохода за месяц
        </main-title>
        <div ref="chart" class="container-chart">
            <div ref="tooltip" class="tooltip" style="opacity: 0">Tooltip</div>
        </div>
    </div>
</template>

<script>
import { ColumnGraphService } from "../services/ColumnGraphService";
import MainTitle from "../../common/Components/UI/MainTitle.vue";

export default {
	name: "main-column-graph",
    components: {
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
					this.service.setBarSvgEvents().setTooltipEvents();
				// }
			}
		}
	},
	mounted() {
        this.service
            .setChartHtml(this.$refs.chart)
            .setTooltipHtml(this.$refs.tooltip)
            .setDarkState(this.isDark)
            .setIsMobileState(this.viewportWidth);

		this.graphInit();
	}
}
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
</style>
