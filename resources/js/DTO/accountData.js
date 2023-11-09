export class accountData {
    constructor(accountRecord) {
        this.group_id = accountRecord.group_id;
        this.name = accountRecord.sub;
        this.workers_count_active = accountRecord.workers_count_active;
        this.workers_count_in_active = accountRecord.workers_count_in_active;
        this.workers_count_unstable = accountRecord.workers_count_unstable;
        this.hash_per_min = accountRecord.hash_per_min;
        this.hash_per_day = accountRecord.hash_per_day;
        this.unit = accountRecord.unit;
        this.today_forecast = accountRecord.today_forecast;
        this.yesterday_amount = accountRecord.yesterday_amount;
        this.total_payout = accountRecord.total_payout;
        this.last_month_amount = accountRecord.last_month_amount;
        this.total_incomes = accountRecord.total_incomes;
        this.pending_amount = accountRecord.pending_amount;
        this.reject_percent = accountRecord.reject_percent;
    }
}
