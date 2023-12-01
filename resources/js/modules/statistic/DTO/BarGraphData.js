export class BarGraphData {
    constructor(miningRecond) {
        if (miningRecond.income) {
            this.amount = Number(miningRecond.income.split(" ")[0]);
        } else {
            this.amount = Number(miningRecond.amount);
        }
    }

}
