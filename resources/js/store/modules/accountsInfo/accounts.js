import { MainApi } from "@/api/api";

import { accountData } from "@/DTO/accountData";
import store from "@/store";

const firstSubIndex = 0;
export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async set_active({ commit, state }, data) {
            if (data.index) {
                let sub = new accountData(
                    (
                        await MainApi.get(`/subs/sub/${data.index}`)
                    ).data.data
                );

                commit("updateActive", data.index);
                commit("updateActiveAccount", sub);
            }
        },
        set_active_in_list({ commit, state }, data) {
            if (data.index) {
                commit("updateActive", data.index);
                commit("updateActiveAccountInList", data.index);
            }
        },
        async accounts_all({ commit, state }, user_id) {
            const response = (
                await MainApi.get(`/subs/${user_id}`, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                })
            ).data;

            const subsList = response.list.map((el) => {
                return new accountData(el);
            });

            const overall = response.overall;

            commit("updateAccounts", subsList);
            commit("updateOverall", overall);
            if (state.active === -1) {
                this.dispatch("set_active_in_list", {
                    index: Object.values(subsList)[firstSubIndex].group_id,
                });
            }
        },
        async set_accounts({ commit, state }, data) {
            if (data.route?.query?.access_key) {
                this.dispatch("set_active", {
                    access_key: null,
                    index: data.route.query.puid,
                });
            } else {
                if (state.valid) {
                    await this.dispatch("accounts_all", data.user_id);
                    this.dispatch("getMiningStat");
                    this.dispatch("getGraph");
                    commit("setValid", false);
                }
                this.dispatch("drop_interval");
                this.dispatch("set_interval", data.user_id);
            }
        },
        set_interval({ state }, user_id) {
            state.interval = setInterval(async () => {
                await this.dispatch("accounts_all", user_id);
            }, 60000);
        },
        drop_interval({ state }) {
            clearInterval(state.interval);
        },
        drop_all({ commit }) {
            this.dispatch("drop_interval");

            commit("destroy_acc");
        },
    },
    mutations: {
        destroy_acc(state) {
            state.accounts = {};
            state.activeAccount = {};
            state.active = -1;
            state.valid = true;
        },
        updateActive(state, index) {
            state.active = index;
        },
        setValid(state, validState) {
            state.valid = validState;
        },
        updateAccounts(state, accounts) {
            state.accounts = accounts;
        },
        updateOverall(state, overall) {
            state.overall = overall;
        },
        updateActiveAccount(state, account) {
            state.activeAccount = { ...account };
        },
        updateActiveAccountInList(state, index) {
            state.activeAccount = state.accounts.filter(sub => sub.group_id === index)[0];
        },
    },
    state: {
        valid: true,
        active: -1,
        accounts: [],
        overall: [],
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
        overall(state) {
            return state.overall;
        },
        getValid(state) {
            return state.valid;
        },
        getActive(state) {
            return state.active;
        },
    },
};
