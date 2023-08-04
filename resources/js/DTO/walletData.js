export class walletData {
    constructor(walletRecord) {
        this.wallet_address = walletRecord.wallet;
        this.fullName = walletRecord.fullName;
        this.name = walletRecord.name;
        this.currency = "BTC";
        this.total_payout = walletRecord.total_payout;
        this.percent = walletRecord.percent;
        this.minWithdrawal = walletRecord.minWithdrawal;
    }
}
