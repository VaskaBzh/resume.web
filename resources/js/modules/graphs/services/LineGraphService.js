import { GraphService } from "@/modules/graphs/services/GraphService";
import { TimeFormatter } from "@/formatters/TimeFormatter";
import { HashRateFormatters } from "@/formatters/HashRateFormatters";
import * as d3 from "d3";
import store from "@/store";

export class LineGraphService extends GraphService {
    TOOLTIP_MARGIN = 16;

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

        // const HashrateUnitEnum = {
        //     T: "TH/s",
        //     P: "PH/s",
        //     E: "EH/s",
        // };
        // let includedUnit = HashrateUnitEnum["T"];
        //
        // if (this.graphData.unit.includes("E")) {
        //     includedUnit = HashrateUnitEnum["E"];
        // } else if (this.graphData.unit.includes("P")) {
        //     includedUnit = HashrateUnitEnum["P"];
        // }

        this.svg
            .append("g")
            .attr("transform", `translate(-5, 0)`)
            .call(this.generators.yAxis)
            .select(".domain")
            .remove();

        // this.svg
        //     .append("text")
        //     .attr("x", -25)
        //     .attr("y", 0)
        //     .attr("text-anchor", "middle")
        //     .style("font-size", "16px")
        //     .style("font-weight", "100")
        //     .attr("fill", "#6F7682")
        //     .attr("stroke-width", ".8")
        //     .text(`${includedUnit}`);
    }

    getGenerators() {
        const yAxis = d3
            .axisLeft(this.y)
            .ticks(7)
            .tickFormat((d) => {
                const convertedHashRate =
                    HashRateFormatters.formatHashRateInObject(d);

                return `${Number(convertedHashRate.hashRate).toFixed()} ${
                    convertedHashRate.unit
                }h/s`;
            });

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
                .ticks(6)
                .tickFormat((d) =>
                    TimeFormatter.formatTime(
                        this.graphData.values.length === 96 ? "hh:ii" : "dd:mm",
                        d
                    )
                ),
            yAxis: yAxis,
            band: d3
                .scaleBand()
                .domain(yAxis.scale().ticks())
                .range([this.graphElem.clientHeigh, 0]),
        };
    }

    getClosestPoint(mouseX) {
        const pathNode = this.svg.select(".main_line").node();
        let beginning = 0,
            end = pathNode.getTotalLength();
        let position = null;

        while (true) {
            const target = Math.floor((beginning + end) / 2);
            position = pathNode.getPointAtLength(target);
            if (
                (target === end || target === beginning) &&
                position.x !== mouseX
            ) {
                break;
            }
            if (position.x > mouseX) end = target;
            else if (position.x < mouseX) beginning = target;
            else break;
        }

        return position;
    }

    abstractLeaveAction() {
        this.svg.selectAll(".vertical-line").style("opacity", 0);

        this.svg.selectAll(".dot").style("opacity", 0);
    }

    abstractMoveAction(mouseX) {
        if (!this.tooltip) {
            return this;
        }

        const linePosition = this.getClosestPoint(mouseX);

        this.tooltipService.tooltip.isOut = "";
        if (this.tooltip.clientWidth > mouseX) {
            this.tooltipService.tooltip.isOut = "left";
        }

        const tooltipLeftMargin =
            this.tooltipOut === "left"
                ? this.TOOLTIP_MARGIN
                : -this.TOOLTIP_MARGIN;

        const savedRightPosition =
            this.tooltipOut === "left" ? 0 : -this.tooltip.clientWidth;

        this.tooltipService.setTooltipPosition(
            linePosition.x + tooltipLeftMargin + savedRightPosition,
            linePosition.y - this.tooltip.clientHeight / 2
        );
        this.svg
            .selectAll(".vertical-line")
            .attr("x1", linePosition.x)
            .attr("x2", linePosition.x)
            .attr("y1", 0)
            .attr("y2", this.graphElem.clientHeight)
            .style("opacity", 1);

        this.svg
            .selectAll(".dot")
            .attr("cx", linePosition.x)
            .attr("cy", linePosition.y)
            .style("opacity", 1);

        return this;
    }
}
