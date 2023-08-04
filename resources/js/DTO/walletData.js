export class walletData {
    constructor(walletRecord) {
        this.wallet_address = walletRecord.wallet;
        this.fullName = walletRecord.fullName;
        this.name = walletRecord.name;
        this.currency = "BTC";
        this.payment = walletRecord.payment;
        this.percent = walletRecord.percent;
        this.minWithdrawal = walletRecord.minWithdrawal;
    }
}
