import { ElementsConfig } from "@/modules/graphs/configs/ElementsConfig";
import { GraphFactory } from "@/modules/graphs/factories/GraphFactory";

export class GraphFacade {
    buildGraph(element, tooltip, type, graphData) {
        this.graphService = GraphFactory.createGraph(type);

        if (!element || !graphData) {
            return this;
        }

        // .fillElements(ElementsConfig[type])
        this.graphService
            .createGraph(element)
            .setTooltipHtml(element)
            .setGraphData(graphData)
            .setGraphX()
            .setGraphY()
            .fillGenerators(graphData)
            .buildElements();

        this.graphService.createListeners();
    }

    createGraph(...args) {
        this.buildGraph(...args);

        return this;
    }

    rebuildGraph(...args) {
        this.dropGraph().buildGraph(...args);

        return this;
    }

    dropGraph() {
        this.graphService.dropGraph().dropListeners();

        return this;
    }
}
