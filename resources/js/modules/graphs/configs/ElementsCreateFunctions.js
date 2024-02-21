import * as d3 from "d3";

export const ElementsCreateFunctions = {
    // bands(...args) {
    //     args[0]
    //         .selectAll(".band")
    //         .data(args[1].domain())
    //         .enter()
    //         .append("rect")
    //         .attr("class", "band")
    //         .attr("y", (d) => args[2](d) - 1)
    //         .attr("height", 1)
    //         .attr("width", "100%")
    //         .attr("fill", args[3] ?? "rgba(47,47,47,0.95)");
    // },
    // area(...args) {
    //     const gradient = args[0]
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
    // },
    line(...args) {
        args[0]
            .append("path")
            .datum(this.graphData.values)
            .attr("d", this.lineGenerator)
            .attr("fill", "none")
            .attr("class", "main_line")
            .attr("width", "100%")
            .attr("stroke", "#2E90FA")
            .attr("stroke-width", 1);
    },
    // axisY(...args) {
    //     const HashrateUnitEnum = {
    //         T: "TH/s",
    //         P: "PH/s",
    //         E: "EH/s",
    //     };
    //
    //     let includedUnit = HashrateUnitEnum["T"];
    //
    //     if (args[0].unit.includes("E")) {
    //         includedUnit = HashrateUnitEnum["E"];
    //     } else if (args[0].unit.includes("P")) {
    //         includedUnit = HashrateUnitEnum["P"];
    //     }
    //
    //     d3.select(".chart_axis-y")
    //         .append("text")
    //         .attr("x", -25)
    //         .attr("y", 0)
    //         .attr("text-anchor", "middle")
    //         .style("font-size", "16px")
    //         .style("font-weight", "100")
    //         .attr('fill', '#6F7682')
    //         .attr('stroke-width', '.8')
    //         .text(`${includedUnit}`)
    //         .call(args[1])
    //         .select(".domain")
    //         .remove();
    // },
    // axisX(...args) {
    //     d3.select(".chart_axis-x")
    //         .call(args[0])
    //         .select(".domain")
    //         .remove();
    // },
};
