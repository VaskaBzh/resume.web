<template>
	<div ref="chart" class="container-chart">
		<div ref="tooltip" class="tooltip" style="opacity: 0">Tooltip</div>
	</div>
</template>

<script>
import { ColumnGraphService } from "../services/ColumnGraphService";

export default {
	name: "main-column-graph",
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
	// watch: {
	// 	"$refs.chart"(newChartHtml) {
	// 		this.service.setChartHtml(newChartHtml).dropGraph();
	// 		this.graphInit();
	// 	},
	// 	"$refs.tooltip"(newTooltipHtml) {
	// 		this.service.setTooltipHtml(newTooltipHtml).dropGraph();
	// 		this.graphInit();
	// 	},
	// 	graphData(newGraphData) {
	// 		this.service.setGraphData(newGraphData).dropGraph();
	// 		this.graphInit();
	// 	},
	// 	isDark(newIsDarkState) {
	// 		this.service.setDarkState(newIsDarkState).dropGraph();
	// 		this.graphInit();
	// 	},
	// 	viewportWidth(newViewportWidth) {
	// 		this.service.setIsMobileState(newViewportWidth).dropGraph();
	// 		this.graphInit();
	// 	},
	// },
	// methods: {
	// 	graphInit() {
	// 		if (this.graphData) {
	// 			// rgba(83, 177, 253, 0.15);
	// 			this.service
	// 				.setContainerHeight(this.height)
	// 				.createSvg()
	// 				.setDefaultX()
	// 				.setY()
	// 				.graphAppends()
	// 				.setTooltip();
	//
	// 			// if (this.service.isMobile) {
	// 			// 	this.service.setSvgEventsMobile();
	// 			// } else {
	// 				this.service.setSvgEvents().setTooltipEvents();
	// 			// }
	// 		}
	// 	}
	// },
	// mounted() {
	// 	this.graphInit();
	// }
}
</script>

<style scoped>
.container-chart {
	width: 100%;
}
</style>
