import { TableService } from "@/services/extends/TableService";
import { ReferralsData } from "@/modules/referral/DTO/ReferralsData";
import { GradeData } from "@/modules/referral/DTO/GradeData";

import { PercentSvgEnum } from "@/modules/referral/enums/PercentSvgEnum";

import { ProfileApi } from "@/api/api";
import store from "@/store";

export class ReferralsService extends TableService {
    constructor(translate, titleIndexes) {
        super(translate, titleIndexes);

        this.user = null;
    }

    setter(referral) {
        return new ReferralsData(
            referral["email"],
            referral["referral_active_workers_count"],
            referral["referral_inactive_workers_count"],
            referral["referral_hash_per_day"],
            "T",
            // this.dateFormatter(referral["created_at"]),
            referral["total_amount"] === 0
                ? "0.00000000"
                : referral["total_amount"]
        );
    }

    setUser(user) {
        this.user = user;
    }

    useTranslater(indexes) {
        return indexes.map((index) =>
            this.translate(`referrals_titles[${index}]`)
        );
    }

    async fetchReferrals(page, per_page) {
        return await ProfileApi.get(`/referrals/${this.user.id}`);
    }

    async index(page = 1, per_page = 15) {
        this.emptyTable = false;
        this.waitTable = true;

        let response = {};

        try {
            response = await this.fetchReferrals(page, per_page);

            // this.meta = response.data.data;

            this.rows = response.data.data.map((el) => {
                console.log(el)
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

    getGradeList() {
        this.gradeList = [];

        this.gradeList = [
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
