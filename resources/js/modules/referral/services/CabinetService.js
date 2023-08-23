import store from "@/store";
import { SelectData } from "@/modules/referral/DTO/SelectData";
import { GradeData } from "@/modules/referral/DTO/GradeData";
import api from "@/api/api";

export class CabinetService {
    constructor(id) {
        this.statsCards = [];
        this.accounts = [];
        this.gradeList = [];
        this.referrals = {};

        this.code = "";
        this.activeSubId = null;

        this.user_id = id;
    }

    getStatsCards(data) {
        this.statsCards = [
            ...this.statsCards,
            new SelectData(
                "invite",
                "Приглашенные",
                data.attached_referrals_count
            ),
            new SelectData("active", "Активные", data.active_referrals_count),
            new SelectData(
                "profit",
                "Общая прибыль",
                `$${data.referrals_total_amount}`
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
