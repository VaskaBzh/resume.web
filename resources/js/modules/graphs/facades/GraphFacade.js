import { ElementsConfig } from "@/modules/graphs/configs/ElementsConfig";
import { GraphFactory } from "@/modules/graphs/Factories/GraphFactory";

export class GraphFacade {
    buildGraph(element, type, graphData) {
        this.graph = GraphFactory.createGraph(type);

        if (element && graphData) {
            // .fillElements(ElementsConfig[type])
            this.graph
                .createGraph(element)
                .setGraphData(graphData)
                .setGraphX()
                .setGraphY()
                .fillGenerators(graphData)
                .buildElements();
        }
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
        this.graph.dropGraph();

        return this;
    }
}
