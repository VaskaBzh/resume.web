import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
        destroy_wallets({ commit, state }) {
            commit("destroy_wal");
        },
        async get_wallets({ commit, state }, data) {
            await btccom
                .fetch_wallets(data)
                .then((res) => {
                    commit("updateWallet", {
                        historyItem: Object.values(res.data),
                        key: data.group_id,
                    });
                })
                .catch((err) => console.log(err));
            // axios.post("/wallet_update", data);
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
