import api from "@/api/api";

export default {
    actions: {
        async destroy_accounts({ commit, state }) {
            commit("destroy_acc");
        },
        async set_active({ commit, state }, index) {
            commit("updateActive", index);

            let sub = (await api.get(`/api/sub/${index}`)).data.data;
            // let sub = Object.values(state.accounts).filter(
            //     (el) => el.group_id === index
            // )

            commit("updateActiveAccount", sub);
        },
        async accounts_all({ commit, state }, user_id) {
            let subsList = (await api.get(`/api/subs/${user_id}`)).data.data;

            // if (state.active === -1) {
            commit("updateAccounts", subsList);
            this.dispatch("set_active", Object.values(subsList)[0].group_id);
            // }
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
