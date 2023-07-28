export class paymentData {
    constructor(datePay, payment, wallet, txid) {
        this.datePay = `${datePay} BTC`;
        this.payment = payment;
        this.txid = txid;
        this.wallet = wallet;
    }
}
