import Vue from "lodash";
import difficulty from "@/api/difficulty";
import btccom from "@/api/btccom";

export default {
    actions: {
        async getDiff({ commit, state }, data) {
            btccom
                .fetch({
                    data: {
                        lang: "ru",
                        puid: 781195,
                    },
                    path: "coins-income",
                    method: "get",
                    link_type: "",
                })
                .then((res) => {
                    Object.values(res.data.data).forEach((el, i) => {
                        if (Object.keys(res.data.data)[i] === "btc") {
                            data.item.diff = el.diff;
                        }
                    });
                    commit(`updateInfo`, {
                        key: "btc".toLowerCase(),
                        item: data.item,
                    });
                });
        },
        async getConverter({ commit, state }) {
            difficulty
                .fetch({
                    data: {
                        format: "json",
                        timespan: "all",
                    },
                    path: "https://api.blockchain.info/charts/difficulty",
                    method: "get",
                    link_type: "",
                })
                .then((res) => {
                    commit(`updateHistoryDiff`, res.data.values);
                })
                .catch((err) => console.log(err));
            btccom
                .fetch({
                    data: {},
                    path: "pool/status",
                    method: "get",
                    link_type: "",
                })
                .then(async (response) => {
                    let converterModel = {
                        diff: 0,
                        diff_change: response.data.data.difficulty_change,
                        nextDiff: response.data.data.estimated_next_difficulty,
                        time: 0,
                        network: Number(response.data.data.network_hashrate),
                        networkUnit: response.data.data.network_hashrate_unit,
                        price: Number(response.data.data.exchange_rate.BTC2USD),
                    };
                    if (response.data.data.time_remain !== "-") {
                        converterModel.time = (
                            (response.data.data.time_remain -
                                (Date.now() / 1000).toFixed(0)) /
                            60 /
                            60
                        ).toFixed(0);
                    } else {
                        converterModel.time = response.data.data.time_remain;
                    }
                    await this.dispatch("getReward", {
                        item: converterModel,
                    });
                    this.dispatch("getDiff", {
                        item: converterModel,
                    });
                });
        },
        async getReward({ commit, state }, data) {
            difficulty
                .fetch({
                    data: {
                        list: "BTC,BCH",
                    },
                    path: "https://api.minerstat.com/v2/coins",
                    method: "get",
                    link_type: "",
                })
                .then((response) => {
                    response.data.forEach((el, i) => {
                        if (el.coin === "BTC") {
                            data.item.reward = el.reward_block;
                        }
                    });
                });
        },
    },
    mutations: {
        updateInfo(state, data) {
            Vue.set(state.convertInfo, data.key, data.item);
        },
        updateHistoryDiff(state, data) {
            let hist = data.reverse();
            hist = hist.map((el, i) => {
                if (i < 120) {
                    return el;
                }
            });
            hist = hist.filter((el) => el !== undefined);
            state.historyDiff = hist.reverse();
        },
    },
    state: {
        convertInfo: {},
        historyDiff: [],
    },
    getters: {
        btcInfo(state) {
            return state.convertInfo;
        },
        btcHistory(state) {
            return state.historyDiff;
        },
    },
};
