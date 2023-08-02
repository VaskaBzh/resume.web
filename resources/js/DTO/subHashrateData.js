export class subHashrateData {
    constructor(hashrateRecord) {
        this.hashrate = hashrateRecord.hash;
        this.unit = hashrateRecord.unit;
        this.amount = hashrateRecord.amount;
    }
}
