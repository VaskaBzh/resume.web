import store from "@/store";
import * as d3 from "d3";

export class GraphService {
    constructor(chartHtml, tooltipHtml, graphData, translate) {
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

        this.translate = translate;

        this.tooltipHtml = tooltipHtml;
        this.chartHtml = chartHtml;
        this.graphData = graphData;

        this.containerWidth = 0;
        this.containerHeight = 0;

        this.isMobile = this.getMobileState();
        this.isDark = store.getters("isDark");
    }

    dropGraph() {
        if (this.svg) {
            this.svg.selectAll("*").remove();
            this.axis.selectAll("*").remove();
            this.tooltip.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        }
    }

    getMobileState() {
        return store.getters("viewportWidth") <= 767.98;
    }

    setDarkState() {
        this.isDark = store.getters("isDark");
    }

    setYBand() {
        this.yBand = d3
            .scaleBand()
            .domain(this.yAxis.scale().ticks())
            .range([this.containerHeight, 0]);
    }

    setAxis() {
        this.axis = d3.select(".y-axis-container");
    }

    setX() {
        this.x = d3
            .scaleLinear()
            .domain(d3.extent(this.graphData.dates, (d, i) => i))
            .range([0, this.containerWidth]);
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
    }

    setAreaGenerator() {
        this.areaGenerator = d3
            .area()
            .x((d, i) => this.x(i))
            .y0(this.containerHeight)
            .y1((d) => this.y(d))
            .curve(d3.curveBasis);
    }

    setLineGenerator() {
        this.lineGenerator = d3
            .line()
            .x((d, i) => this.x(i))
            .y((d) => this.y(d))
            .curve(d3.curveBasis);
    }

    setTooltip(tooltip) {
        this.tooltip = tooltip;
    }

    setMouseX(mouseX) {
        this.mouseX = mouseX;
    }

    setContainerHeight(height) {
        this.containerHeight = height;
    }

    setContainerWidth(width) {
        this.containerWidth = width;
    }

    tooltipInit(event, x) {
        try {
            event?.touches
                ? (this.clientX = event.touches[0].clientX)
                : (this.clientX = event.clientX);
            this.mouseX =
                this.clientX - this.svg.node().getBoundingClientRect().left;
            const nearestIndex = Math.round(x.invert(this.mouseX));
            const d = this.graphData.values[nearestIndex];
            const u = this.graphData.unit
                ? this.graphData.unit[nearestIndex]
                : "null";
            let a = this.graphData.amount
                ? this.graphData.amount[nearestIndex]
                : "0";
            const time = this.graphData.dates[nearestIndex];

            const verticalLineX = this.mouseX;

            this.svg
                .selectAll(".vertical-line")
                .attr("x1", verticalLineX)
                .attr("x2", verticalLineX)
                .attr("y1", 0)
                .attr("y2", this.containerHeight)
                .style("opacity", 1);

            const formatNumberWithUnit = (num, i) => {
                return (
                    this.adjustValue(num, this.graphData.unit[i]).val +
                    " " +
                    this.adjustValue(num, this.graphData.unit[i]).unit +
                    "H"
                );
            };

            const formatNumber = (num) => {
                return String(num).slice(0, 2) + " T";
            };

            let contentTooltip = null;
            let workers = this.graphData.amount
                ? `<span>${this.translate(
                      "tooltip.workers"
                  )} <span class="value">${a}</span></span>`
                : ``;

            if (this.graphType === "statistic") {
                contentTooltip = `<div class="tooltip-wrapper">
                                <span>${this.translate(
                                    "tooltip.hash"
                                )} <span class="value">${formatNumberWithUnit(
                    d,
                    u
                )}</span></span>
                                ${workers}
                                <span>${this.translate(
                                    "tooltip.rejected"
                                )} <span class="value">0.000%</span></span>
                                <span class="time">${
                                    new Date(time).getUTCFullYear() + "."
                                }${
                    new Date(time).getDate().toString().padStart(2, "0") + "."
                }${(new Date(time).getMonth() + 1)
                    .toString()
                    .padStart(2, "0")} ${new Date(time)
                    .getUTCHours()
                    .toString()
                    .padStart(2, "0")}:00</span>
                            </div>`;
            } else if (this.graphType === "complexity") {
                contentTooltip = `<div class="tooltip-wrapper">
                                <span>${this.translate(
                                    "tooltip.difficulty"
                                )}: <span class="value">${
                    this.graphType === "statistic"
                        ? this.formatNumberWithUnit(d, u)
                        : formatNumber(d)
                }</span></span>
                                <span class="time">${
                                    new Date(time).getUTCFullYear() + "."
                                }${
                    new Date(time).getDate().toString().padStart(2, "0") + "."
                }${(new Date(time).getMonth() + 1)
                    .toString()
                    .padStart(2, "0")}</span>
                            </div>`;
            }

            if (new Date(time).toLocaleTimeString() !== "Invalid Date") {
                this.tooltip
                    .style("opacity", 1)
                    .style(
                        this.getPosition?.side,
                        this.getPosition?.position + "px"
                    )
                    .html(contentTooltip);
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

    formatSi(num) {
        let formatSi = d3.format(".2s");
        return formatSi(num);
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
    }

    gradientInit() {
        const gradient = this.svg
            .append("defs")
            .append("linearGradient")
            .attr("id", "gradient")
            .attr("x1", "0")
            .attr("y1", "0")
            .attr("x2", "0")
            .attr("y2", "1");

        gradient
            .append("stop")
            .attr("offset", "0%")
            .attr("stop-color", "rgba(66, 130, 236, 0.8)");

        gradient
            .append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "rgba(66, 129, 231, 0.04)");
    }

    graphAppends() {
        this.svg
            .selectAll(".band")
            .data(this.yBand.domain())
            .enter()
            .append("rect")
            .attr("class", "band")
            .attr("y", (d) => y(d) - 1) // Выравнивание полосы
            .attr("height", 1)
            .attr("width", "100%")
            .attr("fill", "#");
        //this.bandColor

        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", areaGenerator)
            .attr("width", "100%")
            .attr("fill", "url(#gradient)");

        this.svg
            .append("line")
            .attr("class", "vertical-line")
            .attr("x1", 0)
            .attr("y1", 0)
            .attr("x2", 0)
            .attr("y2", this.containerHeight)
            .attr("stroke-width", width)
            .style("opacity", 0)
            .attr("stroke", this.mouseLineColor);

        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", lineGenerator)
            .attr("fill", "none")
            .attr("class", "main_line")
            .attr("width", "100%")
            .attr("stroke", this.lineColor)
            .attr("stroke-width", this.lineWidth);

        this.svg
            .append("circle") // Добавляем эту строку в ваш исходный код
            .attr("class", "dot")
            .attr("r", 6) // Задаем радиус нашей точки
            .style("opacity", 0)
            .attr("fill", this.circleColor) // Используем тот же цвет, что и для линии графика
            .attr("stroke", this.circleBorder) // Установите цвет границы круга
            .attr("stroke-width", 2); // Установите ширину границы

        this.svg
            .append("g")
            .attr("transform", `translate(0, ${this.containerHeight + 5})`)
            .call(xAxis)
            .select(".domain")
            .remove();

        if (!this.isMobile) {
            this.svg
                .append("g")
                .attr("transform", `translate(-5, 0)`)
                .call(yAxis)
                .select(".domain")
                .remove();
        } else {
            let axisHeight;
            if (this.graphType === "statistic") {
                axisHeight = this.containerHeight + 5;
            } else {
                axisHeight = this.containerHeight - 15;
            }
            this.axis
                .attr("style", `height: ${axisHeight}px`)
                .call(yAxis)
                .select(".domain")
                .remove();
        }
    }
}
