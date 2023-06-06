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
                if (this.svg !== null) {
                    this.svg.remove();
                }
                this.graphInit();
            }
        },
    },
    computed: {
        getPosition() {
            if (this.mouseX) {
                if (
                    this.mouseX <
                    this.$refs.chart.clientWidth -
                        this.$refs.tooltip.clientWidth
                ) {
                    return { side: "left", position: this.mouseX };
                } else {
                    return {
                        side: "right",
                        position:
                            this.clientX -
                            this.svg.node().getBoundingClientRect().right,
                    };
                }
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
                        .html(`<div class="tolltip-wrapper">${d} ${this.unit || "H"}</div>`);
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

            const xAxis = d3.axisBottom(x).tickFormat(d3.timeFormat("%m.%y"));
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

            const tooltip = d3.select(this.$refs.tooltip);

            this.svg.on("mousemove", (event) =>
                this.tooltipInit(event, "svg", tooltip, x)
            );
            tooltip.on("mousemove", (event) =>
                this.tooltipInit(event, "tooltip", tooltip, x)
            );
            tooltip.on("mouseleave", () => {
                tooltip.style("opacity", 0);
            });

            this.svg.on("mouseout", () => {
                tooltip.style("opacity", 0);
            });
        },
    },
    mounted() {
        if (this.$refs.chart && this.graphData.values?.length > 0) {
            this.graphInit();
        }
    },
};
</script>

<style lang="scss">
.container-chart {
    position: relative;
    width: 100%;
    text-align: right;
    margin-left: 35px;

    svg {
        overflow: visible;
        g {
            g.tick {
                font-size: 14px;
                font-family: "AmpleSoftPro", serif;
                color: #0000009e;
                line {
                    color: #bec9e0;
                    display: none;
                }
            }
            .domain {
                display: none;
            }
        }
    }
}

.tooltip {
    position: absolute;
    transition: all 0.2s ease 0s;
    width: fit-content;
    border: none;
    background: #fff;
    .tolltip-wrapper {
        position: relative;
        border-radius: 5px;
        font-family: "AmpleSoftPro", serif;
        font-size: 16px;
        line-height: 20px;
        padding: 10px;
        color: #417fe5;
        background: rgba(194, 213, 242, 0.6);
        overflow: hidden;
        z-index: 10;
        box-shadow: 0px 8px 24px rgba(129, 135, 189, 0.15);
    }
}
</style>
