export class TooltipContentService {
    constructor() {
        this.fullDate = null;
        this.time = null;
        this.hashrate = null;
        this.workersCountActive = null;
        this.unit = null;
    }

    setDate(graphData, nearestIndex) {
        const date = new Date(graphData.dates[nearestIndex]);

        this.fullDate = date.getUTCFullYear();
        this.time =
            date.getDate().toString().padStart(2, "0") +
            "." +
            (date.getMonth() + 1).toString().padStart(2, "0");
    }

    setUnit(graphData, nearestIndex) {
        this.unit = graphData.unit ? graphData.unit[nearestIndex] : "T";
    }

    setHashrate(graphData, nearestIndex) {
        this.hashrate = graphData.values[nearestIndex];
    }

    setWorkers(graphData, nearestIndex) {
        if (graphData.amount) {
            this.workersCountActive = graphData.amount[nearestIndex];
        }
    }
}
