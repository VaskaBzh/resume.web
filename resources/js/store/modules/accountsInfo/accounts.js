import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async accounts_all({ commit, state }) {
            let subs = await btccom.fetch_subs();

            Object.values(subs).forEach(async (group, i) => {
                let group_data = await btccom.fetch({
                    data: {
                        puid: "781195",
                        group_id: group.group_id,
                    },
                    path: `groups/${group.group_id}`,
                    method: "get",
                });

                try {
                    this.dispatch("get_acc_group", {
                        group_data: group_data,
                        group: group,
                    });
                } catch (err) {
                    console.error("Catch btc.com error: \n" + err);
                }
            });
            Object.values(subs).forEach((group, i) => {
                group.index = i;
                if (state.valid) {
                    let group_with_length = group;
                    group_with_length.length = subs.length;
                    this.dispatch("getWallets", group);
                    this.dispatch("getIncomeHistory", group_with_length);
                    this.dispatch("getAllIncome", group);
                }
                this.dispatch("getHistoryHash", group);
                this.dispatch("get_history_hash", group);
            });
            commit("setValid");
        },
        get_acc_group({ commit, state }, data) {
            let accountModel = {
                img: "profile.webp",
                name: data.group_data.name,
                hashRate: "",
                workersActive: data.group_data.workers_active,
                workersAll:
                    data.group_data.workers_total +
                    data.group_data.workers_dead,
                workersInActive: data.group_data.workers_inactive,
                workersDead: data.group_data.workers_dead,
                todayProfit: "",
                myPayment: "",
                rejectRate: data.group_data.reject_percent,
                shares1m: data.group_data.shares_1m,
                shares1h: 0,
                shares1d: 0,
                id: data.group.group_id,
                unit: data.group_data.shares_unit,
            };
            commit("setHash", {
                hash: {},
                key: accountModel.id,
            });
            this.dispatch("getHash", {
                groupId: data.group_data.gid,
                accountModel: accountModel,
                group_data: data.group_data,
                response: data.response,
            });
        },
    },
    mutations: {
        destroy_acc(state) {
            state.accounts = {};
            state.checkFive = 0;
        },
        updateActive(state, index) {
            state.active = index;
        },
        setValid(state) {
            state.valid = false;
        },
        updateAccounts(state, data) {
            Vue.set(state.accounts, data.account.id, data.account);
            if (state.active === -1) {
                state.active = data.account.id;
            }
        },
    },
    state: {
        checkFive: 0,
        valid: true,
        active: -1,
        accounts: {},
    },
    getters: {
        allAccounts(state) {
            return state.accounts;
        },
        getValid(state) {
            return state.valid;
        },
        getActive(state) {
            return state.active;
        },
    },
};
