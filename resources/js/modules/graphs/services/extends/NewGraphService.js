import * as d3 from "d3";
import { ValidateDataService } from "@/modules/graphs/services/extends/ValidateDataService";

export class NewGraphService {
    graphData = {};
    containerHeight = null;
    containerWidth = null;

    x = null;
    y = null;
    svg = null;
    chartHtml = null;

    d3Tooltip = null;
    tooltipHtml = null;
    fullDate = null;
    time = null;
    mouseX = null;
    clientX = null;
    // mouseEventTimeout = null;
    // touchEventTimeout = null;

    /* Base setters start */

    setGraphData(newGraphData) {
        this.graphData = newGraphData;

        return this;
    }

    setContainerHeight(newContainerHeight) {
        this.containerHeight = newContainerHeight;

        return this;
    }

    setContainerWidth(newContainerWidth = '100%') {
        this.containerWidth = newContainerWidth;

        return this;
    }

    setChartHtml(newChartHtml) {
        this.chartHtml = newChartHtml;

        return this;
    }

    setMouseX(newMouseX) {
        this.mouseX = newMouseX;

        return this;
    }

    /*
        Base setters end

        Creator start
    */

    createSvg() {
        this.svg = d3
            .select(this.chartHtml)
            .append("svg")
            .attr("width", "100%")
            .attr("height", this.containerHeight);

        return this;
    }

    createTooltip() {
        this.d3Tooltip = d3.select(this.tooltipHtml);

        return this;
    }

    /*
        Creator end

        Destroyer start
     */

    dropGraph() {
        if (this.svg) {
            this.svg.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        }

        return this;
    }

    /* Destroyer end */

    getNearestIndex() {
        return Math.round(this.x.invert(this.mouseX));
    }

    setX() {
        this.x = d3
            .scaleLinear()
            .domain(this.graphData.dates.map((_, i) => i))
            .range([0, this.containerWidth]);

        return this;
    }

    setY() {
        this.y = d3
            .scaleLinear()
            .domain([0, ValidateDataService.valueValidationRules(this.graphData.values)])
            .range([this.containerHeight, 0]);

        return this;
    }

    /* Events start */

    mouseEnterEventAction() {}
    mouseLeaveEventAction() {}

    setSvgEvents() {
        this.svg.on("mousemove", (event) => {
            const mouseX = d3.pointer(event)[0];

            this.mouseEnterEventAction(event, mouseX);
        });

        this.svg.on("mouseleave", () => {
            this.d3Tooltip.style("opacity", 0);

            this.mouseLeaveEventAction();
        });

        return this;
    }

    geyTouchX(event) {
        return event.touches[0].clientX -
            this.svg.node().getBoundingClientRect().left;
    }

    setMobileSvgEvents() {
        this.svg.on("touchstart", (event) => {
            const touchX = this.geyTouchX();

            this.mouseEnterEventAction(event, touchX);
        });

        this.svg.on("touchmove", (event) => {
            const touchX = this.geyTouchX();

            this.mouseEnterEventAction(event, touchX);
        });

        this.svg.on("touchend", () => {
            this.d3Tooltip.style("opacity", 0);

            this.mouseLeaveEventAction();
        });

        return this;
    }

    /* Events end */
}
