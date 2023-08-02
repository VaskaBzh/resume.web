export class paymentData {
    constructor(datePay, payment, wallet, txid) {
        this.datePay = datePay;
        this.payment = `${payment} BTC`;
        this.txid = txid;
        this.wallet = wallet;
    }
}
