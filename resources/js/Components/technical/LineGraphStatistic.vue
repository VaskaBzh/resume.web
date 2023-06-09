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
        redraw: Boolean,
        tooltip: {
            type: Boolean,
            default: false,
        },
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
                const isLeft =
                    this.mouseX <
                    this.$refs.chart.clientWidth -
                        this.$refs.tooltip.clientWidth;

                return {
                    side: "left",
                    position: isLeft
                        ? this.mouseX
                        : this.mouseX - this.$refs.tooltip.clientWidth,
                };
            }
        },
    },
    methods: {
        dropGraph() {
            this.svg.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        },
        tooltipInit(event, tooltip, x, adjustValue, formatNumber, formatSi) {
            try {
                let formatNumberWithUnit = (num, i) =>
                    formatNumber(adjustValue(num, this.graphData.unit[i]).val) +
                    " " +
                    adjustValue(num, this.graphData.unit[i]).unit +
                    "H";

                this.clientX = event.clientX;
                this.mouseX =
                    this.clientX - this.svg.node().getBoundingClientRect().left;
                const nearestIndex = Math.round(x.invert(this.mouseX));
                const d = this.graphData.values[nearestIndex];
                const u = this.graphData.unit[nearestIndex];
                const a = this.graphData.amount[nearestIndex];
                const time = this.graphData.dates[nearestIndex];

                const verticalLineX = this.mouseX;

                const horizontalLineY =
                    event.clientY -
                    this.$refs.chart.getBoundingClientRect().top;

                this.svg
                    .selectAll(".vertical-line")
                    .attr("x1", verticalLineX)
                    .attr("x2", verticalLineX)
                    .attr("y1", 0)
                    .attr("y2", this.containerHeight)
                    .attr("stroke-width", 0.7)
                    .style("opacity", 1)
                    .attr("stroke", "#BEC9E0");

                this.svg
                    .selectAll(".horizontal-line")
                    .attr("x1", 0)
                    .attr("x2", this.$refs.chart.offsetWidth)
                    .attr("y1", horizontalLineY)
                    .attr("y2", horizontalLineY)
                    .attr("stroke-width", 0.7)
                    .style("opacity", 1)
                    .attr("stroke", "#BEC9E0");

                if (new Date(time).toLocaleTimeString() !== "Invalid Date") {
                    tooltip
                        .style("opacity", 1)
                        .style(
                            this.getPosition?.side,
                            this.getPosition?.position + "px"
                        )
                        .style(
                            "top",
                            event.clientY -
                                this.$refs.chart.getBoundingClientRect().top +
                                "px"
                        ).html(`<div class="tooltip-wrapper">

                                <span>Хешрейт: <span class="value">${formatNumberWithUnit(
                                    d,
                                    u
                                )}/s</span></span>
                                <span>Активные воркеры: <span class="value">${a}</span></span>
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
                            </div>`);
                }
            } catch (error) {
                console.error(error);
            }
        },

        graphInit() {
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
                .attr("stop-color", "#4E7AD6");

            gradient
                .append("stop")
                .attr("offset", "100%")
                .attr("stop-color", "rgba(78, 122, 214, 0)");

            let x = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.dates, (d) => new Date(d)))
                .range([0, this.$refs.chart.offsetWidth]);

            let formatNumberWithUnit = (num, i) =>
                formatNumber(adjustValue(num, this.graphData.unit[i]).val) +
                " " +
                adjustValue(num, this.graphData.unit[i]).unit +
                "H";

            let isMobile = this.viewportWidth <= 479.98;

            this.containerHeight = this.height;

            if (isMobile && this.tooltip) {
                this.containerHeight = 380;
            }

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
            if (isMobile && this.tooltip) {
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
                .attr("stroke-width", 0.7)
                .style("opacity", 0)
                .attr("stroke", "#BEC9E0");

            this.svg
                .append("line")
                .attr("class", "horizontal-line")
                .attr("x1", 0)
                .attr("y1", 0)
                .attr("x2", this.$refs.chart.offsetWidth)
                .attr("y2", 0)
                .attr("stroke-width", 0.7)
                .style("opacity", 0)
                .attr("stroke", "#BEC9E0");

            this.svg
                .selectAll(".band")
                .data(yBand.domain())
                .enter()
                .append("rect")
                .attr("class", "band")
                .attr("y", (d) => y(d) - 0.3) // Выравнивание полосы
                .attr("height", 0.3)
                .attr("width", "100%")
                .attr("fill", "#BEC9E0");

            this.svg
                .append("path")
                .datum(this.graphData.values)
                .attr("d", areaGenerator)
                .attr("width", "100%")
                .attr("fill", "url(#gradient)");

            this.svg
                .append("path")
                .datum(this.graphData.values)
                .attr("d", lineGenerator)
                .attr("fill", "none")
                .attr("class", "main_line")
                .attr("width", "100%")
                .attr("stroke", "#4E7AD6")
                .attr("stroke-width", 2);

            this.svg
                .append("g")
                .attr("transform", `translate(0, ${this.containerHeight + 5})`)
                .call(xAxis);

            this.svg
                .append("g")
                .attr("transform", `translate(-5, 0)`)
                .call(yAxis);

            if (!isMobile || this.tooltip) {
                const tooltip = d3.select(this.$refs.tooltip);

                this.svg.on("mousemove", (event) =>
                    this.tooltipInit(
                        event,
                        tooltip,
                        x,
                        adjustValue,
                        formatNumber,
                        formatSi
                    )
                );

                this.svg.on("mouseleave", () => {
                    tooltip.style("opacity", 0);

                    this.svg.selectAll(".vertical-line").style("opacity", 0);

                    // Устанавливаем стили и позицию горизонтальной полосы
                    this.svg.selectAll(".horizontal-line").style("opacity", 0);
                });
                tooltip.on("mousemove", () => tooltip.style("opacity", 1));
                tooltip.on("mouseleave", () => tooltip.style("opacity", 0));
            }
        },
    },
    mounted() {
        if (this.$refs.chart && this.graphData?.values?.length > 0) {
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
