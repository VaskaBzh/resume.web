import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        async get_history_hash({ commit }, data) {
            let subs_hash_history = await btccom.fetch_accounts_hash(data);
            commit("updateHistory", {
                historyItem: Object.values(subs_hash_history),
                key: data.group_id,
            });
        },
    },
    mutations: {
        updateHistory(state, data) {
            Vue.set(state.history, data.key, data.historyItem);
        },
    },
    state: {
        history: {},
    },
    getters: {
        allHistory(state) {
            return state.history;
        },
    },
};
