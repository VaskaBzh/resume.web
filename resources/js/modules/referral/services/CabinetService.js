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
                data?.total_referrals_hash_rate || 0
            ),
            new SelectData(
                "hashrate",
                this.translate("stats.cards[1]"),
                data?.referral_percent || 0
            ),
        ];
    }

    getSelectAccounts(newAccountsList) {
        this.accounts = newAccountsList;
    }

    sendMessage(message) {
        store.dispatch("getMessage", message);
    }

    // async generateCode(id) {
    //     let result = {};
    //
    //     try {
    //         result = await ProfileApi.post(
    //             `/referrals/generate/${this.user.id}`,
    //             {
    //                 group_id: id,
    //             }
    //         );
    //         store.dispatch("setNotification", {
    //             status: "success",
    //             title: "success",
    //             text: result.data.message,
    //         });
    //     } catch (err) {
    //         // store.dispatch("setNotification", {
    //         //     status: "error",
    //         //     title: "error",
    //         //     text: err.response.data.message,
    //         // });
    //     }
    //
    //     await this.index();
    // }

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

    async setReferrerSub(group_id) {
        try {
            const response = await this.fetchActiveSub(group_id);

            store.dispatch("setNotification", {
                status: "success",
                title: "success",
                text: response.data.message,
            });
        } catch (err) {
            console.error(`Error with: ${err}`);
        }
    }

    async fetchActiveSub(group_id) {
        return await ProfileApi.get(`/referrals/set_sub/${group_id}`);
    }

    async index() {
        let response = {};

        try {
            response = (
                await ProfileApi.get(`/referrals/statistic/${this.user.id}`)
            ).data;
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

        const result = response.data;

        let code = this.transformCode(result.referral_url);
        this.setCode(code || "...");

        this.setActiveSub(result.group_id);

        this.getStatsCards(result);
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
