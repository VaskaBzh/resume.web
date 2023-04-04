import axios from "axios";
import Vue from "lodash";

export default {
    actions: {
        // https://pool.btc.com/v1/coins-income?puid=781195
        async getDiff({ commit, state }, data) {
            axios
                .get("https://pool.api.btc.com/v1/coins-income")
                .then((res) => {
                    Object.values(res.data.data).forEach((el, i) => {
                        if (Object.keys(res.data.data)[i] === "btc") {
                            data.item.diff = el.diff;
                        }
                    });
                    commit(`updateInfo`, {
                        key: "btc".toLowerCase(),
                        item: data.item,
                    });
                });
        },
        async getConverter({ commit, state }) {
            // axios
            //     .get(
            //         'https://api.coingecko.com/api/v3/coins/bitcoin/ohlc?vs_currency=usd&days=30'
            //     )
            //     .then((res) => {
            //         console.log(res);
            //     });
            axios
                .get("https://pool.api.btc.com/v1/pool/status/")
                .then(async (response) => {
                    let converterModel = {
                        diff: 0,
                        diff_change: response.data.data.difficulty_change,
                        nextDiff: response.data.data.estimated_next_difficulty,
                        time: 0,
                        network: Number(response.data.data.network_hashrate),
                        networkUnit: response.data.data.network_hashrate_unit,
                        price: Number(response.data.data.exchange_rate.BTC2USD),
                    };
                    if (response.data.data.time_remain !== "-") {
                        converterModel.time = (
                            (response.data.data.time_remain -
                                (Date.now() / 1000).toFixed(0)) /
                            60 /
                            60
                        ).toFixed(0);
                    } else {
                        converterModel.time = response.data.data.time_remain;
                    }
                    await this.dispatch("getReward", {
                        item: converterModel,
                    });
                    this.dispatch("getDiff", {
                        item: converterModel,
                    });
                });
        },
        async getReward({ commit, state }, data) {
            axios
                .get("https://api.minerstat.com/v2/coins?list=BTC,BCH")
                .then((response) => {
                    response.data.forEach((el, i) => {
                        if (el.coin === "BTC") {
                            data.item.reward = el.reward_block;
                        }
                    });
                });
            // axios
            //     .get(
            //         `https://explorer.api.btc.com/stats/insight/difficulty?app_a=S2Q4QUljMHEwNzNoMAI5XdXXMAgwqxia4P8VScnvddXEG5EguXvUEXk4ccTC&app_b=Kd8AIc0q073h0&nonce=DJI22151IXIC7512&timestamp=${(
            //             new Date().getTime() / 1000
            //         ).toFixed(
            //             0
            //         )}&mode=year&coins=btc&sign=sBfOHsJLY6tZdoo4eGxjrGm9wHuzT17UMhDQQn4N`
            //     )
            //     .then((res) => {
            //         console.log(res);
            //     });
        },
    },
    mutations: {
        updateInfo(state, data) {
            Vue.set(state.convertInfo, data.key, data.item);
        },
    },
    state: {
        convertInfo: {},
    },
    getters: {
        btcInfo(state) {
            return state.convertInfo;
        },
    },
};
