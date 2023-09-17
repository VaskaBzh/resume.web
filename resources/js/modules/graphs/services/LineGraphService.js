import { GraphService } from "@/modules/graphs/services/extends/GraphService";

export class LineGraphService extends GraphService {
    constructor(graphData, translate) {
        super(graphData, translate);
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

        return this;
    }

    createAxis() {
        let axisHeight = this.containerHeight + 5;
        this.axis
            .attr("style", `height: ${axisHeight}px`)
            .call(this.yAxis)
            .select(".domain")
            .remove();

        return this;
    }

    appendYAxis() {
        this.svg
            .append("g")
            .attr("transform", `translate(-5, 0)`)
            .call(this.yAxis)
            .select(".domain")
            .remove();

        return this;
    }

    appendXAxis() {
        this.svg
            .append("g")
            .attr("transform", `translate(0, ${this.containerHeight + 5})`)
            .call(this.xAxis)
            .select(".domain")
            .remove();

        return this;
    }

    createCircle() {
        this.svg
            .append("circle")
            .attr("class", "dot")
            .attr("r", 6)
            .style("opacity", 0)
            .attr("fill", "#000000")
            .attr("stroke", "#ffffff")
            .attr("stroke-width", 2);
        // this.circleColor
        // this.circleBorder

        return this;
    }

    createLines() {
        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", this.lineGenerator)
            .attr("fill", "none")
            .attr("class", "main_line")
            .attr("width", "100%")
            .attr("stroke", "#000000")
            .attr("stroke-width", "#ffffff");
        // this.lineColor
        // this.lineWidth

        return this;
    }

    createMouseLine() {
        this.svg
            .append("line")
            .attr("class", "vertical-line")
            .attr("x1", 0)
            .attr("y1", 0)
            .attr("x2", 0)
            .attr("y2", this.containerHeight)
            .attr("stroke-width", 3)
            .style("opacity", 0)
            .attr("stroke", "#ffffff");
        // this.mouseLineColor

        return this;
    }

    appendGradient() {
        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", this.areaGenerator)
            .attr("width", "100%")
            .attr("fill", "url(#gradient)");

        return this;
    }

    appendBands() {
        this.svg
            .selectAll(".band")
            .data(this.yBand.domain())
            .enter()
            .append("rect")
            .attr("class", "band")
            .attr("y", (d) => this.y(d) - 1)
            .attr("height", 1)
            .attr("width", "100%")
            .attr("fill", "#ffffff");
        //this.bandColor

        return this;
    }

    graphAppends() {
        this.appendBands()
            .appendGradient()
            .createMouseLine()
            .createLines()
            .createCircle()
            .appendXAxis();

        if (!this.isMobile) {
            this.appendYAxis();
        } else {
            this.createAxis();
        }

        return this;
    }
}
