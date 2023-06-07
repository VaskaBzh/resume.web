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
    },
    data() {
        return {
            svg: null,
            mouseX: null,
            clientX: null,
        };
    },
    beforeMount() {
        window.removeEventListener("resize", this.graphInit);
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
        tooltipInit(event, type, tooltip, x) {
            try {
                if (type === "svg") {
                    this.clientX = event.clientX;
                    this.mouseX =
                        this.clientX -
                        this.svg.node().getBoundingClientRect().left;
                    const nearestIndex = Math.round(x.invert(this.mouseX));
                    const d = this.graphData.values[nearestIndex];

                    tooltip
                        .style("opacity", 1)
                        .style(
                            this.getPosition.side,
                            this.getPosition.position + "px"
                        )
                        .style(
                            "top",
                            event.clientY -
                                this.$refs.chart.getBoundingClientRect().top +
                                "px"
                        )
                        .html(
                            `<div class="tooltip-wrapper">${d} ${
                                this.unit || "H"
                            }</div>`
                        );
                } else if (type === "tooltip") {
                    tooltip.style("opacity", 1);
                }
            } catch (error) {
                console.error(error);
            }
        },
        graphInit() {
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
                .range([0, this.$refs.chart.clientWidth]);

            const y = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.values, (d) => d))
                .range([this.height, 0]);

            let isMobile = this.viewportWidth <= 479.98;

            const xAxis = d3
                .axisBottom(x)
                .ticks(isMobile ? 4 : 12)
                .tickFormat(d3.timeFormat("%m.%y"));
            const yAxis = d3.axisLeft(y).tickFormat(formatNumber);

            x = d3
                .scaleLinear()
                .domain(d3.extent(this.graphData.dates, (d, i) => i))
                .range([0, this.$refs.chart.clientWidth]);

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
                    this.tooltipInit(event, "svg", tooltip, x)
                );

                this.svg.on("mouseleave", () => {
                    tooltip.style("opacity", 0);
                });
            }
        },
    },
    mounted() {
        if (this.$refs.chart && this.graphData.values?.length > 0) {
            this.graphInit();
        }
    },
};
</script>

<style lang="scss" scoped>
.container-chart {
    text-align: right;
    margin-left: 35px;
    @media (max-width: 479.98px) {
        flex: 0 0 calc(100% - 57px);
    }
}
</style>
