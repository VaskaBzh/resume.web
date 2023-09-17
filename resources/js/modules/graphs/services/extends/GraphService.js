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
            this.tooltip.selectAll("*").remove();
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
            .domain(d3.extent(this.graphData.dates, (d) => new Date(d)))
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

    setY() {
        this.y = d3
            .scaleLinear()
            .domain([
                0,
                d3.max(this.graphData.values) !== 0
                    ? d3.max(this.graphData.values) +
                      d3.max(this.graphData.values) * 0.2
                    : 120,
            ])
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
        this.tooltip = d3.select(this.tooltipHtml);

        return this;
    }

    setMouseX(mouseX) {
        this.mouseX = mouseX;
    }

    setContainerHeight(height) {
        this.containerHeight = height;

        if (this.isMobile && this.tooltip) {
            this.containerHeight = 246;
        }

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

    getAmount(nearestIndex) {
        let a = this.graphData.amount
            ? this.graphData.amount[nearestIndex]
            : "0";

        return this.graphData.amount
            ? `<span>${this.translate(
                  "tooltip.workers"
              )} <span class="value">${a}</span></span>`
            : ``;
    }

    getHashrate(values, unit) {
        return `<span>
                ${this.translate("tooltip.hash")}
                <span class="value">
                    ${this.tooltipFormatNumberWithUnit(values, unit)}
                </span>
            </span>`;
    }

    getRejectRate() {
        return `<span>${this.translate("tooltip.rejected")}
                        <span class="value">0.000%</span>
                    </span>`;
    }

    getDate(time) {
        return `<span class="time">
                        ${new Date(time).getUTCFullYear() + "."}
                        ${
                            new Date(time)
                                .getDate()
                                .toString()
                                .padStart(2, "0") + "."
                        }
                        ${(new Date(time).getMonth() + 1)
                            .toString()
                            .padStart(2, "0")}
                        ${new Date(time)
                            .getUTCHours()
                            .toString()
                            .padStart(2, "0")}:00
                    </span>`;
    }

    getUnit(nearestIndex) {
        return this.graphData.unit ? this.graphData.unit[nearestIndex] : "T";
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

    setContentTooltip(contentArray) {
        const content = [];
        let finillyContent = "";

        contentArray.forEach((contentElem) => {
            content.push(contentElem);
        });

        finillyContent = content.join("");

        this.contentTooltip = `
                <div class="tooltip-wrapper">
                    ${finillyContent}
                </div>
            `;
    }

    tooltipInit(event) {
        try {
            event?.touches
                ? (this.clientX = event.touches[0].clientX)
                : (this.clientX = event.clientX);

            this.setMouseX(
                this.clientX - this.svg.node().getBoundingClientRect().left
            );

            const nearestIndex = this.getNearestIndex();

            const values = this.graphData.values[nearestIndex];
            const unit = this.getUnit(nearestIndex);
            const time = this.graphData.dates[nearestIndex];

            this.setVerticalLine();

            let workers = this.getAmount(nearestIndex);
            let hashrate = this.getHashrate(values, unit);
            let reject = this.getRejectRate();
            let date = this.getDate(time);

            this.setContentTooltip([workers, hashrate, reject, date]);

            if (new Date(time).toLocaleTimeString() !== "Invalid Date") {
                this.tooltip
                    .style("opacity", 1)
                    .style(
                        this.getPosition()?.side,
                        this.getPosition()?.position + "px"
                    )
                    .html(this.contentTooltip);
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
            const padding = 8;

            const isLeft = this.mouseX < this.tooltipHtml.clientWidth - padding;
            const isRight =
                this.mouseX >
                this.chartHtml.clientWidth -
                    this.tooltipHtml.clientWidth -
                    padding;
            let width = this.tooltipHtml.clientWidth;

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

    validateYDomain() {
        return d3.max(this.graphData.values) !== 0
            ? d3.max(this.graphData.values) +
                  d3.max(this.graphData.values) * 0.2
            : 120;
    }

    validateXAxis() {
        return store.getters.viewportWidth <= 991.98 ? 8 : 12;
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
            else break; //position.x === touchX
        }

        return position;
    }

    updateTooltip(event, position) {
        this.tooltipInit(event);

        this.tooltip
            .style("top", position.y - this.tooltipHtml.clientHeight - 7 + "px")
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
