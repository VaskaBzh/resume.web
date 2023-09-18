import { GraphService } from "@/modules/graphs/services/extends/GraphService";

export class ColumnGraphService extends GraphService {
    constructor(graphData, translate) {
        super(graphData, translate);
    }


    graphAppends() {

        return this;
    }
}
