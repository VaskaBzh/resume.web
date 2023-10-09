import { GraphService } from "@/modules/graphs/services/extends/GraphService";

export class LineGraphService extends GraphService {
    constructor(graphData, translate) {
        super(graphData, translate);
    }

    setDate(nearestIndex) {
        const date = new Date(this.graphData.dates[nearestIndex]);

        this.fullDate = date.getUTCFullYear() +
            "." +
            date.getDate().toString().padStart(2, "0") +
            "." +
            (date.getMonth() + 1).toString().padStart(2, "0");
        if (this.graphData.values.length > 96)
            this.time =
                date.getDate().toString().padStart(2, "0") +
                "." +
                (date.getMonth() + 1).toString().padStart(2, "0");
        else this.time = date.getUTCHours().toString().padStart(2, "0") + ":00";
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
            .attr("stop-color", "rgba(46, 144, 250, 0.8)");

        gradient
            .append("stop")
            .attr("offset", "100%")
            .attr("stop-color", "rgba(46, 144, 250, 0)");

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

    createCircle(lineFill) {
        this.svg
            .append("circle")
            .attr("class", "dot")
            .attr("r", 6)
            .style("opacity", 0)
            .attr("fill", lineFill)
            .attr("stroke", "#2E90FA")
            .attr("stroke-width", 2);

        return this;
    }

    createLine() {
        this.svg
            .append("path")
            .datum(this.graphData.values)
            .attr("d", this.lineGenerator)
            .attr("fill", "none")
            .attr("class", "main_line")
            .attr("width", "100%")
            .attr("stroke", "#2E90FA")
            .attr("stroke-width", 1);

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
            .attr("stroke-width", 1)
            .style("opacity", 0)
            .attr("stroke-dasharray", "10")
            .attr("stroke", "rgba(152, 162, 179, 0.5)");
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

    appendBands(bandColor) {
        this.svg
            .selectAll(".band")
            .data(this.yBand.domain())
            .enter()
            .append("rect")
            .attr("class", "band")
            .attr("y", (d) => this.y(d) - 1)
            .attr("height", 1)
            .attr("width", "100%")
            .attr("fill", bandColor);
        //this.bandColor

        return this;
    }

    graphAppends(colors) {
        this.appendBands(colors.bands)
            .appendGradient()
            .createMouseLine()
            .createLine()
            .createCircle(colors.circle)
            .appendXAxis();

        !this.isMobile ? this.appendYAxis() : this.createAxis();

        return this;
    }
}
