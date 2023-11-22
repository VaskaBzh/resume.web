import store from "@/store";
import { SelectData } from "@/modules/referral/DTO/SelectData";
import { GradeData } from "@/modules/referral/DTO/GradeData";
import { ProfileApi } from "@/api/api";

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

    getHashRate(hashrate) {
        if (!hashrate) {
            return 0;
        }

        return hashrate?.length <= 5 ? hashrate : Number(hashrate).toFixed(0);
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
                Number(data?.referrals_total_amount) || 0
            ),
            new SelectData(
                "active",
                this.translate("stats.cards[1]"),
                data?.active_referrals_count || 0
            ),
            new SelectData(
                "hashrate",
                this.translate("stats.cards[1]"),
                this.getHashRate(data?.total_referrals_hash_rate)
            ),
            new SelectData(
                "percent",
                this.translate("stats.cards[1]"),
                data?.referral_percent || 0
            ),
            new SelectData(
                "hash_unit",
                this.translate("stats.cards[1]"),
                data?.hash_rate_unit || "T"
            ),
        ];
    }

    getSelectAccounts(newAccountsList) {
        this.accounts = newAccountsList;
    }

    sendMessage(message) {
        store.dispatch("getMessage", message);
    }

    async fetchActivateSub(group_id) {
        return await ProfileApi.put(`/subs/sub/activate/${group_id}`);
    }

    async changeActiveSub(group_id) {
        try {
            const response = await this.fetchActivateSub(group_id);

            store.dispatch("setNotification", {
                status: "success",
                title: "success",
                text: response.data.message,
            });
        } catch (err) {
            console.error(`Error with: ${err}`);
        }
    }

    setCode(code = null) {
        this.code = code || "...";
    }

    setActiveSub(group_id) {
        this.activeSubId = group_id;
    }

    transformCode(code) {
        const url = new URL(code);
        return `${window.location.host}/registration${url.search}`;
    }

    async fetchReferralStatistic() {
        return await ProfileApi.get(`/referrals/statistic/${this.user.id}`);
    }

    async index() {
        try {
            const response = (await this.fetchReferralStatistic()).data.data;

            let code = this.transformCode(response.referral_url);
            this.setCode(code || "...");

            this.setActiveSub(response.group_id);

            this.getStatsCards(response);
        } catch (err) {
            console.error(`FetchError: ${err}`);

            const canceledMessage = "ERR_CANCELED";

            if (err.code !== canceledMessage) {
                store.dispatch("setNotification", {
                    status: "error",
                    title: "error",
                    text: err.response.data.errors.message[0],
                });
            }
        }
    }

    getGradeList() {
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
}
