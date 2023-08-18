export class ReferralsData {
    constructor(
        mail,
        workersActive,
        workers_inactive,
        hashrate,
        unit,
        init_date,
        amount
    ) {
        this.mail = mail;
        this.workersActive = workersActive;
        this.workers_inactive = workers_inactive;
        this.hashrate = `${hashrate} ${unit}h/s`;
        this.init_date = init_date;
        this.amount = `${amount} BTC`;
    }
}
