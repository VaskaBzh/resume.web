import { LineGraphData } from "@/modules/graphs/DTO/LineGraphData";

export class GraphDataService {
    constructor(offset = 96) {
        this.offset = offset;

        this.graph = {};
        this.records = [];
    }

    setRecords(newRecordsData, GraphData = LineGraphData) {
        this.records = newRecordsData.map(recordElem => new GraphData(recordElem));

        console.log(this.records)

        return this;
    }

    setOffset(offset) {
        this.offset = offset;

        return this;
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    makeEmptyValues(graphData, objectKeys) {
        if (graphData.values.length < this.offset) {
            objectKeys.forEach(key => {
                for (let i = 0; i < this.offset - 1; i++) {
                    if (graphData[key].length < this.offset) {
                        graphData[key].push(0);
                    }
                }
            })
        }

        return this;
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

        // this.makeEmptyValues(graphData, objectKeys);

        Object.assign(this.graph, graphData);
    }
}
