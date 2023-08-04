export class workerData {
    constructor(workerRecord) {
        // this.status = workerRecord.status;
        this.class = workerRecord.status;
        this.name = workerRecord.worker_name;
        this.name = String(this.name).split(".")[1];
        this.hashrate = `${workerRecord.shares_1m} ${workerRecord.shares_unit}h/s`;
        // this.hashrate_per_hour =
        //     workerRecord.shares_1h + workerRecord.shares_unit;
        this.hashrate_per_day = `${workerRecord.shares_1d} ${workerRecord.shares_1d_unit}h/s`;
        // this.unit = workerRecord.shares_unit;
        // this.unit_per_day = workerRecord.shares_1d_unit;
        this.reject_percent = `${workerRecord.reject_percent} %`;
        this.graphId = workerRecord.worker_id;
        this.data = "#seeChart";
    }
}
