export class ReferralsData {
    constructor(
        mail,
        workersActive,
        workers_inactive,
        hashrate,
        unit,
        amount
    ) {
        this.mail = mail;
        this.workers = workersActive;
        this.hashrate = `${hashrate} ${unit}h/s`;
        this.amount = `${amount} BTC`;
    }
}
