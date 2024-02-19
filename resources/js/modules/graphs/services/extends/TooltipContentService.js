export class TooltipContentService {
    fullDate = null;
    time = null;
    hashrate = null;
    workersCountActive = null;
    unit = null;

    setDate(graphData, nearestIndex) {
        this.fullDate = graphData.dates[nearestIndex].day_at;
        this.time = graphData.dates[nearestIndex].hour_at;
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
