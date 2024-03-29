import { GraphService } from "@/modules/graphs/services/GraphService";
import { GraphDataTrait } from "@/traits/GraphDataTrait";
import * as d3 from "d3";
import store from "@/store";

export class ColumnGraphService extends GraphService {
    BAR_PADDING = 1;

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

        this.graph.x.paddingInner(
            this.BAR_PADDING / (this.x.bandwidth() / 100) / 100
        );

        return this;
    }

    buildElements() {
        this.bars = this.svg
            .selectAll("rect")
            .data(this.graphData.values)
            .join("rect")
            .attr("x", (_, i) => this.x(i))
            .attr(
                "y",
                (yAxisData) => this.y(yAxisData) + (this.y(yAxisData) ? -6 : 6)
            )
            .attr("width", this.x.bandwidth())
            .attr(
                "height",
                (yAxisData) =>
                    this.graphElem.clientHeight - this.y(yAxisData) + 12
            )
            .attr("ry", 6)
            .attr("rx", 6)
            .attr("class", "bar");

        setTimeout(() => {
            this.bars.attr("class", "bar bar-transition");
        }, 10);
    }

    setSideElements(graphElement) {
        this.tooltipIcon = graphElement.querySelector(".tooltip_icon");
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

        const barHeight =
            this.barElems[tickPosition].getBoundingClientRect().height;
        const barWidth =
            this.graphElem.clientWidth / this.graphData.values.length;

        const dynamicTooltipPosition =
            tickPosition * barWidth +
            barWidth / 2 -
            this.tooltip.clientWidth / 2;
        const dynamicIconPosition = (position) =>
            position * barWidth + barWidth / 2;

        this.tooltipService.tooltip.isOut = "";

        if (dynamicTooltipPosition < 0) {
            this.tooltipService.tooltip.isOut = "left";
        }
        if (
            dynamicTooltipPosition >
            this.graphElem.clientWidth - this.tooltip.clientWidth
        ) {
            this.tooltipService.tooltip.isOut = "right";
        }

        const customBarHeight = barHeight + (barHeight > 12 ? -6 : 6);

        const savedLeftPosition =
                this.tooltipOut === "left"
                    ? -12
                    : this.tooltipOut === "right"
                        ? this.graphElem.clientWidth - this.tooltip.clientWidth + 12
                        : dynamicTooltipPosition;

        let savedTopPosition = 0;
        if (store.getters.viewportWidth >= 992) {
            savedTopPosition = this.graphElem.clientHeight - customBarHeight - this.tooltip.clientHeight;
        } else {
            savedTopPosition = -this.tooltip.clientHeight - 4;
        }

        const savedLeftPositionIcon = dynamicIconPosition(tickPosition);

        let savedTopPositionIcon = 0;
        if (store.getters.viewportWidth >= 992) {
            savedTopPositionIcon = this.graphElem.clientHeight - customBarHeight;
        } else {
            savedTopPositionIcon = -4;
        }

        this.tooltipIcon.style.cssText = `opacity: 1; left: ${savedLeftPositionIcon}; top: ${savedTopPositionIcon};`;

        this.tooltipService.setTooltipPosition(
            savedLeftPosition,
            savedTopPosition
        );
    }
}
