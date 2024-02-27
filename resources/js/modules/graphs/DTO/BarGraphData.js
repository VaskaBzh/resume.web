export class BarGraphData {
    constructor(miningRecond) {
        if (miningRecond.income) {
            this.values = Number(miningRecond.income.split(" ")[0]);
            this.mining = Number(miningRecond.income.split(" ")[0]);
        } else {
            this.values = Number(miningRecond.amount);
            this.mining = Number(miningRecond.amount);
        }

        this.dayAt = miningRecond.income_at;

        this.dates = new Date(miningRecond.income_at.split(".").reverse().join("."));
    }

}
