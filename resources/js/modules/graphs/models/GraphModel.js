import { D3ElementModel } from "@/modules/graphs/models/D3ElementModel";
import { TooltipModel } from "@/modules/graphs/models/TooltipModel";
import { ElementsConfig } from "@/modules/graphs/configs/ElementsConfig";
import { ElementsCreateFunctions } from "@/modules/graphs/configs/ElementsCreateFunctions";
import * as d3 from "d3";

export class GraphModel {
    elements = [];
    generators = {};

    constructor() {
        this.tooltip = this.createTooltipModel();
        this.d3Model = this.createD3Model();
    }

    createTooltipModel() {
        return new TooltipModel();
    }

    createD3Model() {
        return new D3ElementModel();
    }

    get graph() {
        return this.d3Model.svg._groups[0][0];
    }

    fillElements(type) {
        this.elements = ElementsConfig[type];

        return this;
    }

    buildElements() {
        this.elements.forEach(element => {
            // if (ElementsCreateFunctions[element]) {
            //     ElementsCreateFunctions[element](this.d3Model.svg, );
            // }
        });

        return this;
    }

    generatorsCreate(graphData) {
        this.generators = {
            x: d3.scaleLinear()
                .domain(d3.extent(graphData.dates, d => d))
                .range([0, this.graph.clientHeight]),
            y: "",
            area: d3.area()
                    .x((d, i) => this.generators.xNum(i))
                    .y0(this.graph.clientHeight)
                    .y1((d) => this.generators.y(d))
                    .curve(d3.curveBasis),
        }

        console.log(this.generators)
    }

    createGraph(element) {
        this.d3Model.createSvg(element)

        return this;
    }

    initGraph(element, type, graphData) {
        this.fillElements(type)
            .createGraph(element);

        this.generatorsCreate(graphData);
        this.buildElements(type);
    }
}
