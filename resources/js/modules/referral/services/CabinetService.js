import store from "@/store";
import { SelectData } from "@/modules/referral/DTO/SelectData";
import { GradeData } from "@/modules/referral/DTO/GradeData";
import api from "@/api/api";

export class CabinetService {
    constructor(id, translate) {
        this.statsCards = [];
        this.accounts = [];
        this.gradeList = [];
        this.referrals = {};
        this.translate = translate;

        this.code = "";
        this.activeSubId = null;

        this.user_id = id;
    }

    getStatsCards(data) {
        this.statsCards = [
            ...this.statsCards,
            new SelectData(
                "invite",
                this.translate("stats.cards[0]"),
                data.attached_referrals_count || 0
            ),
            new SelectData(
                "active",
                this.translate("stats.cards[1]"),
                data.active_referrals_count || 0
            ),
            new SelectData(
                "profit",
                this.translate("stats.cards[2]"),
                `$${data.referrals_total_amount || 0}`
            ),
        ];
    }
    getSelectAccounts() {
        this.accounts = store.getters.allAccounts;
    }
    async generateCode(id) {
        await api.post(`/referrals/generate/${this.user_id}`, {
            group_id: id,
        });

        await this.index();
    }

    setCode(code) {
        this.code = code;
    }

    setActiveSub(group_id) {
        this.activeSubId = group_id;
    }

    async index() {
        let result = (await api.get(`/referrals/statistic/${this.user_id}`))
            .data.data;

        this.setCode(result.code);
        this.setActiveSub(result.group_id);

        this.getStatsCards(result);
    }

    getGradeList() {
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
}
