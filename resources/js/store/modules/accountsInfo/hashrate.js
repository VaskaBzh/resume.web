import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_hashrate({ state, commit }) {
            commit("destroy_hash");
        },
        async get_hash({ state, commit }, data) {
            let query = {};
            query.group = data.el.gid;
            query.puid = "781195";
            query.page_size = "1000";
            await btccom
                .fetch({
                    data: query,
                    path: "worker",
                    method: "get",
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
                                unit: worker.shares_unit,
                                unit1d: worker.shares_1d_unit,
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
    },
    state: {
        hash: {},
    },
    mutations: {
        destroy_hash(state) {
            state.hash = {};
        },
        setHash(state, data) {
            Vue.set(state.hash, data.key, data.hash);
        },
        updateHash(state, data) {
            Vue.set(state.hash[data.i], data.key, data.hash);
        },
    },
    getters: {
        allHash(state) {
            return state.hash;
        },
    },
};
