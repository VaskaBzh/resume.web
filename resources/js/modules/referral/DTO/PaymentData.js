export class PaymentData {
    constructor(date, mail, amount, hashRate, unit) {
        this.date = date;
        this.mail = mail;
        this.amount = `${amount} BTC`;
        // this.workers = workers;
        // workers
        this.hashRate = `${hashRate} ${unit}h/s`;
    }
}
