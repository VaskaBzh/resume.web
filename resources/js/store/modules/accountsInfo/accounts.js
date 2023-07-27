import Vue from "lodash";
import btccom from "@/api/btccom";
import api from "@/api/api";
import { AccountService } from "@/services/accountService";

export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async accounts_all({ commit, state }) {
            let accountService = new AccountService(this);

            let subs = (await api.get(route("sub_process"))).data;
            let subsList = (
                await btccom.fetch({
                    data: {
                        puid: "781195",
                        page_size: "1000",
                    },
                    path: `worker/groups`,
                    method: "get",
                })
            ).list;

            subsList = subsList.filter((btcSub) =>
                accountService.checkName(btcSub, subs)
            );

            for (const sub of subs) {
                let i = subs.indexOf(sub);
                sub.index = i;

                if (state.valid) {
                    accountService
                        .fillTable("getWallets", sub)
                        .fillTable("getAllIncome", sub);
                    sub.length = subs.length;
                    accountService.fillTable("getIncomeHistory", sub);
                }
                accountService.fillTable("getHistoryHash", sub);

                try {
                    this.dispatch("get_acc_sub", {
                        sub_data: subsList[i],
                        sub: sub,
                    });
                } catch (err) {
                    console.error("Catch btc.com error: \n" + err);
                }
            }
            commit("setValid");
        },
        get_acc_sub({ commit, state }, data) {
            let accountModel = {
                img: "profile.webp",
                name: data.sub_data.name,
                hashRate: "",
                workersActive: data.sub_data.workers_active,
                workersAll:
                    data.sub_data.workers_total + data.sub_data.workers_dead,
                workersInActive: data.sub_data.workers_inactive,
                workersDead: data.sub_data.workers_dead,
                todayProfit: "",
                myPayment: "",
                rejectRate: data.sub_data.reject_percent,
                shares1m: data.sub_data.shares_1m,
                shares1h: 0,
                shares1d: 0,
                id: data.sub.group_id,
                unit: data.sub_data.shares_unit,
            };
            commit("setHash", {
                hash: {},
                key: accountModel.id,
            });
            this.dispatch("getHash", {
                groupId: data.sub_data.gid,
                accountModel: accountModel,
                group_data: data.sub_data,
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
