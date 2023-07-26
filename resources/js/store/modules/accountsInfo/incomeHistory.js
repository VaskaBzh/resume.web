import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_income_history({ commit, state }) {
            commit("destroy_incHist");
        },
        async get_income_history({ commit, state }, data) {
            let incomes = await btccom.fetch_income(data);
            commit("updateIncomeHistory", {
                historyItem: Object.values(incomes),
                key: data.group_id,
            });
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
