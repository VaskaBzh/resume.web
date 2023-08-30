import api from "@/api/api";

import { accountData } from "@/DTO/accountData";

const firstSubIndex = 0;
export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async set_active({ commit, state }, index) {
            let sub = new accountData(
                (await api.get(`/subs/sub/${index}`)).data.data
            );

            commit("updateActive", index);

            // let sub = Object.values(state.accounts).filter(
            //     (el) => el.group_id === index
            // )

            commit("updateActiveAccount", sub);
        },
        async accounts_all({ commit, state }, user_id) {
            let subsList = (await api.get(`/subs/${user_id}`)).data.data.map(
                (el) => {
                    return new accountData(el);
                }
            );

            commit("updateAccounts", subsList);
            if (state.active === -1) {
                this.dispatch(
                    "set_active",
                    Object.values(subsList)[firstSubIndex].group_id
                );
            }
        },
    },
    mutations: {
        destroy_acc(state) {
            state.accounts = {};
            state.activeAccount = {};
        },
        updateActive(state, index) {
            state.active = index;
        },
        setValid(state) {
            state.valid = false;
        },
        updateAccounts(state, accounts) {
            state.accounts = { ...accounts };
        },
        updateActiveAccount(state, account) {
            state.activeAccount = { ...account };
        },
    },
    state: {
        valid: true,
        active: -1,
        accounts: {},
        activeAccount: {},
    },
    getters: {
        allAccounts(state) {
            return state.accounts;
        },
        getAccount(state) {
            return state.activeAccount;
        },
        getValid(state) {
            return state.valid;
        },
        getActive(state) {
            return state.active;
        },
    },
};
