import Vue from "lodash";
import api from "@/api/api";

export default {
    actions: {
        async get_history_hash({ commit }, data) {
            let subs_hash_history = (await api.get("/hash_process", {
                params: { group_id: data.group_id },
            })).data;
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
