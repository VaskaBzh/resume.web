import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_miner_history_hash({ commit, state }) {
            commit("destroy_histMiners");
        },
        get_miner_history_hash: async function ({ commit, state }, data) {
            let miner_hash = await btccom.fetch_miner_history(data);
            commit("updateHistoryMiners", {
                historyItem: Object.values(miner_hash),
                key: data.worker_id,
            });
        },
    },
    state: {
        historyMiners: {},
    },
    mutations: {
        destroy_histMiners(state) {
            state.historyMiners = {};
        },
        updateHistoryMiners(state, data) {
            Vue.set(state.historyMiners, data.key, data.historyItem);
        },
    },
    getters: {
        allHistoryMiner(state) {
            return state.historyMiners;
        },
    },
};
