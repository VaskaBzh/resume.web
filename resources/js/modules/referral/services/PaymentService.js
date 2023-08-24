import { TableService } from "@/services/extends/TableService";

import store from "@/store";
import { PaymentData } from "@/modules/referral/DTO/PaymentData";

export class PaymentService extends TableService {
    setter(referral) {
        new PaymentData(
            this.dateFormatter(referral["created_at"]),
            referral["email"],
            referral["workers_active"],
            referral["workers_inactive"],
            referral["hash"],
            "T",
            this.dateFormatter(referral["created_at"]),
            referral["amount"]
        );
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`income_titles[${index}]`)
        );
    }
    async index(page = 1, per_page = 15) {
        if (store.getters.getActive !== -1) {
            this.waitTable = true;

            let response;

            response = await this.fetchIncomes(page, per_page);

            this.meta = response.data;

            this.rows = response.data.data.map((el) => {
                return this.setter(el);
            });

            this.titles = this.useTranslater([0, 1, 2, 3, 4]);

            return this;
        }
    }

    async setTable(page = 1, per_page = 15) {
        await this.index(page, per_page);

        this.table.set("titles", this.titles);
        this.table.set("rows", this.rows);

        this.waitTable = false;

        return this;
    }
}
