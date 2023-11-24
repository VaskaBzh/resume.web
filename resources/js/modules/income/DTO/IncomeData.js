export class IncomeData {
    constructor(incomeRecord) {
        this.incomeDate = incomeRecord.created_at;
        this.income = incomeRecord.dailyAmount;
        this.hashRate = incomeRecord.hashrate;
        this.unit = incomeRecord.unit;
        this.payoutDate = incomeRecord.payout_date;
        this.walletAddress = incomeRecord.wallet_address;
        this.payout = incomeRecord.payout;
        this.txid = incomeRecord.txid;
        this.status = incomeRecord.status;

        this.renderHashRate = `${this.hashRate} ${this.unit}`;
    }
}
