export class LineGraphData {
    constructor(hashrateRecord) {
        this.values = hashrateRecord.hash;
        this.unit = hashrateRecord.unit;
        this.amount = hashrateRecord.worker_count;
        this.dayAt = hashrateRecord.day_at;
        this.hourAt = hashrateRecord.hour_at;

        this.dates = new Date(hashrateRecord.day_at.split(".").reverse().join("-") + ":" + hashrateRecord.hour_at);
    }
}
