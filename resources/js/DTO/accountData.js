export class accountData {
    constructor(accountRecord) {
        this.group_id = accountRecord.group_id;
        this.name = accountRecord.name;
        this.workers_count_active = accountRecord.workers_count_active;
        this.workers_count_in_active = accountRecord.workers_count_inactive;
        this.workers_count_unstable = accountRecord.workers_count_dead;

        this.workers_count =
            this.workers_count_active + this.workers_count_in_active;

        this.hash_per_min = accountRecord.hash_per_min;
        this.hash_per_day = accountRecord.hash_per_day;
        this.hash_per_day_unit = accountRecord.hash_per_day_unit;
        this.hash_per_min_unit = accountRecord.hash_per_min_unit;

        this.hash_per_min_format = `${this.hash_per_min} ${this.hash_per_min_unit}H/s`;
        this.hash_per_day_format = `${this.hash_per_day} ${this.hash_per_day_unit}H/s`;

        this.today_forecast = accountRecord.today_forecast;
        this.yesterday_amount = accountRecord.yesterday_amount;
        this.total_payout = accountRecord.total_payout;
        this.last_month_amount = accountRecord.last_month_amount;
        this.total_amount = accountRecord.total_amount;
        this.pending_amount = accountRecord.pending_amount;
        this.reject_percent = accountRecord.reject_percent;
    }
}
