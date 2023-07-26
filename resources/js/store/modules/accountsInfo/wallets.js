import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_wallets({ commit, state }) {
            commit("destroy_wal");
        },
        async get_wallets({ commit, state }, data) {
            let wallets = await btccom.fetch_wallets(data);
            commit("updateWallet", {
                historyItem: Object.values(wallets),
                key: data.group_id,
            });
        },
    },
    mutations: {
        destroy_wal(state) {
            state.wallet = {};
        },
        updateWallet(state, data) {
            Vue.set(state.wallet, data.key, data.historyItem);
        },
    },
    state: {
        wallet: {},
    },
    getters: {
        getWallet(state) {
            return state.wallet;
        },
    },
};
