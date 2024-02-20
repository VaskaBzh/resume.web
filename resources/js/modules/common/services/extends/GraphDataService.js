import { LineGraphData } from "@/modules/graphs/DTO/LineGraphData";

export class GraphDataService {
    constructor(offset = 96) {
        this.offset = offset;

        this.graph = {};
        this.records = [];
    }

    setRecords(newRecordsData, GraphData = LineGraphData) {
        this.records = newRecordsData.map(recordElem => new GraphData(recordElem, this.offset === 96 ? "hour_at" : "day_at"));

        return this;
    }

    setOffset(offset) {
        this.offset = offset;

        return this;
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    makeFullValues() {
        let data = {};

        const objectKeys = Object.keys(this.records[0]);

        objectKeys.forEach(key => data = { ...data, [key]: [] });

        const graphData = {
            ...this.records.slice(-this.offset).reduce(
                (acc, el) => {
                    Object.keys(el).forEach(key => {
                        acc[key].push(el[key] || 0);
                    })

                    return acc;
                },
                { ...data }
            )
        };

        objectKeys.forEach(key => {
            graphData[key].reverse();
        })

        Object.assign(this.graph, graphData);
    }
}
