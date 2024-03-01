import { TimeFormatter } from "@/formatters/TimeFormatter";

export class BarGraphData {
    constructor(miningRecond) {
        if (miningRecond.income) {
            this.values = Number(miningRecond.income.split(" ")[0]);
            this.mining = Number(miningRecond.income.split(" ")[0]);

            this.dayAt = miningRecond.incomeDate;

            this.dates = new Date(
                miningRecond.incomeDate.split(".").reverse().join(".")
            );
        } else {
            this.values = Number(miningRecond.amount ?? 0);
            this.mining = Number(miningRecond.amount ?? 0);

            this.dayAt = miningRecond.income_at ?? TimeFormatter.formatTime("yy.mm.dd", new Date().getTime());

            this.dates = new Date(
                miningRecond.income_at.split(".").reverse().join(".")
            );
        }
    }
}
