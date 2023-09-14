import api from "@/api/api";

import { accountData } from "@/DTO/accountData";
import store from "@/store";

const firstSubIndex = 0;
export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async set_active({ commit, state }, index) {
            let sub = new accountData(
                (
                    await api.get(`/subs/sub/${index}`, {
                        headers: {
                            Authorization: `Bearer ${store.getters.token}`,
                        },
                    })
                ).data.data
            );

            commit("updateActive", index);

            // let sub = Object.values(state.accounts).filter(
            //     (el) => el.group_id === index
            // )

            commit("updateActiveAccount", sub);
        },
        async accounts_all({ commit, state }, user_id) {
            let subsList = (
                await api.get(`/subs/${user_id}`, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                })
            ).data.data.map((el) => {
                return new accountData(el);
            });

            commit("updateAccounts", subsList);
            if (state.active === -1) {
                this.dispatch(
                    "set_active",
                    Object.values(subsList)[firstSubIndex].group_id
                );
            }
        },
        async set_accounts({ commit, state }, user_id) {
            if (state.valid) {
                this.dispatch("getMiningStat");
                this.dispatch("getGraph");
            }
            await this.dispatch("accounts_all", user_id);
            this.dispatch("set_interval", user_id);
        },
        set_interval({ state }, user_id) {
            state.interval = setInterval(async () => {
                await this.dispatch("accounts_all", user_id);
            }, 60000);
        },
        drop_all({ commit, state }) {
            clearInterval(state.interval);

            commit("destroy_acc");
        },
    },
    mutations: {
        destroy_acc(state) {
            state.accounts = {};
            state.activeAccount = {};
            state.active = -1;
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
        interval: null,
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
