export class workerHashrateData {
    constructor(workerHashrateRecord) {
        this.hashrate = workerHashrateRecord.hash;
        this.unit = workerHashrateRecord.unit;
    }
}
