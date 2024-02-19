export class BarGraphData {
    constructor(miningRecond) {
        if (miningRecond.income) {
            this.values = Number(miningRecond.income.split(" ")[0]);
        } else {
            this.values = Number(miningRecond.amount);
        }
    }

}
