import axios from "axios";
import Vue from "lodash";
import { Inertia } from "@inertiajs/inertia";

export default {
    actions: {
        destroyer({ commit }) {
            commit("destroy");
        },
        getMessage({ commit, state }, message) {
            commit("setMessage", message)
        },
        getAllIncome({ commit, state }, group) {
            let income = {
                payments: 0,
                accruals: 0,
                unPayments: 0,
            };
            if (group.payments) {
                income.payments = group.payments;
            }
            if (group.accruals) {
                income.accruals = group.accruals;
            }
            if (group.unPayments) {
                income.unPayments = group.unPayments;
            }
            commit("updateIncome", { item: income, key: group.group_id });
        },
        async getAccounts({ commit, state }) {
            // commit("destroy");
            state.groupName = "";
            await axios
                .get("/accountsAll", {
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        "X-Requested-With": "XMLHttpRequest",
                    },
                })
                .then(async (response) => {
                    let arr;
                    let groups = [];
                    state.checkFive = state.checkFive + 1;
                    // eslint-disable-next-line no-undef
                    await axios
                        .get(route("sub_process"), {
                            headers: {
                                "Content-Type":
                                    "application/json; charset=utf-8",
                                "X-CSRF-TOKEN": document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                                "X-Requested-With": "XMLHttpRequest",
                            },
                        })
                        .then(async (resp) => {
                            if (resp.data !== "") {
                                arr = resp.data;
                                for (const el of response.data.data.list) {
                                    const i =
                                        response.data.data.list.indexOf(el);
                                    if (i === 1) {
                                        await this.dispatch("workerChecker", {
                                            arr: arr,
                                            el: el,
                                        });
                                    } else if (i > 1) {
                                        await this.dispatch("getAccGroup", {
                                            arr: arr,
                                            el: el,
                                            i: i,
                                            response: response,
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
                                    this.dispatch("getHistoryHash", group);
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
        async workerChecker({ commit, state }, data) {
            await axios
                .get("/worker", {
                    params: { id: data.el.gid },
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        "X-Requested-With": "XMLHttpRequest",
                    },
                })
                .then(async (workers) => {
                    const workerChecker = (str, substr) => {
                        const regExp = new RegExp(substr);

                        return (
                            regExp.test(str) &&
                            str.split(".")[0].length === substr.length
                        );
                    };
                    // let wordsLength = 0;
                    Object.values(data.arr).forEach((group) => {
                        workers.data.data.data.forEach((worker) => {
                            if (workerChecker(worker.worker_name, group.sub)) {
                                // разобраться с возможным багом
                                // if (wordsLength < group.sub.length) {
                                // wordsLength = group.sub.length;
                                commit("updateGroupName", group.sub);
                                commit("updateUpdateId", {
                                    item: worker.worker_id,
                                });
                                // }
                            }
                        });
                    });
                })
                .catch((err) => {
                    this.dispatch("getAccounts");

                    if (
                        err.response &&
                        err.response.data.message === "CSRF token mismatch."
                    ) {
                        Inertia.reload();
                        // commit(
                        //     "setMessage",
                        //     "Кажется возникла проблема, перезагрузите страницу."
                        // );
                        //
                        // setTimeout(() => {
                        //     commit("setMessage", "");
                        // }, 3000);
                    }
                });
        },
        async getAccGroup({ commit, state }, data) {
            await Object.values(data.arr).forEach((group, i) => {
                if (data.el.name === group.sub) {
                    state.validate = true;
                    let accountModel = {
                        img: "profile.png",
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
                        this.dispatch("updateGroup", data.el);
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
        async updateGroup({ state, commit }, data) {
            let instance = axios.create({
                baseURL: "https://pool.api.btc.com/v1",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    Authorization: "sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N",
                    "Access-Control-Allow-Methods":
                        "GET, PUT, POST, DELETE, HEAD, OPTIONS",
                    "Access-Control-Allow-Credentials": "true",
                    Accept: "application/json",
                },
            });

            commit("setMessage", "Мы подключаем воркеров к вашему аккаунту");

            setTimeout(() => {
                commit("setMessage", "");
            }, 3000);

            const delay = (ms) =>
                new Promise((resolve) => setTimeout(resolve, ms));

            for (const workerId of Object.values(state.updateId)) {
                let updateData = {
                    puid: "781195",
                    group_id: String(data.gid),
                    worker_id: String(workerId),
                };

                await instance.post(
                    `/worker/update?group=${data.gid}&puid=781195`,
                    updateData
                );

                await axios.post("/worker_create", updateData);
                await delay(1000); // Задержка в 1 секунду между каждым запросом
            }

            this.dispatch("getAccounts");
        },
        async getHash({ state, commit }, data) {
            await axios
                .get("/worker", {
                    params: { id: data.accountModel.id },
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        "X-Requested-With": "XMLHttpRequest",
                    },
                })
                .then(async (result) => {
                    if (result.data.data.data.length > 0) {
                        for (const worker of result.data.data.data) {
                            const checker = (str, substr) => {
                                const regExp = new RegExp(substr);
                                return regExp.test(str);
                            };
                            let name;
                            name = worker.worker_name;
                            if (
                                checker(
                                    worker.worker_name,
                                    data.accountModel.name
                                )
                            ) {
                                name = name.replace(
                                    `${data.accountModel.name}.`,
                                    ""
                                );
                            }
                            let hash = worker.shares_1m;
                            let hash24 = worker.shares_1d;
                            if (worker.shares_unit === "G") {
                                hash = Number(hash / 1000).toFixed(2);
                            }
                            if (worker.shares_1d_unit === "G") {
                                hash24 = Number(hash24 / 1000).toFixed(2);
                            }
                            let hashModel = {
                                shares1m: hash,
                                shares1h: (worker.shares_15m * 4) / 60,
                                shares1d: hash24,
                                persent: worker.reject_percent,
                                status: worker.status,
                                name: name,
                                workerId: worker.worker_id,
                                createdAt: data.el.created_at,
                            };
                            this.dispatch("getMinerHistoryHash", {
                                worker_id: worker.worker_id,
                            });
                            await commit("updateHash", {
                                hash: hashModel,
                                key: worker.worker_id,
                                i: data.accountModel.id,
                            });
                            data.accountModel.shares1h +=
                                data.accountModel.shares1h +=
                                    (Number(hash) * 4) / 60;
                            data.accountModel.shares1d += Number(hash24);
                        }
                    } else {
                        data.accountModel.shares1h = 0;
                        data.accountModel.shares1d = 0;
                    }
                    commit("updateAccounts", {
                        account: data.accountModel,
                        groupIndex: data.accountModel.id,
                    });
                })
                .catch(() => {
                    // commit(
                    //     "setMessage",
                    //     "Кажется возникла проблема, перезагрузите страницу."
                    // );
                    //
                    // setTimeout(() => {
                    //     commit("setMessage", "");
                    // }, 3000);
                });
        },
        async reloader({ commit, state }, data) {
            setInterval(async () => {
                this.dispatch("getAccounts");
            }, 1500);
        },
        getMinerHistoryHash({ commit, state }, data) {
            axios
                .get("/worker_process", {
                    params: data,
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                .then((res) => {
                    if (res.data) {
                        commit("updateHistoryMiners", {
                            historyItem: Object.values(res.data),
                            key: data.worker_id,
                        });
                    }
                })
                .catch((err) => console.log(err));
        },
        getHistoryHash({ commit }, data) {
            axios
                .get("/hash_process", {
                    params: data,
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                .then((res) => {
                    // if (res.data.length > 0) {
                    commit("updateHistory", {
                        historyItem: Object.values(res.data),
                        key: data.group_id,
                    });
                    // }
                })
                .catch((err) => console.log(err));
        },
        getIncomeHistory({ commit, state }, data) {
            axios
                .get("/income_process", {
                    params: data,
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                .then((res) => {
                    commit("updateIncomeHistory", {
                        historyItem: Object.values(res.data),
                        key: data.group_id,
                    });
                })
                .catch((err) => console.log(err));
        },
        getWallets({ commit, state }, data) {
            axios
                .get("/wallet_process", {
                    params: data,
                    headers: {
                        "Content-Type": "application/json; charset=utf-8",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                })
                .then((res) => {
                    commit("updateWallet", {
                        historyItem: Object.values(res.data),
                        key: data.group_id,
                    });
                })
                .catch((err) => console.log(err));
            // axios.post("/wallet_update", data);
        },
    },
    mutations: {
        destroy(state) {
            state.incomeHistory = {};
            state.income = {};
            state.valid = true;
            state.accounts = {};
            state.hash = {};
            state.history = {};
            state.historyMiners = {};
            state.earn = {};
            state.updateId = {};
            state.validate = false;
            state.groupName = "";
            state.message = "";
        },
        setValid(state) {
            state.valid = false;
        },
        updateActive(state, index) {
            state.active = index;
        },
        updateUpdateId(state, data) {
            Vue.set(state.updateId, data.item, data.item);
        },
        updateGroupName(state, name) {
            state.groupName = name;
        },
        updateHistoryMiners(state, data) {
            Vue.set(state.historyMiners, data.key, data.historyItem);
        },
        updateHistory(state, data) {
            Vue.set(state.history, data.key, data.historyItem);
        },
        updateWallet(state, data) {
            Vue.set(state.wallet, data.key, data.historyItem);
        },
        updateIncomeHistory(state, data) {
            Vue.set(state.incomeHistory, data.key, data.historyItem);
        },
        updateIncome(state, data) {
            Vue.set(state.income, data.key, data.item);
        },
        updateAccounts(state, data) {
            Vue.set(state.accounts, data.account.id, data.account);
            if (state.active === -1) {
                state.active = data.account.id;
            }
        },
        setHash(state, data) {
            Vue.set(state.hash, data.key, data.hash);
        },
        updateHash(state, data) {
            Vue.set(state.hash[data.i], data.key, data.hash);
        },
        setMessage(state, data) {
            state.message = data;
        },
    },
    state: {
        checkFive: 0,
        valid: true,
        active: -1,
        accounts: {},
        hash: {},
        history: {},
        historyMiners: {},
        incomeHistory: {},
        income: {},
        wallet: {},
        updateId: {},
        fullEarn: {},
        validate: false,
        groupName: "",
        i: -1,
        message: "",
    },
    getters: {
        allHistoryMiner(state) {
            return state.historyMiners;
        },
        allHistory(state) {
            return state.history;
        },
        allIncomeHistory(state) {
            return state.incomeHistory;
        },
        allHash(state) {
            return state.hash;
        },
        allAccounts(state) {
            return state.accounts;
        },
        getActive(state) {
            return state.active;
        },
        getIncome(state) {
            return state.income;
        },
        getWallet(state) {
            return state.wallet;
        },
        getValid(state) {
            return state.valid;
        },
        getMessage(state) {
            return state.message;
        },
    },
};
