<template>
    <div id="column-graph"></div>
</template>

<script>
import * as d3 from "d3";

export default {
    name: "column-graph",
    props: {
        graphData: Array,
    },
    mounted() {
        this.drawGraph();
    },
    methods: {
        drawGraph() {
            const parentWidth = this.$el.offsetWidth; // Получение ширины родительского элемента
            const height = 180;
            const data = this.graphData.map((d) => ({
                ...d,
                value: parseFloat(d.value),
            }));

            d3.select("#column-graph").html("");

            const svg = d3
                .select("#column-graph")
                .append("svg")
                .attr("width", parentWidth)
                .attr("height", height);

            const xScale = d3
                .scaleBand()
                .domain(data.map((d) => d.title))
                .range([0, parentWidth])
                .padding(0.1); // Небольшое заполнение между столбцами

            const yScale = d3
                .scaleLinear()
                .domain([
                    d3.min(data, (d) => d.value),
                    d3.max(data, (d) => d.value),
                ])
                .range([height, 0]);

            svg.selectAll("rect")
                .data(data)
                .enter()
                .append("rect")
                .attr("x", (d) => xScale(d.title))
                .attr("y", (d) => (d.value < 0 ? yScale(0) : yScale(d.value)))
                .attr("width", xScale.bandwidth())
                .attr("height", (d) => Math.abs(yScale(d.value) - yScale(0)))
                .attr("fill", (d) => d.color)
                .attr("rx", 10) // Скругление углов
                .attr("ry", 10);

            // Добавление заголовков
            svg.selectAll(".bar-title")
                .data(data)
                .enter()
                .append("text")
                .attr("class", "bar-title")
                .attr("x", (d) => xScale(d.title) + xScale.bandwidth() / 2)
                .attr("y", (d) =>
                    d.value < 0 ? yScale(d.value) + 20 : yScale(d.value) - 10
                )
                .attr("text-anchor", "middle")
                .text((d) => d.title);

            // Добавление значений
            svg.selectAll(".bar-value")
                .data(data)
                .enter()
                .append("text")
                .attr("class", "bar-value")
                .attr("x", (d) => xScale(d.title) + xScale.bandwidth() / 2)
                .attr("y", (d) =>
                    d.value < 0 ? yScale(0) - 10 : yScale(0) + 20
                )
                .attr("text-anchor", "middle")
                .text((d) => d.value);
        },
    },
    watch: {
        graphData: {
            deep: true,
            handler() {
                this.drawGraph();
            },
        },
    },
};
</script>

<style lang="scss">
#column-graph {
    width: 100%;
    padding: 30px 0;
    svg {
        overflow: visible;
    }
}

.bar {
    &-value {
        fill: #fff;
        text-align: center;
        font-feature-settings: "case" on;
        font-size: 18px;
        font-weight: 600;
        line-height: 110%;
        letter-spacing: 0.35px;
    }
    &-title {
        fill: #fff;
        text-align: center;
        font-size: 18px;
        font-weight: 400;
        line-height: 110%;
        letter-spacing: 0.35px;
    }
}
</style>
