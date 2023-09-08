import store from "@/store";
import { SelectData } from "@/modules/referral/DTO/SelectData";
import { GradeData } from "@/modules/referral/DTO/GradeData";
import api from "@/api/api";

export class CabinetService {
    constructor(translate, route) {
        this.statsCards = [];
        this.accounts = [];
        this.gradeList = [];
        this.referrals = {};
        this.translate = translate;

        this.code = "";
        this.activeSubId = null;

        this.route = route;

        this.user = null;
    }

    setUser(user) {
        this.user = user;
    }

    getStatsCards(data) {
        this.statsCards.length = 0;

        this.statsCards = [
            ...this.statsCards,
            new SelectData(
                "invite",
                this.translate("stats.cards[0]"),
                data?.attached_referrals_count || 0
            ),
            new SelectData(
                "profit",
                this.translate("stats.cards[2]"),
                Number(data?.referrals_total_amount) || "0.00000000"
            ),
            new SelectData(
                "active",
                this.translate("stats.cards[1]"),
                data?.active_referrals_count || 0
            ),
        ];
    }

    getSelectAccounts() {
        this.accounts = store.getters.allAccounts;
    }

    sendMessage(message) {
        store.dispatch("getMessage", message);
    }

    async generateCode(id) {
        let result = {};

        try {
            result = await api.post(
                `/referrals/generate/${this.user.id}`,
                {
                    group_id: id,
                },
                {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                }
            );

            this.sendMessage(result.data.message);
        } catch (err) {
            this.sendMessage(err.response.data.message);
        }

        await this.index();
    }

    setCode(code) {
        this.code = code;
    }

    setActiveSub(group_id) {
        this.activeSubId = group_id;
    }

    transformCode(code) {
        const firstIndex = 1;

        const params = code.split("?")[firstIndex];
        const referralCodeParam = params.split("referral_code")[1];
        const referralCode = referralCodeParam.substr(
            firstIndex,
            referralCodeParam.length - firstIndex
        );

        return `${window.location.host}/#/registration?referral_code=${referralCode}`;
    }

    async index() {
        let response = {};

        try {
            response = (
                await api.get(`/referrals/statistic/${this.user.id}`, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                })
            ).data;
        } catch (err) {
            console.error(`FetchError: ${err}`);
        }

        const result = response?.data || response;

        let code = this.transformCode(result.code);
        this.setCode(code || "...");

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
