import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async accounts_all({ commit, state }) {
            state.groupName = "";
            let arr;
            let groups = [];
            await btccom
                .fetch({
                    data: {
                        puid: "781195",
                        page: 1,
                        page_size: 52,
                    },
                    path: "worker/groups",
                    method: "get",
                })
                .then(async (resp) => {
                    await btccom
                        .fetch_subs()
                        .then(async (response) => {
                            if (response.data !== "") {
                                arr = response.data;
                                for (const el of resp.data.data.list) {
                                    const i = resp.data.data.list.indexOf(el);
                                    if (i === 1) {
                                        await this.dispatch("workerChecker", {
                                            arr: arr,
                                            el: el,
                                            groupName: state.groupName,
                                        });
                                    } else if (i > 1) {
                                        await this.dispatch("get_acc_group", {
                                            arr: arr,
                                            el: el,
                                            i: i,
                                            response: resp,
                                            groups: groups,
                                        });
                                    }
                                }
                                Object.values(arr).forEach((group, i) => {
                                    group.index = i;
                                    if (state.valid) {
                                        let group_with_length = group;
                                        group_with_length.length = arr.length;
                                        this.dispatch("getWallets", group);
                                        this.dispatch(
                                            "getIncomeHistory",
                                            group_with_length
                                        );
                                        this.dispatch("getAllIncome", group);
                                    }
                                    console.log(group);
                                    this.dispatch("getHistoryHash", group);
                                    this.dispatch("get_history_hash", group);
                                });
                                commit("setValid");
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                            if (state.checkFive <= 5) {
                                this.dispatch("getAccounts");
                            } else {
                                state.checkFive = 0;
                            }
                        });
                })
                .catch((err) => {
                    console.log(err);
                    if (state.checkFive <= 5) {
                        this.dispatch("getAccounts");
                    } else {
                        state.checkFive = 0;
                    }
                });
        },
        async get_acc_group({ commit, state }, data) {
            await Object.values(data.arr).forEach((group, i) => {
                if (data.el.name === group.sub) {
                    data.validate = true;
                    let accountModel = {
                        img: "profile.webp",
                        name: data.el.name,
                        hashRate: "",
                        workersActive: data.el.workers_active,
                        workersAll: data.el.workers_total,
                        workersInActive: data.el.workers_inactive,
                        workersDead: data.el.workers_dead,
                        todayProfit: "",
                        myPayment: "",
                        rejectRate: data.el.reject_percent,
                        shares1m: data.el.shares_1m,
                        shares1h: 0,
                        shares1d: 0,
                        id: group.group_id,
                        unit: data.el.shares_unit,
                    };
                    if (data.el.name == state.groupName) {
                        let obj = data.el;
                        obj.updateId = state.updateId;
                        this.dispatch("update_group", obj);
                        state.updateId = {};
                    }
                    commit("setHash", {
                        hash: {},
                        key: accountModel.id,
                    });
                    this.dispatch("getHash", {
                        groupId: data.el.gid,
                        accountModel: accountModel,
                        el: data.el,
                        response: data.response,
                    });
                }
            });
        },
    },
    mutations: {
        destroy_acc(state) {
            state.accounts = {};
            state.updateId = {};
            state.groupName = "";
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
        updateGroupName(state, data) {
            state.groupName = data.name;
        },
        updateUpdateId(state, data) {
            Vue.set(state.updateId, data.item, data.item);
        },
    },
    state: {
        checkFive: 0,
        valid: true,
        active: -1,
        accounts: {},
        groupName: "",
        updateId: {},
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
