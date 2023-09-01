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
        this.amount = `${amount} BTC`;
    }
}
