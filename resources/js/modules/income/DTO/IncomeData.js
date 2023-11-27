export class IncomeData {
    constructor(incomeRecord) {
        this.incomeDate = incomeRecord.income_at;
        this.income = incomeRecord.amount;
        this.hashRate = incomeRecord.hash;
        this.unit = incomeRecord.unit ?? "T";
        this.payoutDate = incomeRecord.payout_at;
        this.walletAddress = incomeRecord.wallet;
        this.payout = incomeRecord.payout;
        this.txid = incomeRecord.tx_id;
        this.status = incomeRecord.status;

        // this.renderHashRate = `${this.hashRate} ${this.unit}`;
    }
}
