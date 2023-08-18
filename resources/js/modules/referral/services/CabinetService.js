import store from "@/store";
import { SelectData } from "@/modules/referral/DTO/SelectData";
import { GradeData } from "@/modules/referral/DTO/GradeData";

export class CabinetService {
    constructor() {
        this.statsCards = [];
        this.accounts = [];
        this.gradeList = [];
    }

    getStatsCards() {
        this.statsCards = [
            ...this.statsCards,
            new SelectData("invite", "Приглашенные", "1000"),
            new SelectData("active", "Активные", "521"),
            new SelectData("profit", "Общая прибыль", "$5 302"),
        ];
    }

    getSelectAccounts() {
        this.accounts = store.getters.allAccounts;
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
