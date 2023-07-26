import Vue from "lodash";
import difficulty from "@/api/difficulty";
import btccom from "@/api/btccom";
import axios from "axios";
import statisticChart from "@/Components/technical/charts/StatisticChart.vue";

export default {
    actions: {
        async getLastFpps({ commit }) {
            let earn_list = await btccom.fetch({
                data: {
                    puid: "781195",
                    page_size: "1",
                },
                path: "account/earn-history",
                method: "get",
            });
            try {
                commit("setFpps", earn_list.list[0].more_than_pps96_rate);
            } catch (err) {
                console.error("Catch btc.com error: \n" + err);
            }
        },
        async getGraph({ commit }) {
            let difficulty_chart = await difficulty.fetch({
                data: {
                    format: "json",
                    timespan: "all",
                },
                path: "https://api.blockchain.info/charts/difficulty",
                method: "get",
            });

            try {
                commit(`updateHistoryDiff`, difficulty_chart.values);
            } catch (err) {
                console.error("Catch blockchain error: \n" + err);
            }
        },
        async getMiningStat({ commit, state }) {
            let minerstats = (await difficulty.fetch_minerstat()).minerstats;

            try {
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
            } catch (err) {
                console.error("Catch miner_stat error: \n" + err);
            }
        },
    },
    mutations: {
        setFpps(state, item) {
            Vue.set(state.convertInfo, "fpps", item);
        },
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
