import { LineGraphService } from "@/modules/graphs/services/LineGraphService";
import { ColumnGraphService } from "@/modules/graphs/services/ColumnGraphService";

export class GraphFactory {
    static types = {
        line: LineGraphService,
        bar: ColumnGraphService,
    };

    static createGraph(type) {
        return new this.types[type]();
    }
}
