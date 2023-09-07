export default {
    actions: {
        setUser({ commit, dispatch }, user = null) {
            const userData = user ?? JSON.parse(localStorage.getItem("user"));
            commit("changeUser", userData);

            dispatch("saveUser");
        },
        setToken({ commit, dispatch }, token = null) {
            const tokenRow = token ?? localStorage.getItem("token");
            commit("changeToken", tokenRow);

            dispatch("saveToken");
        },
        saveUser({ state }) {
            localStorage.setItem("user", JSON.stringify(state.user));
        },
        saveToken({ state }) {
            localStorage.setItem("token", state.token);
        },
        dropUser({ state }, user) {},
        dropToken({ state }, token) {},
    },
    mutations: {
        changeUser(state, user) {
            state.user = user;
        },
        changeToken(state, token) {
            state.token = token;
        },
    },
    state: {
        user: {},
        token: "",
    },
    getters: {
        user({ state }) {
            return state.user;
        },
        token({ state }) {
            return state.token;
        },
    },
};
