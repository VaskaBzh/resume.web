export class PaymentData {
    constructor(date, mail, amount, workers, hashRate, unit) {
        this.date = date;
        this.mail = mail;
        this.amount = `${amount} BTC`;
        this.workers = workers;
        this.hashRate = `${hashRate} ${unit}h/s`;
    }
}
