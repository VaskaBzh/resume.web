import { LineGraphData } from "@/modules/graphs/DTO/LineGraphData";
import { DatesFillKeysEnum } from "@/modules/graphs/enums/DatesFillKeysEnum";
import { DatesFillConfig } from "@/modules/graphs/configs/DatesFillConfig";

export class GraphDataService {
    offset = 0;
    intervalInMinutes = 0;
    graph = {};
    records = [];

    setRecords(newRecordsData, GraphData = LineGraphData) {
        this.records = Object.values(newRecordsData).map(
            (recordElem) => new GraphData(recordElem)
        );

        return this;
    }

    setOffset(newOffset) {
        this.offset = newOffset;

        return this;
    }

    setInterval(newInterval) {
        this.intervalInMinutes = newInterval;

        return this;
    }

    randomizeTest(min, max) {
        return Math.random() * (max - min) + min;
    }

    makeEmptyValues(graphData, objectKeys) {
        if (graphData.values.length < this.offset) {
            objectKeys.forEach((key) => {
                if (DatesFillKeysEnum[key]) {
                    return this;
                }

                for (let i = 0; i < this.offset - 1; i++) {
                    if (graphData[key].length < this.offset) {
                        if (key === "unit") {
                            graphData[key].push("T");
                        } else {
                            graphData[key].push(0);
                        }
                    }
                }
            });

            const intervalInMilliseconds = this.intervalInMinutes * 60 * 1000;
            const latestDate = graphData.dates[graphData.dates.length - 1];

            Object.keys(DatesFillKeysEnum).forEach((key) => {
                if (!graphData[key]) {
                    return this;
                }

                let latestTimestamp = latestDate.getTime();

                for (let i = 0; i < this.offset - 1; i++) {
                    if (graphData[key].length < this.offset) {
                        latestTimestamp =
                            latestTimestamp - intervalInMilliseconds;

                        graphData[key].push(
                            DatesFillConfig[key](latestTimestamp)
                        );
                    }
                }
            });
        }

        return this;
    }

    makeFullValues() {
        let data = {};

        const objectKeys = Object.keys(this.records[0]);

        objectKeys.forEach((key) => (data = { ...data, [key]: [] }));

        const graphData = {
            ...this.records.slice(-this.offset).reduce(
                (acc, el) => {
                    Object.keys(el).forEach((key) => {
                        acc[key].push(el[key] || 0);
                    });

                    return acc;
                },
                { ...data }
            ),
        };

        this.makeEmptyValues(graphData, objectKeys);

        objectKeys.forEach((key) => {
            graphData[key].reverse();
        });

        Object.assign(this.graph, graphData);
    }
}
