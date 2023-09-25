import store from "@/store";
import * as d3 from "d3";

export class GraphService {
    constructor(graphData, translate) {
        this.svg = null;
        this.mouseX = null;
        this.clientX = null;
        this.axis = null;
        this.tooltip = null;
        this.yBand = null;
        this.xBand = null;
        this.xAxis = null;
        this.yAxis = null;
        this.areaGenerator = null;
        this.lineGenerator = null;
        this.x = null;
        this.y = null;

        this.fullDate = null;
        this.time = null;
        this.hashrate = null;
        this.workersCountActive = null;
        this.unit = null;

        this.contentTooltip = null;

        this.translate = translate;

        this.tooltipHtml = null;
        this.chartHtml = null;
        this.graphData = graphData;

        this.containerWidth = 0;
        this.containerHeight = 0;

        this.isMobile = false;
        this.isDark = false;

        this.setDarkState();
        this.setIsMobileState();
    }

    setChartHtml(newChartHtml) {
        this.chartHtml = newChartHtml;

        return this;
    }

    setTooltipHtml(newTooltipHtml) {
        this.tooltipHtml = newTooltipHtml;

        return this;
    }

    setGraphData(newGraphData) {
        this.graphData = newGraphData;

        return this;
    }

    setIsMobileState(newViewportWidth = store.getters.viewportWidth) {
        this.isMobile = newViewportWidth <= 767.98;

        return this;
    }

    setDarkState(isDarkState = store.getters.isDark) {
        this.isDark = isDarkState;

        return this;
    }

    dropGraph() {
        if (this.svg) {
            this.svg.selectAll("*").remove();
            this.axis.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        }
    }

    setYBand() {
        this.yBand = d3
            .scaleBand()
            .domain(this.yAxis.scale().ticks())
            .range([this.containerHeight, 0]);

        return this;
    }

    setAxis() {
        this.axis = d3.select(".y-axis-container");

        return this;
    }

    setXAxis(ticks) {
        this.xAxis = d3
            .axisBottom(this.x)
            .ticks(ticks)
            .tickFormat((d) => this.formatTime(new Date(d)));

        return this;
    }

    setYAxis(ticks) {
        this.yAxis = d3
            .axisLeft(this.y)
            .ticks(ticks)
            .tickFormat((d, i) => this.formatNumberWithUnit(d, i));

        return this;
    }

    setDefaultX() {
        this.x = d3
            .scaleLinear()
            .domain(d3.extent(this.graphData.dates, (d) => d))
            .range([0, this.chartHtml.offsetWidth]);

        return this;
    }

    setNumberX() {
        this.x = d3
            .scaleLinear()
            .domain(d3.extent(this.graphData.dates, (d, i) => i))
            .range([0, this.chartHtml.offsetWidth]);

        return this;
    }

    emptyValidationRules() {
        return d3.max(this.graphData.values) !== 0
            ? d3.max(this.graphData.values) +
                  d3.max(this.graphData.values) * 0.2
            : 120;
    }

    setY() {
        this.y = d3
            .scaleLinear()
            .domain([0, this.emptyValidationRules()])
            .range([this.containerHeight, 0]);

        return this;
    }

    setAreaGenerator() {
        this.areaGenerator = d3
            .area()
            .x((d, i) => this.x(i))
            .y0(this.containerHeight)
            .y1((d) => this.y(d))
            .curve(d3.curveBasis);

        return this;
    }

    setLineGenerator() {
        this.lineGenerator = d3
            .line()
            .x((d, i) => this.x(i))
            .y((d) => this.y(d))
            .curve(d3.curveBasis);

        return this;
    }

    setTooltip() {
        if (!this.tooltip) this.tooltip = d3.select(this.tooltipHtml);

        return this;
    }

    setMouseX() {
        this.mouseX =
            this.clientX - this.svg.node().getBoundingClientRect().left;
    }

    setContainerHeight(height) {
        this.containerHeight = height;

        return this;
    }

    tooltipFormatNumberWithUnit(num, i) {
        return (
            this.adjustValue(num, this.graphData.unit[i]).val +
            " " +
            this.adjustValue(num, this.graphData.unit[i]).unit +
            "H"
        );
    }

    setDate(nearestIndex) {
        const date = new Date(this.graphData.dates[nearestIndex]);

        this.fullDate = date.getUTCFullYear();
        this.time =
            date.getDate().toString().padStart(2, "0") +
            "." +
            (date.getMonth() + 1).toString().padStart(2, "0");
    }

    setUnit(nearestIndex) {
        this.unit = this.graphData.unit
            ? this.graphData.unit[nearestIndex]
            : "T";
    }

    setHashrate(nearestIndex) {
        this.hashrate = this.graphData.values[nearestIndex];
    }

    setWorkers(nearestIndex) {
        if (this.graphData.amount)
            this.workersCountActive = this.graphData.amount[nearestIndex];
    }

    getNearestIndex() {
        return Math.round(this.x.invert(this.mouseX));
    }

    setVerticalLine() {
        this.svg
            .selectAll(".vertical-line")
            .attr("x1", this.mouseX)
            .attr("x2", this.mouseX)
            .attr("y1", 0)
            .attr("y2", this.containerHeight)
            .style("opacity", 1);
    }

    setActualValues(nearestIndex) {
        this.setUnit(nearestIndex);
        this.setHashrate(nearestIndex);
        this.setWorkers(nearestIndex);
        this.setDate(nearestIndex);
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
        if (this.graphData.dates.length > 24) {
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

    createSvg() {
        this.svg = d3
            .select(this.chartHtml)
            .append("svg")
            .attr("width", "100%")
            .attr("height", this.containerHeight);

        return this;
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

            this.svg.selectAll(".dot").style("opacity", 0); // Прячем точку, когда мышь покидает область графика
        });

        return this;
    }

    setTooltipEvents() {
        this.tooltip.on("mousemove", () => this.tooltip.style("opacity", 1));
        this.tooltip.on("mouseleave", () => this.tooltip.style("opacity", 0));

        return this;
    }
}
