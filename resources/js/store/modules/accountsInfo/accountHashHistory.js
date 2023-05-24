import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        async get_history_hash({ commit }, data) {
            await btccom
                .fetch_accounts_hash(data)
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
