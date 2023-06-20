<template>
    <div ref="chart" class="container-chart">
        <div ref="tooltip" class="tooltip" style="opacity: 0">Tooltip</div>
    </div>
</template>

<script>
import * as d3 from "d3";

export default {
    name: "line-graph",
    props: {
        graphData: Array,
        height: Number,
        viewportWidth: Number,
        redraw: {
            type: Boolean,
            default: true,
        },
        graphType: String,
        lineColor: String,
        lineWidth: Number,
        mouseLineColor: String,
        circleColor: String,
        circleBorder: String,
        bandColor: String,
    },
    data() {
        return {
            svg: null,
            mouseX: null,
            clientX: null,
            containerWidth: 0,
            containerHeight: 0,
        };
    },
    watch: {
        height() {
            if (this.$refs.chart && this.graphData.values?.length > 0) {
                this.dropGraph();
                this.graphInit();
            }
        },
        containerWidth() {
            if (this.$refs.chart && this.graphData.values?.length > 0) {
                this.dropGraph();
                this.graphInit();
            }
        },
    },
    computed: {
        getPosition() {
            if (this.mouseX) {
                // const isLeft =
                //     this.mouseX <
                //     this.$refs.chart.clientWidth -
                //         this.$refs.tooltip.clientWidth;
                const isRigth =
                    this.mouseX < this.$refs.tooltip.clientWidth - 8;

                return {
                    side: "left",
                    position: isRigth
                        ? this.mouseX + 8
                        : this.mouseX - 8 - this.$refs.tooltip.clientWidth,
                };
            }
        },
    },
    methods: {
        dropGraph() {
            if (this.svg) {
                this.svg.selectAll("*").remove();
                this.svg._groups[0][0].remove();
            }
        },
        tooltipInit(event, tooltip, x, adjustValue, formatNumber, posy) {
            try {
                let formatNumberWithUnit = (num, i) =>
                    formatNumber(adjustValue(num, this.graphData.unit[i]).val) +
                    " " +
                    adjustValue(num, this.graphData.unit[i]).unit +
                    "H";

                event.touches
                    ? (this.clientX = event.touches[0].clientX)
                    : (this.clientX = event.clientX);
                this.mouseX =
                    this.clientX - this.svg.node().getBoundingClientRect().left;
                const nearestIndex = Math.round(x.invert(this.mouseX));
                const d = this.graphData.values[nearestIndex];
                const u = this.graphData.unit[nearestIndex];
                let a = null;
                if (this.graphType === "statistic") {
                    a = this.graphData.amount[nearestIndex];
                }
                const time = this.graphData.dates[nearestIndex];

                let topPos = 0;

                if (this.$refs.tooltip?.clientHeight)
                    topPos = this.$refs.tooltip.clientHeight + 8;

                const verticalLineX = this.mouseX;

                // const horizontalLineY =
                //     event.clientY -
                //     this.$refs.chart.getBoundingClientRect().top;

                this.svg
                    .selectAll(".vertical-line")
                    .attr("x1", verticalLineX)
                    .attr("x2", verticalLineX)
                    .attr("y1", 0)
                    .attr("y2", this.containerHeight)
                    .attr("stroke-width", 1)
                    .style("opacity", 1)
                    .attr("stroke", this.mouseLineColor);

                // this.svg
                //     .selectAll(".horizontal-line")
                //     .attr("x1", 0)
                //     .attr("x2", this.$refs.chart.offsetWidth)
                //     .attr("y1", horizontalLineY)
                //     .attr("y2", horizontalLineY)
                //     .attr("stroke-width", 0.7)
                //     .style("opacity", 1)
                //     .attr("stroke", "#BEC9E0");
                let contentTooltip = null;

                if (this.graphType === "statistic") {
                    contentTooltip = `<div class="tooltip-wrapper">
                                <span>Хешрейт <span class="value">${formatNumberWithUnit(
                                    d,
                                    u
                                )}</span></span>
                                <span>Активные воркеры <span class="value">${a}</span></span>
                                <span>Отклоненный <span class="value">0.000%</span></span>
                                <span class="time">${
                                    new Date(time).getUTCFullYear() + "."
                                }${
                        new Date(time).getDate().toString().padStart(2, "0") +
                        "."
                    }${(new Date(time).getMonth() + 1)
                        .toString()
                        .padStart(2, "0")} ${new Date(
                        time
                    ).toLocaleTimeString()}</span>
                            </div>`;
                } else if (this.graphType === "complexity") {
                    contentTooltip = `<div class="tooltip-wrapper">
                                <span>Хешрейт <span class="value">${formatNumberWithUnit(
                                    d,
                                    u
                                )}</span></span>
                                <span>Отклоненный <span class="value">0.000%</span></span>
                                <span class="time">${
                                    new Date(time).getUTCFullYear() + "."
                                }${
                        new Date(time).getDate().toString().padStart(2, "0") +
                        "."
                    }${(new Date(time).getMonth() + 1)
                        .toString()
                        .padStart(2, "0")} ${new Date(
                        time
                    ).toLocaleTimeString()}</span>
                            </div>`;
                }

                if (new Date(time).toLocaleTimeString() !== "Invalid Date") {
                    tooltip
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
        },

        graphInit() {
            let isMobile = this.viewportWidth <= 479.98;

            this.containerHeight = this.height;

            if (isMobile && this.tooltip) {
                this.containerHeight = 380;
            }
            let adjustValue = (num) => {
                if (num / 1000 >= 1) {
                    return { val: num / 1000, unit: "P" };
                } else if (num / 1000000 > 1) {
                    return { val: num / 1000000, unit: "E" };
                } else {
                    return { val: num, unit: "T" };
                }
            };

            let formatSi = d3.format(".2s");
            let formatNumber = (num) =>
                formatSi(num)
                    .replace("G", "B")
                    .replace("T", "T")
                    .replace("P", "Q");

            this.svg = d3
                .select(this.$refs.chart)
                .append("svg")
                .attr("width", "100%")
                .attr("height", this.containerHeight);

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

            let x = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.dates, (d) => new Date(d)))
                .range([0, this.$refs.chart.offsetWidth]);

            let formatNumberWithUnit = (num, i) =>
                formatNumber(adjustValue(num, this.graphData.unit[i]).val) +
                " " +
                adjustValue(num, this.graphData.unit[i]).unit +
                "H";

            const y = d3
                .scaleLinear()
                .domain([0, d3.max(this.graphData.values)])
                .range([this.containerHeight, 0]);

            let formatTime = (date, i) => {
                const hours = date.getHours().toString().padStart(2, "0");
                // const minutes = date.getMinutes().toString().padStart(2, "0");
                if (this.graphData.dates.length > 24) {
                    const day = date.getDate().toString().padStart(2, "0");
                    return `${day}/${(date.getUTCMonth() + 1)
                        .toString()
                        .padStart(2, "0")}`;
                    // ${hours
                    //     .toString()
                    //     .padStart(2, "0")}:${minutes
                    //     .toString()
                    //     .padStart(2, "0")}`;
                } else {
                    return `${hours.toString().padStart(2, "0")}:00`;
                    // ${minutes
                    //     .toString()
                    //     .padStart(2, "0")}`;
                }
            };

            let xAxis = null;

            let yAxis = null;
            if (isMobile) {
                yAxis = d3
                    .axisLeft(y)
                    .ticks(12)
                    .tickFormat((d, i) => formatNumberWithUnit(d, i));
                xAxis = d3
                    .axisBottom(x)
                    .ticks(12)
                    .tickFormat((d) => formatTime(new Date(d)));
            } else {
                yAxis = d3
                    .axisLeft(y)
                    .ticks(isMobile ? 6 : 10)
                    .tickFormat((d, i) => formatNumberWithUnit(d, i));
                xAxis = d3
                    .axisBottom(x)
                    .ticks(isMobile ? 4 : this.viewportWidth <= 991.98 ? 8 : 12)
                    .tickFormat((d) => formatTime(new Date(d)));
            }

            x = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.dates, (d, i) => i))
                .range([0, this.containerWidth]);

            const lineGenerator = d3
                .line()
                .x((d, i) => x(i))
                .y((d) => y(d))
                .curve(d3.curveBasis);

            const areaGenerator = d3
                .area()
                .x((d, i) => x(i))
                .y0(this.containerHeight)
                .y1((d) => y(d))
                .curve(d3.curveBasis);

            const yBand = d3
                .scaleBand()
                .domain(yAxis.scale().ticks())
                .range([this.containerHeight, 0]);

            this.svg
                .append("line")
                .attr("class", "vertical-line")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", 0)
                .attr("y2", this.containerHeight)
                .attr("stroke-width", 1)
                .style("opacity", 0)
                .attr("stroke", this.mouseLineColor);

            // this.svg
            //     .append("line")
            //     .attr("class", "horizontal-line")
            //     .attr("x1", 0)
            //     .attr("y1", 0)
            //     .attr("x2", this.$refs.chart.offsetWidth)
            //     .attr("y2", 0)
            //     .attr("stroke-width", 0.7)
            //     .style("opacity", 0)
            //     .attr("stroke", "#BEC9E0");

            this.svg
                .append("circle") // Добавляем эту строку в ваш исходный код
                .attr("class", "dot")
                .attr("r", 6) // Задаем радиус нашей точки
                .style("opacity", 0)
                .attr("fill", this.circleColor) // Используем тот же цвет, что и для линии графика
                .attr("border", this.circleBorder);

            this.svg
                .selectAll(".band")
                .data(yBand.domain())
                .enter()
                .append("rect")
                .attr("class", "band")
                .attr("y", (d) => y(d) - 1) // Выравнивание полосы
                .attr("height", 1)
                .attr("width", "100%")
                .attr("fill", this.bandColor);

            if (this.graphType === "statistic") {
                this.svg
                    .append("path")
                    .datum(this.graphData.values)
                    .attr("d", areaGenerator)
                    .attr("width", "100%")
                    .attr("fill", "url(#gradient)");
            }

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
                .append("g")
                .attr("transform", `translate(0, ${this.containerHeight + 5})`)
                .call(xAxis);

            this.svg
                .append("g")
                .attr("transform", `translate(-5, 0)`)
                .call(yAxis);

            const tooltip = d3.select(this.$refs.tooltip);

            if (isMobile) {
                this.svg.on("touchstart", (event) => {
                    const touchX =
                        event.touches[0].clientX -
                        this.svg.node().getBoundingClientRect().left;
                    const position = this.getClosestPoint(touchX);
                    this.updateDotAndTooltip(
                        event,
                        tooltip,
                        x,
                        adjustValue,
                        formatNumber,
                        formatSi,
                        position
                    );
                });

                this.svg.on("touchmove", (event) => {
                    const touchX =
                        event.touches[0].clientX -
                        this.svg.node().getBoundingClientRect().left;
                    const position = this.getClosestPoint(touchX);
                    this.updateDotAndTooltip(
                        event,
                        tooltip,
                        x,
                        adjustValue,
                        formatNumber,
                        formatSi,
                        position
                    );
                });

                this.svg.on("touchend", () => {
                    tooltip.style("opacity", 0);
                    this.svg.selectAll(".vertical-line").style("opacity", 0);
                    this.svg.selectAll(".dot").style("opacity", 0); // Прячем точку, когда мышь покидает область графика
                });
            } else {
                this.svg.on("mousemove", (event) => {
                    const mouseX = d3.pointer(event)[0];
                    const position = this.getClosestPoint(mouseX);
                    this.updateDotAndTooltip(
                        event,
                        tooltip,
                        x,
                        adjustValue,
                        formatNumber,
                        formatSi,
                        position
                    );
                });

                this.svg.on("mouseleave", () => {
                    tooltip.style("opacity", 0);

                    this.svg.selectAll(".vertical-line").style("opacity", 0);

                    // Устанавливаем стили и позицию горизонтальной полосы
                    // this.svg.selectAll(".horizontal-line").style("opacity", 0);
                    tooltip.style("opacity", 0);

                    this.svg.selectAll(".vertical-line").style("opacity", 0);
                    this.svg.selectAll(".dot").style("opacity", 0); // Прячем точку, когда мышь покидает область графика
                });
                tooltip.on("mousemove", () => tooltip.style("opacity", 1));
                tooltip.on("mouseleave", () => tooltip.style("opacity", 0));
            }
        },
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
        },
        updateDotAndTooltip(
            event,
            tooltip,
            x,
            adjustValue,
            formatNumber,
            formatSi,
            position
        ) {
            // Обновляем позицию точки на линии графика
            this.svg
                .selectAll(".dot")
                .attr("cx", position.x)
                .attr("cy", position.y)
                .style("opacity", 1);

            this.tooltipInit(
                event,
                tooltip,
                x,
                adjustValue,
                formatNumber,
                formatSi,
                position.y
            );

            tooltip
                .style(
                    "top",
                    position.y - this.$refs.tooltip.clientHeight - 7 + "px"
                )
                .style("opacity", 1);

            // Обновляем позицию вертикальной линии
            this.svg
                .selectAll(".vertical-line")
                .attr("x1", position.x)
                .attr("x2", position.x)
                .style("opacity", 1);
        },
    },
    mounted() {
        if (this.$refs.chart && this.graphData.values?.length > 0) {
            setInterval(() => {
                if (
                    this.$refs.chart?.offsetWidth &&
                    this.containerWidth !== this.$refs.chart.offsetWidth
                ) {
                    this.containerWidth = this.$refs.chart.offsetWidth;
                }
            }, 100);
            if (this.redraw) {
                this.graphInit();
            }
        }
    },
};
</script>

<style lang="scss" scoped>
.container-chart {
    text-align: right;
    margin: 0 0 0 55px;
    width: calc(100% - 55px);
}
</style>
