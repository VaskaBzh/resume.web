import { TableService } from "@/services/extends/TableService";

import { PaymentData } from "@/modules/referral/DTO/PaymentData";
import { ProfileApi } from "@/api/api";
import store from "@/store";

export class PaymentService extends TableService {
    constructor(translate, titleIndexes) {
        super(translate, titleIndexes);

        this.user = null;
    }

    setUser(user) {
        this.user = user;
    }

    setter(referral) {
        // referral["worker_count"],
        return new PaymentData(
            this.dateFormatter(referral["created_at"]),
            referral["email"],
            referral["daily_amount"],
            referral["hash"],
            "T",
        );
    }

    async fetchIncomes(page, per_page) {
        return await ProfileApi.get(`/referrals/incomes/${this.user.id}?page=${1}&per_page=${1000}`);
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`income_titles[${index}]`)
        );
    }

    async index(page = 1, per_page = 15) {
        this.emptyTable = false;
        this.waitTable = true;

        let response = {};

        try {
            response = await this.fetchIncomes(page, per_page);

            this.meta = { meta: response.data };

            this.rows = response.data.data.map((el) => {
                return this.setter(el);
            });
            this.rows = response.data.data.map((el) => {
                return this.setter(el);
            });

            if (this.rows.length === 0) {
                this.emptyTable = true;
            }

            this.titles = this.useTranslater([0, 1, 2, 4]);
        } catch (err) {
            console.error(`FetchError: ${err}`);

            this.emptyTable = true;
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
