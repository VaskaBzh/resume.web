import { D3ElementModel } from "@/modules/graphs/models/D3ElementModel";
import { TooltipModel } from "@/modules/graphs/models/TooltipModel";
import { ElementsConfig } from "@/modules/graphs/configs/ElementsConfig";
import { ElementsCreateFunctions } from "@/modules/graphs/configs/ElementsCreateFunctions";
import { ValidateDataService } from "@/modules/graphs/services/extends/ValidateDataService";
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
        return this.d3Model.svg;
    }

    get graphElem() {
        return this.graph._groups[0][0];
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
            x: d3.scaleTime([graphData.dates[0], graphData.dates[graphData.dates.length - 1]], [0, this.graphElem.clientWidth]),
            y: d3.scaleLinear([0, ValidateDataService.valueValidationRules(graphData.values)], [0, this.graphElem.clientHeight]),
            area: d3.area()
                .x((_, i) => this.graphElem.clientWidth / (graphData.dates.length - 1) * i)
                .y0(this.graphElem.clientHeight)
                .y1((d) => this.generators.y(d))
                .curve(d3.curveBasis),
            line: d3.line()
                .x((_, i) => this.graphElem.clientWidth / (graphData.dates.length - 1) * i)
                .y((d) => this.generators.y(d))
                .curve(d3.curveBasis),
        }
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
