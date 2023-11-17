export class ReferralsData {
    constructor(
        mail,
        workersActive,
        workersInActive,
        hashrate,
        unit,
        amount
    ) {
        this.mail = mail;
        this.workers_stats = `${workersActive} / ${workersInActive}`;
        this.hashrate = `${hashrate} ${unit}h/s`;
        // this.init_date = init_date;
        // init_date,
        this.amount = `${amount} BTC`;
    }
}
