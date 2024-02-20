export class LineGraphData {
    constructor(hashrateRecord, dateKey) {
        this.values = hashrateRecord.hash;
        this.unit = hashrateRecord.unit;
        this.amount = hashrateRecord.worker_count;
        this.dayAt = hashrateRecord.day_at;
        this.hourAt = hashrateRecord.hour_at;

        this.dates = hashrateRecord[dateKey];
    }
}
