import Vue from "lodash";
import api from "@/api/api";

export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async accounts_all({ commit, state }, user_id) {
            let subsList = (await api.get(`/api/subs/${user_id}`)).data.data;

            for (const sub of Object.values(subsList)) {
                try {
                    commit("updateAccounts", sub);
                    if (state.active === -1) {
                        commit("updateActive", sub.group_id);
                    }
                } catch (err) {
                    console.error("Catch btc.com error: \n" + err);
                }
            }
        },
    },
    mutations: {
        destroy_acc(state) {
            state.accounts = {};
            state.checkFive = 0;
        },
        updateActive(state, index) {
            state.active = index;
        },
        setValid(state) {
            state.valid = false;
        },
        updateAccounts(state, account) {
            Vue.set(state.accounts, account.group_id, account);
        },
    },
    state: {
        checkFive: 0,
        valid: true,
        active: -1,
        accounts: {},
    },
    getters: {
        allAccounts(state) {
            return state.accounts;
        },
        getValid(state) {
            return state.valid;
        },
        getActive(state) {
            return state.active;
        },
    },
};
