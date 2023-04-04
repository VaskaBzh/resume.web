import axios from "axios";
import Vue from "lodash";

export default {
    actions: {
        postInfo({ commit, state }, data) {
            console.log(data);
            axios.post("/set_payment", data).then((res) => console.log(res));
        },
        async getInfo({ commit, state }) {
            axios.get("/render_payment").then((res) => {
                res.data.data.forEach((row, i) => {
                    let rowModel = {
                        date: row.created_at.substr(0, 10),
                        amount: row.amount,
                        percent: row.percent,
                        address: row.wallet_address,
                        info:
                            row.status === "pending"
                                ? "В обработке"
                                : row.status === "completed"
                                ? "Оплачено"
                                : "Отклонено",
                        infoClass: row.status,
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
