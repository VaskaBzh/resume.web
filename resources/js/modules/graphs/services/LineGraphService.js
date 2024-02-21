import { GraphService } from "@/modules/graphs/services/GraphService";
import { TimeFormatter } from "@/formatters/TimeFormatter";
import { HashRateFormatters } from "@/formatters/HashRateFormatters";
import * as d3 from "d3";
import store from "@/store";

export class LineGraphService extends GraphService {
    buildElements() {
        const bandColor = store.getters.isDark
            ? "rgba(47,47,47,0.95)"
            : "rgba(208, 213, 221, 0.2)";
        const circleColor = store.getters.isDark ? "#212327" : "#ffffff";

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
            .attr("stop-color", "rgba(46, 144, 250, 0.8)");

        gradient
            .append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "rgba(46, 144, 250, 0)");

        this.svg
            .selectAll(".band")
            .data(this.generators.band.domain())
            .enter()
            .append("rect")
            .attr("class", "band")
            .attr("y", (d) => this.y(d) - 1)
            .attr("height", 1)
            .attr("width", "100%")
            .attr("fill", bandColor);

        this.svg
            .append("line")
            .attr("class", "vertical-line")
            .attr("x1", 0)
            .attr("y1", 0)
            .attr("x2", 0)
            .attr("y2", this.graphElem.clientHeight)
            .attr("stroke-width", 1)
            .style("opacity", 0)
            .attr("stroke-dasharray", "10")
            .attr("stroke", "rgba(152, 162, 179, 0.5)");

        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", this.generators.area)
            .attr("width", "100%")
            .attr("fill", "url(#gradient)");

        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", this.generators.line)
            .attr("fill", "none")
            .attr("class", "main_line")
            .attr("width", "100%")
            .attr("stroke", "#2E90FA")
            .attr("stroke-width", 1);

        this.svg
            .append("circle")
            .attr("class", "dot")
            .attr("r", 6)
            .style("opacity", 0)
            .attr("fill", circleColor)
            .attr("stroke", "#2E90FA")
            .attr("stroke-width", 2);

        this.svg
            .append("g")
            .attr(
                "transform",
                `translate(0, ${this.graphElem.clientHeight + 5})`
            )
            .call(this.generators.xAxis)
            .select(".domain")
            .remove();

        const HashrateUnitEnum = {
            T: "TH/s",
            P: "PH/s",
            E: "EH/s",
        };
        let includedUnit = HashrateUnitEnum["T"];

        if (this.graphData.unit.includes("E")) {
            includedUnit = HashrateUnitEnum["E"];
        } else if (this.graphData.unit.includes("P")) {
            includedUnit = HashrateUnitEnum["P"];
        }

        this.svg
            .append("g")
            .attr("transform", `translate(-5, 0)`)
            .call(this.generators.yAxis)
            .select(".domain")
            .remove();

        this.svg
            .append("text")
            .attr("x", -25)
            .attr("y", 0)
            .attr("text-anchor", "middle")
            .style("font-size", "16px")
            .style("font-weight", "100")
            .attr("fill", "#6F7682")
            .attr("stroke-width", ".8")
            .text(`${includedUnit}`);
    }

    getGenerators() {
        const yAxis = d3
            .axisLeft(this.y)
            .ticks(12)
            .tickFormat(
                (d) => HashRateFormatters.formatHashRateInObject(d).val
            );

        return {
            area: d3
                .area()
                .x(
                    (_, i) =>
                        (this.graphElem.clientWidth /
                            (this.graphData.dates.length - 1)) *
                        i
                )
                .y0(this.graphElem.clientHeight)
                .y1((d) => this.y(d))
                .curve(d3.curveBasis),
            line: d3
                .line()
                .x(
                    (_, i) =>
                        (this.graphElem.clientWidth /
                            (this.graphData.dates.length - 1)) *
                        i
                )
                .y((d) => this.y(d))
                .curve(d3.curveBasis),
            xAxis: d3
                .axisBottom(this.x)
                .ticks(12)
                .tickFormat((d) => TimeFormatter.formatTime("hh:ii", d)),
            yAxis: yAxis,
            band: d3
                .scaleBand()
                .domain(yAxis.scale().ticks())
                .range([this.graphElem.clientHeigh, 0]),
        };
    }
    // constructor(graphData, translate) {
    //     super(graphData, translate);
    // }
    //
    // setDate(nearestIndex) {
    //     const date = new Date(this.graphData.dates[nearestIndex]);
    //
    //     this.fullDate =
    //         date.getUTCFullYear() +
    //         "." +
    //         date.getDate().toString().padStart(2, "0") +
    //         "." +
    //         (date.getMonth() + 1).toString().padStart(2, "0");
    //     if (this.graphData.values.length > 96)
    //         this.time =
    //             date.getDate().toString().padStart(2, "0") +
    //             "." +
    //             (date.getMonth() + 1).toString().padStart(2, "0");
    //     else this.time = date.getUTCHours().toString().padStart(2, "0") + ":00";
    // }
    //
    // gradientInit() {
    //     const gradient = this.svg
    //         .append("defs")
    //         .append("linearGradient")
    //         .attr("id", "gradient")
    //         .attr("x1", "0")
    //         .attr("y1", "0")
    //         .attr("x2", "0")
    //         .attr("y2", "1");
    //
    //     gradient
    //         .append("stop")
    //         .attr("offset", "0%")
    //         .attr("stop-color", "rgba(46, 144, 250, 0.8)");
    //
    //     gradient
    //         .append("stop")
    //         .attr("offset", "100%")
    //         .attr("stop-color", "rgba(46, 144, 250, 0)");
    //
    //     return this;
    // }
    //
    // createAxis() {
    //     let axisHeight = this.containerHeight + 5;
    //     this.axis
    //         .attr("style", `height: ${axisHeight}px`)
    //         .call(this.yAxis)
    //         .select(".domain")
    //         .remove();
    //
    //     return this;
    // }
    //
    // appendYAxis() {
    //     const HashrateUnitEnum = {
    //         T: "TH/s",
    //         P: "PH/s",
    //         E: "EH/s",
    //     };
    //     let includedUnit = HashrateUnitEnum["T"];
    //
    //     if (this.graphData.unit.includes("E")) {
    //
    //         includedUnit = HashrateUnitEnum["E"];
    //
    //     } else if (this.graphData.unit.includes("P")) {
    //
    //         includedUnit = HashrateUnitEnum["P"];
    //     }
    //
    //
    //
    //
    //         this.svg
    //             .append("g")
    //             .attr("transform", `translate(-5, 0)`)
    //             .call(this.yAxis)
    //             .select(".domain")
    //             .remove();
    //
    //     this.svg.append("text").attr("x", -25).attr("y", 0)
    //         .attr("text-anchor", "middle")
    //         .style("font-size", "16px")
    //         .style("font-weight", "100")
    //         .attr('fill', '#6F7682')
    //         .attr('stroke-width', '.8')
    //         .text(`${includedUnit}`);
    //
    //     return this;
    // }
    //
    // appendXAxis() {
    //     this.svg
    //         .append("g")
    //         .attr("transform", `translate(0, ${this.containerHeight + 5})`)
    //         .call(this.xAxis)
    //         .select(".domain")
    //         .remove();
    //
    //     return this;
    // }
    //
    // createCircle(lineFill) {
    //     this.svg
    //         .append("circle")
    //         .attr("class", "dot")
    //         .attr("r", 6)
    //         .style("opacity", 0)
    //         .attr("fill", lineFill)
    //         .attr("stroke", "#2E90FA")
    //         .attr("stroke-width", 2);
    //
    //     return this;
    // }
    //
    // createLine() {
    //     this.svg
    //         .append("path")
    //         .datum(this.graphData.values)
    //         .attr("d", this.lineGenerator)
    //         .attr("fill", "none")
    //         .attr("class", "main_line")
    //         .attr("width", "100%")
    //         .attr("stroke", "#2E90FA")
    //         .attr("stroke-width", 1);
    //
    //     return this;
    // }
    //
    // createMouseLine() {
    //     this.svg
    //         .append("line")
    //         .attr("class", "vertical-line")
    //         .attr("x1", 0)
    //         .attr("y1", 0)
    //         .attr("x2", 0)
    //         .attr("y2", this.containerHeight)
    //         .attr("stroke-width", 1)
    //         .style("opacity", 0)
    //         .attr("stroke-dasharray", "10")
    //         .attr("stroke", "rgba(152, 162, 179, 0.5)");
    //     // this.mouseLineColor
    //
    //     return this;
    // }
    //
    // appendGradient() {
    //     this.svg
    //         .append("path")
    //         .datum(this.graphData.values)
    //         .attr("d", this.areaGenerator)
    //         .attr("width", "100%")
    //         .attr("fill", "url(#gradient)");
    //
    //     return this;
    // }
    //
    // appendBands(bandColor) {
    //     this.svg
    //         .selectAll(".band")
    //         .data(this.yBand.domain())
    //         .enter()
    //         .append("rect")
    //         .attr("class", "band")
    //         .attr("y", (d) => this.y(d) - 1)
    //         .attr("height", 1)
    //         .attr("width", "100%")
    //         .attr("fill", bandColor);
    //     //this.bandColor
    //
    //     return this;
    // }
    //
    // graphAppends(colors) {
    //     this.appendBands(colors.bands)
    //         .createMouseLine()
    //         .appendGradient()
    //         .createLine()
    //         .createCircle(colors.circle)
    //         .appendXAxis();
    //
    //     !this.isMobile ? this.appendYAxis() : this.createAxis();
    //
    //     return this;
    // }
}
