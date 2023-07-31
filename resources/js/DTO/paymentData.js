export class paymentData {
    constructor(datePay, payment, wallet, txid, status, className) {
        this.datePay = datePay;
        this.payment = `${payment} BTC`;
        this.txid = txid;
        this.wallet = wallet;
        this.class = className;
    }
}
