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
            : 0.005
    }

    appendBars() {
        this.svg
            .append("g")
            .attr("fill", "rgba(83, 177, 253, 0.15)")
            .selectAll("path")
            .data(this.graphData.values)
            .join("path")
            .attr("d", (d, i) => {
                const x = this.x(i);
                const y = this.y(d) >= 84 ? 84 : this.y(d);
                const width = this.chartHtml.offsetWidth / 31;
                const height = this.y(0) - this.y(d) <= 1 ? 1 : this.y(0) - this.y(d);
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
        this.appendBars()
            .svgNode();

        return this;
    }
}
