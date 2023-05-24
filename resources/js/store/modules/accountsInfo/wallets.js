import Vue from "lodash";
import btccom from "@/api/btccom";

export default {
    actions: {
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
