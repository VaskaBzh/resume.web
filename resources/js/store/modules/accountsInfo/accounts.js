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
                        await MainApi.get(`/subs/sub/${data.index}`, {
                            headers: {
                                ...(data?.access_key
                                    ? {
                                          "X-Access-Key": data.access_key,
                                      }
                                    : {
                                          Authorization: `Bearer ${store.getters.token}`,
                                      }),
                            },
                        })
                    ).data.data
                );

                commit("updateActive", data.index);

                commit("updateActiveAccount", sub);
            }
        },
        async accounts_all({ commit, state }, user_id) {
            let subsList = (
                await MainApi.get(`/subs/${user_id}`, {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                })
            ).data.data.map((el) => {
                return new accountData(el);
            });

            commit("updateAccounts", subsList);
            if (state.active === -1) {
                this.dispatch("set_active", {
                    index: Object.values(subsList)[firstSubIndex].group_id,
                });
            }
        },
        async set_accounts({ commit, state }, data) {
            if (data.route?.query?.access_key) {
                this.dispatch("set_active", {
                    access_key: data.route.query.access_key,
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
            state.accounts = [ ...accounts ];
        },
        updateActiveAccount(state, account) {
            state.activeAccount = { ...account };
        },
    },
    state: {
        valid: true,
        active: -1,
        accounts: [],
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
