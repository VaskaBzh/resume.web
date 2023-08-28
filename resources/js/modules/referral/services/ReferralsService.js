import { TableService } from "@/services/extends/TableService";
import { ReferralsData } from "@/modules/referral/DTO/ReferralsData";
import { GradeData } from "@/modules/referral/DTO/GradeData";

import { PercentSvgEnum } from "@/modules/referral/enums/PercentSvgEnum";

import api from "@/api/api";

export class ReferralsService extends TableService {
    constructor(id, translate, titleIndexes) {
        super(translate, titleIndexes);

        this.user_id = id;
    }

    setter(referral) {
        return new ReferralsData(
            referral["email"],
            referral["referral_active_workers_count"],
            referral["workers_count_in_active"],
            referral["referral_hash_per_day"],
            "T",
            // this.dateFormatter(referral["created_at"]),
            referral["total_amount"]
        );
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`referrals_titles[${index}]`)
        );
    }

    async fetchReferrals(page, per_page) {
        return await api.get(`/referrals/${this.user_id}`);
    }

    async index(page = 1, per_page = 15) {
        this.waitTable = true;

        let response = {};

        try {
            response = await this.fetchReferrals(page, per_page);

            this.meta = response.data;

            this.rows = response.data.data.map((el) => {
                return this.setter(el);
            });

            this.titles = this.useTranslater([0, 1, 2, 4]);
        } catch(err) {
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