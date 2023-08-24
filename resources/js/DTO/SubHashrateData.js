export class SubHashrateData {
    constructor(hashrateRecord) {
        this.hashrate = hashrateRecord.hash;
        this.unit = hashrateRecord.unit;
        console.log(hashrateRecord);
        this.amount = hashrateRecord.worker_count;
    }
}
