import { HashrateUnitEnum } from "@/modules/common/enums/HashrateUnitEnum";

export class TooltipContentService {
    dayAt = null;
    hourAt = null;
    hashrate = null;
    minig = null;
    workersCountActive = null;
    unit = null;

    setHourTime(graphData, nearestIndex) {
        this.hourAt = graphData.hourAt[nearestIndex];
    }

    setDayTime(graphData, nearestIndex) {
        this.dayAt = graphData.dayAt[nearestIndex];
    }

    setUnit(graphData, nearestIndex) {
        this.unit = graphData.unit ? graphData.unit[nearestIndex] : HashrateUnitEnum.terahash;
    }

    setHashrate(graphData, nearestIndex) {
        this.hashrate = graphData.values[nearestIndex];
    }

    setMining(graphData, nearestIndex) {
        this.minig = graphData.values[nearestIndex];
    }

    setWorkers(graphData, nearestIndex) {
        if (graphData.amount) {
            this.workersCountActive = graphData.amount[nearestIndex];
        }
    }
}
