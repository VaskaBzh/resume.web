import { GraphService } from "@/modules/graphs/services/GraphService";
import { GraphDataTrait } from "@/traits/GraphDataTrait";
import * as d3 from "d3";

export class ColumnGraphService extends GraphService {
    BAR_PADDING = 8;

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

        this.graph.x.padding((this.BAR_PADDING / (this.x.bandwidth() / 100)) / 100)

        return this;
    }

    buildElements() {
        this.svg
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

    abstractLeaveAction() {}
    
    abstractMoveAction(mouseX, tickPosition) {
        if (!this.tooltip) {
            return this;
        }

        // tickPosition

        // this.tooltipService.tooltip.isLeft = this.tooltip.clientWidth > mouseX;
        //
        // const tooltipLeftMargin = this.isTooltipLeft
        //     ? this.TOOLTIP_MARGIN
        //     : -this.TOOLTIP_MARGIN;
        //
        // const savedRightPosition = this.isTooltipLeft
        //     ? 0
        //     : -this.tooltip.clientWidth;
        //
        // this.tooltipService.setTooltipPosition(
        //     barPosition.x + tooltipLeftMargin + savedRightPosition,
        //     barPosition.y - this.tooltip.clientHeight / 2
        // );
    }
    // tooltipIconHtml = null;
    // d3TooltipIcon = null;
    //
    // mining = null;
    // barData = null;
    //
    // /* Polymorph methods start */
    //
    // setX() {
    //     this.x = d3
    //         .scaleBand()
    //         .domain(this.graphData.dates.map((_, i) => i))
    //         .range([0, this.containerWidth])
    //         .padding(0.12);
    //
    //     return this;
    // }
    //
    // emptyValidationRules() {
    //     return d3.max(this.graphData.values) !== 0
    //         ? d3.max(this.graphData.values)
    //         : 0.005;
    // }
    //
    // /* Polymorph methods end */
    //
    // getBarHeight(yAxisData) {
    //     return this.containerHeight - this.y(yAxisData) + 8;
    // }
    //
    // appendBars() {
    //     this.svg
    //         .selectAll("rect")
    //         .data(this.graphData.values)
    //         .join("rect")
    //         .attr("x", (_, i) => this.x(i))
    //         .attr("y", (yAxisData) => this.y(yAxisData) - 2)
    //         .attr("width", this.x.bandwidth())
    //         .attr("height", this.getBarHeight.bind(this))
    //         .attr("ry", 6)
    //         .attr("rx", 6)
    //         .attr("class", "bar");
    //
    //     return this;
    // }
    //
    // graphAppends() {
    //     this.appendBars();
    //
    //     return this;
    // }
    //
    // /* Custom events methods start */
    //
    // mouseEnterEventAction(event, mouseX) {
    //     const position = this.getClosestPoint(mouseX);
    //     this.setMouseX(mouseX);
    //
    //     this.updateTooltip(event, position);
    // }
    //
    // mouseLeaveEventAction() {
    //     this.d3TooltipIcon.style("opacity", 0);
    //     this.dropBarsStyles();
    // }
    //
    // /* Custom events methods end */
    //
    // setMining(nearestIndex) {
    //     this.mining = this.graphData.values[nearestIndex];
    // }
    //
    // setActualValues(nearestIndex) {
    //     this.setDate(nearestIndex);
    //     this.setMining(nearestIndex);
    // }
    //
    // updateTooltip(event, position) {
    //     this.tooltipInit(event, position);
    //
    //     if (position?.y) {
    //         this.d3Tooltip
    //             .style(
    //                 "top",
    //                 position.y - this.tooltipHtml.clientHeight - 4 + "px"
    //             )
    //             .style("opacity", 1);
    //
    //         this.d3TooltipIcon
    //             .style("opacity", 1)
    //             .style("top", position.y - 4 + "px");
    //     }
    // }
    //
    // getPosition() {
    //     if (this.mouseX) {
    //         let tooltipWidth = this.tooltipHtml.clientWidth;
    //
    //         const isLeft = this.mouseX < tooltipWidth;
    //         const isRight = this.mouseX > this.containerWidth - tooltipWidth;
    //
    //         const tooltipLeftPosition =
    //             this.barData.index * this.barData.width +
    //             this.barData.width / 2;
    //
    //         return {
    //             side: "left",
    //             position: isLeft
    //                 ? 0
    //                 : isRight
    //                 ? this.containerWidth - tooltipWidth
    //                 : tooltipLeftPosition - tooltipWidth / 2,
    //         };
    //     }
    // }
    //
    // tooltipInit(event) {
    //     try {
    //         event?.touches
    //             ? (this.clientX = event.touches[0].clientX)
    //             : (this.clientX = event.clientX);
    //
    //         this.setMouseX(this.mouseX);
    //
    //         const nearestIndex = this.barData.index;
    //
    //         this.setActualValues(nearestIndex);
    //
    //         const position = this.getPosition();
    //
    //         if (
    //             new Date(
    //                 this.graphData.dates[nearestIndex]
    //             ).toLocaleTimeString() !== "Invalid Date"
    //         ) {
    //             this.d3Tooltip
    //                 .style("opacity", 1)
    //                 .style(position.side, position.position + "px");
    //
    //             const tooltipIconLeftPosition =
    //                 this.barData.index * this.barData.width +
    //                 this.barData.width / 2;
    //
    //             this.d3TooltipIcon
    //                 .style("left", tooltipIconLeftPosition)
    //                 .style("right", "auto");
    //
    //             if (
    //                 tooltipIconLeftPosition < 18 ||
    //                 tooltipIconLeftPosition > this.containerWidth - 18
    //             ) {
    //                 this.d3TooltipIcon.style("display", "none");
    //             } else {
    //                 this.d3TooltipIcon.style("display", "flex");
    //             }
    //         }
    //     } catch (error) {
    //         console.error(error);
    //     }
    // }
    //
    // dropBarsStyles() {
    //     const bars = this.svg.selectAll(".bar").nodes();
    //
    //     bars.forEach((bar) => {
    //         bar.setAttribute("style", "transition: all 0.1s ease 0s;");
    //     });
    // }
    //
    // getBarData(touchX) {
    //     const barWidth =
    //         this.containerWidth / this.svg.selectAll(".bar").nodes().length;
    //
    //     return {
    //         width: barWidth,
    //         index: Math.floor(touchX / barWidth),
    //     };
    // }
    //
    // getClosestPoint(touchX) {
    //     const bars = this.svg.selectAll(".bar").nodes();
    //     let closestBar = null;
    //
    //     this.barData = this.getBarData(touchX);
    //
    //     bars.forEach((bar, i) => {
    //         bar.setAttribute("style", "transition: all 0.1s ease 0s;");
    //
    //         if (this.barData.index === i) {
    //             closestBar = bar;
    //
    //             bar.setAttribute(
    //                 "style",
    //                 "fill: #2E90FA; transition: all 0.1s ease 0s;"
    //             );
    //         }
    //     });
    //
    //     if (closestBar) {
    //         const rect = closestBar.getBoundingClientRect();
    //
    //         return {
    //             x: touchX,
    //             y: this.containerHeight - rect.height,
    //         };
    //     }
    //
    //     return null;
    // }
}
