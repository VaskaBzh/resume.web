import { GraphService } from "@/modules/graphs/services/GraphService";
import { GraphDataTrait } from "@/traits/GraphDataTrait";
import * as d3 from "d3";

export class ColumnGraphService extends GraphService {
    BAR_PADDING = 8;

    bars = null;
    tooltipIcon = null;

    get barElems() {
        return this.bars._groups[0];
    }

    setGraphY() {
        const graphDataTrait = GraphDataTrait;

        graphDataTrait.setPercentPadding(0).setMaxValue(0.005);

        this.graph.y = d3.scaleLinear(
            [0, graphDataTrait.domainValueValidation(this.graphData.values)],
            [this.graphElem.clientHeight, 0]
        );

        return this;
    }

    setGraphX() {
        this.graph.x = d3
            .scaleBand()
            .domain(this.graphData.dates.map((_, i) => i))
            .range([0, this.graphElem.clientWidth]);

        this.graph.x.paddingInner((this.BAR_PADDING / (this.x.bandwidth() / 100)) / 100)

        return this;
    }

    buildElements() {
        this.bars = this.svg
            .selectAll("rect")
            .data(this.graphData.values)
            .join("rect")
            .attr("x", (_, i) => this.x(i))
            .attr("y", (yAxisData) => this.y(yAxisData) + 2)
            .attr("width", this.x.bandwidth())
            .attr("height", (yAxisData) => this.graphElem.clientHeight - this.y(yAxisData) + 8)
            .attr("ry", 6)
            .attr("rx", 6)
            .attr("class", "bar");
    }

    setSideElements(graphElement) {
        this.tooltipIcon = graphElement.querySelector(".tooltip_icon")
    }

    abstractLeaveAction() {
        this.barElems.forEach((barElem) => barElem.removeAttribute("style"));
        this.tooltipIcon.style.opacity = 0;
    }

    abstractMoveAction(mouseX, tickPosition) {
        if (!this.tooltip) {
            return this;
        }

        this.barElems.forEach((barElem) => barElem.removeAttribute("style"));
        this.barElems[tickPosition].style.fill = "#2E90FA";

        const barHeight = this.barElems[tickPosition].getBoundingClientRect().height;
        const barWidth = this.graphElem.clientWidth / this.graphData.values.length;

        this.tooltipService.tooltip.isOut = "";

        if (this.tooltip.clientWidth > mouseX) {
            this.tooltipService.tooltip.isOut = "left";
        }
        if (mouseX > this.graphElem.clientWidth - this.tooltip.clientWidth) {
            this.tooltipService.tooltip.isOut = "right";
        }

        const savedPosition = this.tooltipOut === "left"
            ? 0
            : this.tooltipOut === "right"
                ? this.graphElem.clientWidth - this.tooltip.clientWidth
                : ((tickPosition * barWidth) + (barWidth / 2)) - (this.tooltip.clientWidth / 2);

        this.tooltipIcon.style.cssText = `opacity: 1; left: ${(tickPosition * barWidth) + (barWidth / 2)}; top: ${this.graphElem.clientHeight - barHeight};`;

        this.tooltipService.setTooltipPosition(
            savedPosition,
            this.graphElem.clientHeight - barHeight - this.tooltip.clientHeight
        );
    }
}
