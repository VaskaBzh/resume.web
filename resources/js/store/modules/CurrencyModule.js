import axios from "axios";

export default {
    actions: {
        async setCurrency({ commit }) {
            const response = (
                await axios.get("https://www.cbr-xml-daily.ru/latest.js")
            ).data;

            commit("changeCurrencyData", response);
        },
    },
    mutations: {
        changeCurrencyData(state, currency) {
            state.currency = currency;
        },
    },
    state: {
        currency: null,
    },
    getters: {
        currency(state) {
            return state.currency;
        },
    },
};
