import * as d3 from "d3";

import { DomElementService } from "@/modules/common/services/extends/base/DomElementService";
import { StatesService } from "@/modules/common/services/extends/base/StatesService";
import { ValuesService } from "@/modules/common/services/extends/base/ValuesService";
import { D3ElementService } from "@/modules/graph/services/extends/base/D3ElementService";
import { GraphDataService } from "@/modules/graph/services/extends/base/GraphDataService";
import { TooltipContentService } from "@/modules/graph/services/extends/TooltipContentService";
import { DefaultStatesService } from "@/modules/common/services/extends/DefaultStatesService";
import { FormatValuesService } from "@/modules/graph/services/extends/FormatValuesService";
import { ValidateDataService } from "@/modules/graph/services/extends/ValidateDataService";

export class GraphService extends DefaultStatesService {
    constructor() {
        this.svg = this.createD3ElementService();
        this.axis = this.createD3ElementService();
        this.tooltip = this.createD3ElementService();

        this.isTooltipVisible = this.createStatesService();

        this.clientX = this.createD3ElementService();
        this.yBand = this.createD3ElementService();
        this.xAxis = this.createD3ElementService();
        this.yAxis = this.createD3ElementService();
        this.areaGenerator = this.createD3ElementService();
        this.lineGenerator = this.createD3ElementService();
        this.x = this.createD3ElementService();
        this.y = this.createD3ElementService();

        this.mouseX = this.createGraphDataService();
        this.graphData = this.createGraphDataService();

        this.containerHeight = this.createValuesService();

        this.tooltipContentService = this.createTooltipContentService();
        this.formatValuesService = this.createFormatValuesService();

        this.tooltipHtml = this.createDomElementService();
        this.chartHtml = this.createDomElementService();

        this.validateData = this.createValidateDataService();
    }

    createValidateDataService() {
        return new ValidateDataService();
    }

    createValuesService() {
        return new ValuesService();
    }

    createStatesService() {
        return new StatesService();
    }

    createGraphDataService() {
        return new GraphDataService();
    }

    createD3ElementService() {
        return new D3ElementService();
    }

    createFormatValuesService() {
        return new FormatValuesService();
    }

    createDomElementService() {
        return new DomElementService();
    }

    createTooltipContentService() {
        return new TooltipContentService();
    }

    setSvgDataFunction() {
        this.svg.getData = function () {
            return this.svg.node().getBoundingClientRect().left;
        }
    }

    setChartHtml(newChartHtml) {
        this.chartHtml.setElement(newChartHtml);

        return this;
    }

    setTooltipHtml(newTooltipHtml) {
        this.tooltipHtml.setElement(newTooltipHtml);

        return this;
    }

    createSvg() {
        this.svg.d3ActionSvgElement("select", this.chartHtml)
            .actionSvgElement("append", "svg")
            .actionSvgElement("width", "100%")
            .actionSvgElement("height", this.containerHeight);

        return this;
    }

    dropGraph() {
        this.svg.dropGraph();
        this.axis.dropGraph();
    }

    setGraphData(newGraphData) {
        this.graphData.setGraphData(newGraphData);

        return this;
    }

    setYBand() {
        this.yBand.d3ActionSvgElement("scaleBand")
            .actionSvgElement("domain", this.yAxis.scale().ticks())
            .actionSvgElement("range", [this.containerHeight, 0])

        return this;
    }

    setXAxis(ticks) {
        this.xAxis.d3ActionSvgElement("axisBottom", this.x)
            .actionSvgElement("ticks", ticks)
            .actionSvgElement("tickFormat", (d) => this.formatTime(new Date(d)));

        return this;
    }

    setYAxis(ticks) {
        this.yAxis.d3ActionSvgElement("axisLeft", this.y)
            .actionSvgElement("ticks", ticks)
            .actionSvgElement("tickFormat", (d, i) => this.formatNumberWithUnit(d, i));

        return this;
    }

    setDefaultX() {
        this.x.d3ActionSvgElement("scaleLinear")
            .actionSvgElement("domain", d3.extent(this.graphData.dates, (d) => d))
            .actionSvgElement("range", [0, this.chartHtml.offsetWidth]);

        return this;
    }

    setNumberX() {
        this.x.d3ActionSvgElement("scaleLinear")
            .actionSvgElement("domain", d3.extent(this.graphData.dates, (d, i) => i))
            .actionSvgElement("range", [0, this.chartHtml.offsetWidth]);

        return this;
    }

    setY() {
        this.y.d3ActionSvgElement("scaleLinear")
            .actionSvgElement("domain", [0, this.valueValidationRules()])
            .actionSvgElement("range", [this.containerHeight, 0]);

        return this;
    }

    setAreaGenerator() {
        this.areaGenerator.d3ActionSvgElement("area")
            .actionSvgElement("x", (d, i) => this.x(i))
            .actionSvgElement("y0", this.containerHeight)
            .actionSvgElement("y1", (d) => this.y(d))
            .actionSvgElement("curve", d3.curveBasis);

        return this;
    }

    setLineGenerator() {
        this.lineGenerator.d3ActionSvgElement("line")
            .actionSvgElement("x", (d, i) => this.x(i))
            .actionSvgElement("y", (d) => this.y(d))
            .actionSvgElement("curve", d3.curveBasis);

        return this;
    }

    setTooltip() {
        if (!this.tooltip) {
            this.tooltip.d3ActionSvgElement("select", this.tooltipHtml);
        }

        return this;
    }

    setMouseX() {
        this.setSvgDataFunction();

        this.mouseX.setValue(this.clientX.value - this.svg.getData());
    }

    setContainerHeight(height) {
        this.containerHeight.setValue(height);

        return this;
    }

    getNearestIndex() {
        return Math.round(this.x.invert(this.mouseX));
    }

    setVerticalLine() {
        this.svg.actionSvgElement("selectAll",".vertical-line")
            .actionSvgElement("x1", this.mouseX.value)
            .actionSvgElement("x2", this.mouseX.value)
            .actionSvgElement("y1", 0)
            .actionSvgElement("y2", this.containerHeight.value)
            .actionSvgElement("opacity", 1);
    }

    setActualValues(nearestIndex) {
        this.tooltipContentService.setUnit(nearestIndex);
        this.tooltipContentService.setHashrate(nearestIndex);
        this.tooltipContentService.setWorkers(nearestIndex);
        this.tooltipContentService.setDate(nearestIndex);
    }

    setOtherElements() {
        this.setVerticalLine();
    }

    tooltipInit(event) {
        try {
            event?.touches
                ? (this.clientX = event.touches[0].clientX)
                : (this.clientX = event.clientX);

            this.setMouseX();

            const nearestIndex = this.getNearestIndex();

            this.setActualValues(nearestIndex);

            this.setOtherElements();

            if (
                new Date(
                    this.graphData.dates[nearestIndex]
                ).toLocaleTimeString() !== "Invalid Date"
            ) {
                this.tooltip
                    .style("opacity", 1)
                    .style(
                        this.getPosition()?.side,
                        this.getPosition()?.position + "px"
                    );
            }
        } catch (error) {
            console.error(error);
        }
    }

    adjustValue(num) {
        if (num === 0) {
            if (d3.max(Object.values(this.graphData.values)) / 900000 > 1) {
                return { val: (num / 1000000).toFixed(2), unit: "E" };
            } else if (
                d3.max(Object.values(this.graphData.values)) / 900 >=
                1
            ) {
                return { val: (num / 1000).toFixed(2), unit: "P" };
            } else {
                return { val: Number(num).toFixed(2), unit: "T" };
            }
        }
        if (num / 900000 > 1) {
            return { val: (num / 1000000).toFixed(2), unit: "E" };
        } else if (num / 900 >= 1) {
            return { val: (num / 1000).toFixed(2), unit: "P" };
        } else {
            return { val: Number(num).toFixed(2), unit: "T" };
        }
    }

    formatNumberWithUnit(num, i) {
        let val = this.adjustValue(num, this.graphData.unit[i]);

        return (
            (String(val.val).split(".")[1] === "00"
                ? Number(val.val).toFixed(0)
                : Number(val.val).toFixed(1)) +
            " " +
            val.unit +
            "H"
        );
    }

    formatTime(date) {
        const hours = date.getHours().toString().padStart(2, "0");
        if (this.graphData.dates.length > 96) {
            const day = date.getDate().toString().padStart(2, "0");
            return `${day}/${(date.getUTCMonth() + 1)
                .toString()
                .padStart(2, "0")}`;
        } else {
            return `${hours.toString().padStart(2, "0")}:00`;
        }
    }

    getPosition() {
        if (this.mouseX) {
            const padding = 16;

            const isLeft = this.mouseX < this.tooltipHtml.clientWidth - padding;
            const isRight =
                this.mouseX >
                this.chartHtml.clientWidth -
                    this.tooltipHtml.clientWidth -
                    padding;
            let width = this.tooltipHtml.clientWidth;

            if (isLeft) {
                this.tooltip
                    .select(".tooltip_icon")
                    .style("left", "-20px")
                    .style("right", "auto")
                    .style("transform", "translateY(-50%) rotate(180deg)");
            } else {
                this.tooltip
                    .select(".tooltip_icon")
                    .style("right", "-20px")
                    .style("left", "auto")
                    .style("transform", "translateY(-50%)");
            }

            return {
                side: "left",
                position: isLeft
                    ? this.mouseX + padding
                    : isRight
                    ? this.mouseX - padding - this.tooltipHtml.clientWidth
                    : this.mouseX - padding - width,
            };
        }
    }

    validateXAxis() {
        // return store.getters.viewportWidth <= 991.98 ? 8 : 12;
        return 6;
    }

    setSvgEventsMobile() {
        this.svg.on("touchstart", (event) => {
            const touchX =
                event.touches[0].clientX -
                this.svg.node().getBoundingClientRect().left;
            const position = this.getClosestPoint(touchX);
            this.updateLineAndDot(event, position);
            this.updateTooltip(event, position);
        });

        this.svg.on("touchmove", (event) => {
            const touchX =
                event.touches[0].clientX -
                this.svg.node().getBoundingClientRect().left;
            const position = this.getClosestPoint(touchX);
            this.updateLineAndDot(event, position);
            this.updateTooltip(event, position);
        });

        this.svg.on("touchend", () => {
            this.tooltip.style("opacity", 0);
            this.svg.selectAll(".vertical-line").style("opacity", 0);
            this.svg.selectAll(".dot").style("opacity", 0); // Прячем точку, когда мышь покидает область графика
        });
    }

    getClosestPoint(touchX) {
        const pathNode = this.svg.select(".main_line").node();
        let beginning = 0,
            end = pathNode.getTotalLength();
        let position = null;

        while (true) {
            const target = Math.floor((beginning + end) / 2);
            position = pathNode.getPointAtLength(target);
            if (
                (target === end || target === beginning) &&
                position.x !== touchX
            ) {
                break;
            }
            if (position.x > touchX) end = target;
            else if (position.x < touchX) beginning = target;
            else break;
        }

        return position;
    }

    updateTooltip(event, position) {
        this.tooltipInit(event);

        this.tooltip
            .style(
                "top",
                position.y - this.tooltipHtml.clientHeight / 2 - 1 + "px"
            )
            .style("opacity", 1);
    }

    updateLineAndDot(event, position) {
        this.svg
            .selectAll(".dot")
            .attr("cx", position.x)
            .attr("cy", position.y)
            .style("opacity", 1);

        this.svg
            .selectAll(".vertical-line")
            .attr("x1", position.x)
            .attr("x2", position.x)
            .style("opacity", 1);
    }

    setSvgEvents() {
        this.svg.on("mousemove", (event) => {
            const mouseX = d3.pointer(event)[0];
            const position = this.getClosestPoint(mouseX);
            this.updateLineAndDot(event, position);
            this.updateTooltip(event, position);
        });

        this.svg.on("mouseleave", () => {
            this.tooltip.style("opacity", 0);

            this.svg.selectAll(".vertical-line").style("opacity", 0);

            this.svg.selectAll(".dot").style("opacity", 0);
        });

        return this;
    }

    setTooltipEvents() {
        this.tooltip.on("mousemove", () => this.tooltip.style("opacity", 1));
        this.tooltip.on("mouseleave", () => this.tooltip.style("opacity", 0));

        return this;
    }
}
