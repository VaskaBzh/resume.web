import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_income_history({ commit, state }) {
            commit("destroy_incHist");
        },
        async get_income_history({ commit, state }, data) {
            await btccom
                .fetch_income(data)
                .then((res) => {
                    commit("updateIncomeHistory", {
                        historyItem: Object.values(res.data),
                        key: data.group_id,
                    });
                })
                .catch((err) => console.log(err));
        },
    },
    mutations: {
        updateIncomeHistory(state, data) {
            Vue.set(state.incomeHistory, data.key, data.historyItem);
        },
        destroy_incHist(state) {
            state.incomeHistory = {};
        },
    },
    state: {
        incomeHistory: {},
    },
    getters: {
        allIncomeHistory(state) {
            return state.incomeHistory;
        },
    },
};
