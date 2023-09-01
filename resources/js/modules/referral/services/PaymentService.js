import { TableService } from "@/services/extends/TableService";

import { PaymentData } from "@/modules/referral/DTO/PaymentData";
import api from "@/api/api";

export class PaymentService extends TableService {
    constructor(id, translate, titleIndexes) {
        super(translate, titleIndexes);

        this.user_id = id;
    }
    setter(referral) {
        return new PaymentData(
            this.dateFormatter(referral["created_at"]),
            referral["email"],
            referral["worker_count"],
            referral["hash"],
            "T",
            referral["daily_amount"]
        );
    }

    async fetchIncomes(page, per_page) {
        return await api.get(
            `/referrals/incomes/${this.user_id}?page=${page}&per_page=${per_page}`
        );
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`income_titles[${index}]`)
        );
    }

    async index(page = 1, per_page = 15) {
        this.waitTable = true;

        let response = {};

        try {
            response = await this.fetchIncomes(page, per_page);

            this.meta = { meta: response.data };

            this.rows = response.data.data.map((el) => {
                return this.setter(el);
            });

            this.titles = this.useTranslater([0, 1, 2, 3, 4]);
        } catch (err) {
            console.error(`FetchError: ${err}`);
        }

        return this;
    }

    async setTable(page = 1, per_page = 15) {
        await this.index(page, per_page);

        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        this.waitTable = false;

        return this;
    }
}
