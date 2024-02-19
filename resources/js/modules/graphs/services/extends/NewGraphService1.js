import * as d3 from "d3";
import { ValidateDataService } from "@/modules/graphs/services/extends/ValidateDataService";
import {TooltipContentService} from "resources/js/modules/graphs/services/extends/TooltipContentService";
import {TooltipNavigationService} from "resources/js/modules/graphs/services/extends/TooltipNavigationService";

export class NewGraphService {
    graphData = {};
    containerHeight = null;

    x = null;
    y = null;
    svg = null;

    mouseX = null;

    // mouseEventTimeout = null;
    // touchEventTimeout = null;

    constructor() {
        this.tooltipContentService = this.createTooltipContentService();
        this.tooltipNavigationService = this.createTooltipNavigationService();
    }

    /* Base setters start */

    setGraphData(newGraphData) {
        this.graphData = newGraphData;

        return this;
    }

    setContainerHeight(newContainerHeight) {
        this.containerHeight = newContainerHeight;

        return this;
    }

    setMouseX(newMouseX) {
        this.mouseX = newMouseX;

        return this;
    }

    /*
        Base setters end

        Creators start
    */

    createSvg() {
        this.svg = d3
            .select(this.chartHtml)
            .append("svg")
            .attr("width", "100%")
            .attr("height", this.containerHeight);

        return this;
    }

    createTooltipContentService() {
        return new TooltipContentService();
    }

    createTooltipNavigationService() {
        return new TooltipNavigationService();
    }

    /*
        Creators end

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
            .range([0, '100%']);

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

    mouseEnterEventAction() {
        
    }
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
