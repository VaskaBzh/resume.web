import { TableService } from "@/services/extends/TableService";
import { ReferralsData } from "@/modules/referral/DTO/ReferralsData";
import { GradeData } from "@/modules/referral/DTO/GradeData";

import { PercentSvgEnum } from "@/modules/referral/enums/PercentSvgEnum";

import store from "@/store";

export class ReferralsService extends TableService {
    setter(referral) {
        new ReferralsData(
            referral["email"],
            referral["workers_active"],
            referral["workers_inactive"],
            referral["hash"],
            "T",
            this.dateFormatter(referral["created_at"]),
            referral["amount"]
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

        if (store.getters.getActive !== -1) {
            this.waitTable = false;
        }

        return this;
    }

    getGradeList() {
        this.gradeList = [];

        this.gradeList = [
            ...this.gradeList,
            new GradeData("0.8", "> 30"),
            new GradeData("0.9", "30 - 49"),
            new GradeData("1.0", "75 - 99"),
            new GradeData("1.25", "75 - 99"),
            new GradeData("1.5", "100 - 199"),
            new GradeData("2.0", "200 - 299"),
            new GradeData("< 3", "300 - 500"),
        ];
    }

    getPercent() {
        this.percent = 0;
        this.percentSvg = ``;

        this.percentSvg = PercentSvgEnum.svg;
        this.percent = 0.8;
    }
}
