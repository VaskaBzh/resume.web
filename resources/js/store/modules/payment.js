import axios from "axios";
import Vue from "lodash";

export default {
    actions: {
        async getInfo({ commit, state }, data) {
            axios.post("/see_balance", data).then((res) => {
                JSON.parse(res.data.tickers).forEach((el, i) => {
                    let date = new Date(el[0] * 1000);
                    let rowModel = {
                        date: `${
                            String(date.getUTCDate()).length < 2
                                ? "0" + date.getUTCDate()
                                : date.getUTCDate()
                        }.${
                            String(date.getUTCMonth() + 1).length < 2
                                ? "0" + (date.getUTCMonth() + 1)
                                : date.getUTCMonth() + 1
                        }.${date.getUTCFullYear()}`,
                        amount: el[2],
                        percent: el[4],
                        address: el[1],
                        transaction: el[3],
                        info:
                            el[5] === "pending"
                                ? "В обработке"
                                : el[5] === "completed"
                                ? "Оплачено"
                                : "Отклонено",
                        infoClass: el[5],
                    };
                    commit("updateTable", {
                        item: rowModel,
                        key: i,
                    });
                });
            });
        },
    },
    mutations: {
        updateTable(state, data) {
            Vue.set(state.table, data.key, data.item);
        },
    },
    state: {
        table: [],
    },
    getters: {
        getTable(state) {
            return state.table;
        },
    },
};
