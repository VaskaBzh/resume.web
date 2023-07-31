export class paymentData {
    constructor(datePay, payment, wallet, txid, className) {
        this.datePay = `${datePay} BTC`;
        this.payment = payment;
        this.txid = txid;
        this.wallet = wallet;
        this.class = className;
    }
}
