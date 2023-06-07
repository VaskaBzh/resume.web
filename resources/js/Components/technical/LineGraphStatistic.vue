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
    },
    data() {
        return {
            svg: null,
            mouseX: null,
            clientX: null,
        };
    },
    watch: {
        height() {
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
        tooltipInit(event, tooltip, x) {
            try {
                this.clientX = event.clientX;
                this.mouseX =
                    this.clientX - this.svg.node().getBoundingClientRect().left;
                const nearestIndex = Math.round(x.invert(this.mouseX));
                const d = this.graphData.values[nearestIndex];
                const u = this.graphData.unit[nearestIndex];
                const a = this.graphData.amount[nearestIndex];
                const time = this.graphData.dates[nearestIndex];
                if (this.graphData.dates.length === 24) {
                    if (
                        new Date(time).toLocaleTimeString() !== "Invalid Date"
                    ) {
                        tooltip
                            .style("opacity", 1)
                            .style(
                                this.getPosition.side,
                                this.getPosition.position + "px"
                            )
                            .style(
                                "top",
                                event.clientY -
                                    this.$refs.chart.getBoundingClientRect()
                                        .top +
                                    "px"
                            ).html(`<div class="tooltip-wrapper">
                                <span>Время: ${new Date(
                                    time
                                ).toLocaleTimeString()}</span>
                                <span>Хешрейт: ${d} ${(u || "T") + "H/s"}</span>
                                <span>Активные воркеры: ${a}</span>
                            </div>`);
                    }
                } else {
                    if (
                        new Date(time).toLocaleTimeString() !== "Invalid Date"
                    ) {
                        tooltip
                            .style("opacity", 1)
                            .style(
                                this.getPosition.side,
                                this.getPosition.position + "px"
                            )
                            .style(
                                "top",
                                event.clientY -
                                    this.$refs.chart.getBoundingClientRect()
                                        .top +
                                    "px"
                            ).html(`<div class="tooltip-wrapper">
                                <span>День: ${
                                    new Date(time)
                                        .getDate()
                                        .toString()
                                        .padStart(2, "0") + "."
                                }${(new Date(time).getMonth() + 1)
                            .toString()
                            .padStart(2, "0")} Время: ${new Date(
                            time
                        ).toLocaleTimeString()}</span>
                                <span>Хешрейт: ${d} ${(u || "T") + "H/s"}</span>
                                <span>Активные воркеры: ${a}</span>
                            </div>`);
                    }
                }
            } catch (error) {
                console.error(error);
            }
        },

        graphInit() {
            let adjustValue = (num, unit) => {
                switch (unit) {
                    case "P":
                        return num / 1000;
                    case "E":
                        return num / 1000000;
                    default:
                        return num;
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
                .attr("height", this.height);

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
                .attr("stop-color", "#fff");

            let x = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.dates, (d) => new Date(d)))
                .range([0, this.$refs.chart.offsetWidth]);

            let formatNumberWithUnit = (num, i) =>
                formatNumber(adjustValue(num, this.graphData.unit[i])) +
                " " +
                this.graphData.unit[i] +
                "H";

            const y = d3
                .scaleLinear()
                .domain([0, d3.max(this.graphData.values)])
                .range([this.height, 0]);

            let formatTime = (date, i) => {
                const hours = date.getHours().toString().padStart(2, "0");
                const minutes = date.getMinutes().toString().padStart(2, "0");
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
                    return `${hours.toString().padStart(2, "0")}:${minutes
                        .toString()
                        .padStart(2, "0")}`;
                }
            };

            let isMobile = this.viewportWidth <= 479.98;

            const xAxis = d3
                .axisBottom(x)
                .ticks(isMobile ? 4 : this.viewportWidth <= 991.98 ? 8 : 12)
                .tickFormat((d) => formatTime(new Date(d)));

            const yAxis = d3
                .axisLeft(y)
                .ticks(isMobile ? 6 : 10)
                .tickFormat((d, i) => formatNumberWithUnit(d, i));

            x = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.dates, (d, i) => i))
                .range([0, this.$refs.chart.offsetWidth]);

            const lineGenerator = d3
                .line()
                .x((d, i) => x(i))
                .y((d) => y(d))
                .curve(d3.curveBasis);

            const areaGenerator = d3
                .area()
                .x((d, i) => x(i))
                .y0(this.height)
                .y1((d) => y(d))
                .curve(d3.curveBasis);

            const yBand = d3
                .scaleBand()
                .domain(yAxis.scale().ticks())
                .range([this.height, 0]);

            this.svg
                .selectAll(".band")
                .data(yBand.domain())
                .enter()
                .append("rect")
                .attr("class", "band")
                .attr("y", (d) => yBand(d))
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
                .attr("width", "100%")
                .attr("stroke", "#4E7AD6")
                .attr("stroke-width", 2);

            this.svg
                .append("g")
                .attr("transform", `translate(0, ${this.height + 5})`)
                .call(xAxis);

            this.svg
                .append("g")
                .attr("transform", `translate(-5, 0)`)
                .call(yAxis);

            if (!isMobile) {
                const tooltip = d3.select(this.$refs.tooltip);

                this.svg.on("mousemove", (event) =>
                    this.tooltipInit(event, tooltip, x)
                );

                this.svg.on("mouseleave", () => {
                    tooltip.style("opacity", 0);
                });
                tooltip.on("mousemove", () => tooltip.style("opacity", 1));
                tooltip.on("mouseleave", () => tooltip.style("opacity", 0));
            }
        },
    },
    mounted() {
        if (this.$refs.chart && this.graphData?.values?.length > 0) {
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
    @media (max-width: 767.98px) {
        margin: 0 10px 0 55px;
        width: calc(100% - 10px - 55px);
    }
}
</style>
