import Vue from "lodash";

export default {
    actions: {
        destroy_income({ commit, state }) {
            commit("destroy_inc");
        },
        get_all_income({ commit, state }, group) {
            let income = {
                payments: 0,
                accruals: 0,
                unPayments: 0,
            };
            if (group.payments) {
                income.payments = group.payments;
            }
            if (group.accruals) {
                income.accruals = group.accruals;
            }
            if (group.unPayments) {
                income.unPayments = group.unPayments;
            }
            commit("updateIncome", { item: income, key: group.group_id });
        },
    },
    state: {
        income: {},
    },
    mutations: {
        destroy_inc(state) {
            state.income = {};
        },
        updateIncome(state, data) {
            Vue.set(state.income, data.key, data.item);
        },
    },
    getters: {
        getIncome(state) {
            return state.income;
        },
    },
};