export class IncomeData {
    constructor(incomeRecord) {
        this.incomeDate = incomeRecord.income_at;
        this.income = `${incomeRecord.amount} BTC`;
        this.hash_per_day = incomeRecord.hash;
        this.hash_per_day_unit = incomeRecord.unit ?? "T";
        this.renderHashRate = `${this.hash_per_day} ${this.hash_per_day_unit}H/s`;
        this.payoutDate = incomeRecord.payout_at || "-";
        this.walletAddress = this.getCuttedWallet(incomeRecord.wallet);
        this.payout = incomeRecord.payout
            ? `${incomeRecord.payout} BTC`
            : "-";
        this.txid = incomeRecord.tx_id || "-";
        this.status = incomeRecord.status;
    }

    getCuttedWallet(wallet) {
        let cuttedWallet = "-";

        if (wallet) {
            cuttedWallet =
                wallet.substr(0, 6) +
                "..." +
                wallet.substr(wallet.length - 6, wallet.length);
        }

        return cuttedWallet;
    }
}
