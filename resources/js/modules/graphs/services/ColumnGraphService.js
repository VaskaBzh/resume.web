import { GraphService } from "@/modules/graphs/services/extends/GraphService";
import * as d3 from "d3";

export class ColumnGraphService extends GraphService {
    constructor(graphData, translate) {
        super(graphData, translate);
    }

    appendBars() {
        this.svg
            .append("g")
            .attr("fill", "rgba(83, 177, 253, 0.15)")
            .selectAll("rect")
            .data(this.graphData.sort((a, b) => d3.descending(a.amount, b.amount))
            .join("rect")
            .attr("x", (d, i) => this.x(i))
            .attr("y", d => this.y(d.amount))
            .attr("height", d => this.y(0) - this.y(d.amount)))
            .attr("width", this.x.bandWidth())

        return this;
    }


    svgNode() {
        this.svg.node();

        return this;
    }

    graphAppends() {
        this.appendBars()
            .svgNode();
        console.log(this.svg)

        return this;
    }
}
