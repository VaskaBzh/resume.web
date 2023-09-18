export class LineGraphData {
    constructor(hashrateRecord) {
        this.hashrate = hashrateRecord.hash;
        this.unit = hashrateRecord.unit;
        this.amount = hashrateRecord.worker_count;
    }
}
