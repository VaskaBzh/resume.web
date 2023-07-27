import Vue from "lodash";
import api from "@/api/api";

export default {
    actions: {
        destroy_income_history({ commit, state }) {
            commit("destroy_incHist");
        },
        async get_income_history({ commit, state }, data) {
            let incomes = (await api.get("/income_process", {
                params: data,
            })).data;
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
