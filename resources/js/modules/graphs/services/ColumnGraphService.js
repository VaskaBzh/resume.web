import { GraphService } from "@/modules/graphs/services/extends/GraphService";
import * as d3 from "d3";

export class ColumnGraphService extends GraphService {
    constructor(graphData, translate) {
        super(graphData, translate);

        this.mining = null;
    }

    emptyValidationRules() {
        return d3.max(this.graphData.values) !== 0
            ? d3.max(this.graphData.values)
            : 0.005;
    }

    getPosition() {
        if (this.mouseX)
            return {
                side: "left",
                position: this.mouseX - this.tooltipHtml.clientWidth / 2,
            };
    }

    setOtherElements() {}

    setMining(nearestIndex) {
        this.mining = this.graphData.values[nearestIndex];
    }

    setActualValues(nearestIndex) {
        this.setDate(nearestIndex);
        this.setMining(nearestIndex);
    }

    updateTooltip(event, position) {
        this.tooltipInit(event);

        this.tooltip
            .style("top", position.y - this.tooltipHtml.clientHeight + "px")
            .style("opacity", 1);
    }

    dropBarsStyles() {
        const bars = this.svg.selectAll("path").nodes();

        bars.forEach((bar) => {
            bar.setAttribute("style", "transition: all 0.3s ease 0s;");
        });
    }

    getClosestPoint(touchX) {
        const bars = this.svg.selectAll("path").nodes();
        let closestBar = null;

        bars.forEach((bar, i) => {
            bar.setAttribute("style", "transition: all 0.3s ease 0s;");

            const barWidth = (this.chartHtml.offsetWidth + 18) / bars.length;
            const barIndex = Math.floor(touchX / barWidth);

            if (barIndex === i) {
                closestBar = bar;

                bar.setAttribute(
                    "style",
                    "fill: #2E90FA; transition: all 0.3s ease 0s;"
                );
            }
        });

        if (closestBar) {
            const rect = closestBar.getBoundingClientRect();
            return {
                x: touchX,
                y: this.chartHtml.offsetHeight - rect.height - 16,
            };
        }

        return null;
    }

    setSvgEvents() {
        this.svg.on("mousemove", (event) => {
            const mouseX = d3.pointer(event)[0];
            const position = this.getClosestPoint(mouseX);

            this.updateTooltip(event, position);
        });

        this.svg.on("mouseleave", () => {
            this.tooltip.style("opacity", 0);
            this.dropBarsStyles();
        });

        return this;
    }

    appendBars() {
        this.svg
            .append("g")
            .attr("fill", "rgba(83, 177, 253, 0.15)")
            .selectAll("path")
            .attr("class", "bar")
            .style("transition", "all 0.3s ease 0s")
            .data(this.graphData.values)
            .join("path")
            .attr("d", (d, i) => {
                const x = this.x(i);
                const y = this.y(d) >= 84 ? 84 : this.y(d);
                const width = this.chartHtml.offsetWidth / 31;
                const height =
                    this.y(0) - this.y(d) <= 1 ? 1 : this.y(0) - this.y(d);
                const rx = this.y(0) - this.y(d) <= 1 ? 0 : 6;

                return `
                    M ${x + rx} ${y}
                    h ${width - 2 * rx}
                    a ${rx} ${rx} 0 0 1 ${rx} ${rx}
                    v ${height - rx}
                    h -${width}
                    v -${height - rx}
                    a ${rx} ${rx} 0 0 1 ${rx} -${rx}
                `;
            });

        return this;
    }

    svgNode() {
        this.svg.node();

        return this;
    }

    graphAppends() {
        this.appendBars().svgNode();

        return this;
    }
}
