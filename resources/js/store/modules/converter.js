import Vue from "lodash";
import difficulty from "@/api/difficulty";
import axios from "axios";

export default {
    actions: {
        async getGraph({ commit }) {
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
        },
        async getMiningStat({ commit, state }) {
            axios.get("miner_stat").then(async (response) => {
                let minerstats = response.data.minerstats;

                let converterModel = {
                    diff: minerstats.network_difficulty,
                    diff_change: minerstats.change_difficulty,
                    nextDiff: minerstats.next_difficulty,
                    time: minerstats.time_remain,
                    network: Number(minerstats.network_hashrate),
                    networkUnit: minerstats.network_unit,
                    reward: minerstats.reward_block,
                    price: minerstats.price_USD,
                };

                converterModel.time = (
                    (minerstats.time_remain - (Date.now() / 1000).toFixed(0)) /
                    60 /
                    60
                ).toFixed(0);

                commit(`updateInfo`, {
                    key: "btc".toLowerCase(),
                    item: converterModel,
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
                if (i < 60) {
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
