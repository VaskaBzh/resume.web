import axios from "axios";
import Vue from "lodash";

export default {
    actions: {
        getAllEarn({ commit, state }, group) {
            let sum = 0;
            if (Object.values(state.historyForDays).length > 0) {
                Object.values(state.historyForDays).forEach((data) => {
                    if (Object.values(data)) {
                        Object.values(data).forEach((el) => {
                            sum += Number(el[3]) * 3.5 * 1.75;
                        });
                        let accruals = group;
                        accruals.accruals = Number(sum.toFixed(8));

                        this.dispatch("getWallets", accruals);
                        // checkFive: 0,
                        //     valid: true,
                        //     active: -1,
                        //     accounts: {},
                        // hash: {},
                        // history: {},
                        // historyMiners: {},
                        // historyForDays: {},
                        // updateId: 0,
                        //     fullEarn: {},
                        // validate: false,
                        //     groupName: "",
                        commit("setAllEarn", {
                            key: group.group_id,
                            sum: sum,
                        });
                    }
                });
            }
        },
        async getAccounts({ commit, state }) {
            commit("destroy");
            commit("setValid");
            await axios
                .get("/accountsAll")
                .then(async (response) => {
                    let arr;
                    state.checkFive = state.checkFive + 1;
                    // eslint-disable-next-line no-undef
                    await axios
                        .get(route("sub_process"))
                        .then(async (resp) => {
                            if (resp.data !== "") {
                                arr = resp.data;
                                for (const el of response.data.data.list) {
                                    const i =
                                        response.data.data.list.indexOf(el);
                                    if (i === 1) {
                                        // await this.dispatch("workerChecker", {
                                        //     arr: arr,
                                        //     el: el,
                                        // });
                                    } else if (i > 1) {
                                        await this.dispatch("getAccGroup", {
                                            arr: arr,
                                            el: el,
                                            i: i,
                                            response: response,
                                        });
                                    }
                                }
                                Object.values(arr).forEach((group, i) => {
                                    group.index = i;
                                    let group_with_length = group;
                                    group_with_length.length = arr.length;
                                    this.dispatch("getHistoryHash", group);
                                    this.dispatch(
                                        "getHistoryForDays",
                                        group_with_length
                                    );
                                });
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
                });
        },
        async workerChecker({ commit }, data) {
            await axios
                .put("/worker", { id: data.el.gid })
                .then(async (workers) => {
                    const workerChecker = (str, substr) => {
                        const regExp = new RegExp(substr);
                        return regExp.test(str);
                    };
                    let wordsLength = 0;
                    Object.values(data.arr).forEach((group) => {
                        workers.data.data.data.forEach((worker) => {
                            if (workerChecker(worker.worker_name, group.sub)) {
                                if (wordsLength < group.sub.length) {
                                    wordsLength = group.sub.length;
                                    commit("updateGroupName", group.sub);
                                    commit("updateUpdateId", worker.worker_id);
                                }
                            }
                        });
                    });
                });
        },
        async getAccGroup({ commit, state }, data) {
            await Object.values(data.arr).forEach((group) => {
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
                    }
                    this.dispatch("getHash", {
                        groupId: data.el.gid,
                        accountModel: accountModel,
                        el: data.el,
                        response: data.response,
                    });
                } else if (
                    data.i === data.response.data.data.list.length - 1 &&
                    !state.validate
                ) {
                    // window.location.reload();
                    // this.dispatch("reloader", data.arr);
                }
            });
        },
        async updateGroup({ state, commit }, data) {
            let updateData = {
                puid: "781195",
                group_id: String(data.gid),
                worker_id: String(state.updateId),
            };
            let instance = axios.create({
                baseURL: "https://pool.api.btc.com/v1",
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    Authorization: "sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N",
                    "Access-Control-Allow-Origin": "http://127.0.0.1:8000",
                    "Access-Control-Allow-Methods":
                        "GET, PUT, POST, DELETE, HEAD, OPTIONS",
                    "Access-Control-Allow-Credentials": "true",
                    Accept: "application/json",
                },
            });
            await instance
                .post(
                    `/worker/update?group=${data.gid}&puid=781195`,
                    updateData
                )
                .then(async (res) => {
                    await axios.post("/worker_create", updateData);
                    window.location.reload();
                });
        },
        async getHash({ state, commit }, data) {
            await axios
                .put("/worker", { id: data.accountModel.id })
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
                                key: data.accountModel.id,
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
                });
        },
        async reloader({ commit, state }, data) {
            setInterval(async () => {
                this.dispatch("getAccounts");
            }, 1500);
        },
        getMinerHistoryHash({ commit, state }, data) {
            axios
                .put("/worker_process", data)
                .then((res) => {
                    if (res.data) {
                        commit("updateHistoryMiners", {
                            historyItem: JSON.parse(res.data.tickers),
                            key: res.data.worker_id,
                        });
                    }
                })
                .catch((err) => console.log(err));
        },
        getHistoryHash({ commit }, data) {
            axios
                .put("/hash_process", data)
                .then((res) => {
                    if (res.data.length > 0) {
                        commit("updateHistory", {
                            historyItem: JSON.parse(res.data[0].tickers),
                            key: data.group_id,
                        });
                    }
                })
                .catch((err) => console.log(err));
        },
        getHistoryForDays({ commit }, data) {
            axios
                .put("/accrual_process", data)
                .then((res) => {
                    if (res.data.length > 0) {
                        commit("updateHistoryForDays", {
                            historyItem: JSON.parse(res.data[0].tickers),
                            key: data.group_id,
                        });
                        this.dispatch("getAllEarn", data);
                    }
                })
                .catch((err) => console.log(err));
        },
        getWallets({ commit }, data) {
            axios.post("/wallet_update", data);
        },
    },
    mutations: {
        destroy_force(state, commit) {
            state.historyForDays = {};
            state.valid = true;
            state.active = -1;
            state.accounts = {};
            state.hash = {};
            state.history = {};
            state.historyMiners = {};
            state.earn = {};
            state.updateId = 0;
            state.validate = false;
            state.groupName = "";
        },
        destroy(state) {
            state.valid = true;
            state.active = -1;
            state.accounts = {};
            state.hash = {};
            state.earn = {};
            state.updateId = 0;
            state.validate = false;
            state.groupName = "";
        },
        setValid(state) {
            state.valid = false;
        },
        updateActive(state, index) {
            state.active = index;
        },
        updateUpdateId(state, updateId) {
            state.updateId = updateId;
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
        updateHistoryForDays(state, data) {
            Vue.set(state.historyForDays, data.key, data.historyItem);
        },
        setEarn(state, earn) {
            state.earn = earn;
        },
        updateAccounts(state, data) {
            Vue.set(state.accounts, data.account.id, data.account);
            state.active = data.account.id;
        },
        updateHash(state, data) {
            Vue.set(state.hash, data.key, data.hash);
        },
        setAllEarn(state, data) {
            Vue.set(state.fullEarn, data.key, Number(data.sum).toFixed(8));
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
        historyForDays: {},
        updateId: 0,
        fullEarn: {},
        validate: false,
        groupName: "",
    },
    getters: {
        allHistoryMiner(state) {
            return state.historyMiners;
        },
        allHistory(state) {
            return state.history;
        },
        allHistoryForDays(state) {
            return state.historyForDays;
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
        FullEarn(state) {
            return state.fullEarn;
        },
        getValid(state) {
            return state.valid;
        },
    },
};
