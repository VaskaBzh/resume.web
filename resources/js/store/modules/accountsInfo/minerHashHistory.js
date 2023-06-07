import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_miner_history_hash({ commit, state }) {
            commit("destroy_histMiners");
        },
        get_miner_history_hash: async function ({ commit, state }, data) {
            // await btccom
            //     .fetch_miner_history(data)
            //     .then((res) => {
            //         if (res.data) {
            //             commit("updateHistoryMiners", {
            //                 historyItem: Object.values(res.data),
            //                 key: data.worker_id,
            //             });
            //         }
            //     })
            //     .catch((err) => console.log(err));
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
