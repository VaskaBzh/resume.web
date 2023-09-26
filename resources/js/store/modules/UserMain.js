import api from "@/api/api"

export default {
    actions: {
        async setUser({ commit, dispatch, state }, user = null) {
            // if (!user) {
            //  const response = (await api.get("/get_user", {
            //          headers: {
            //              Authorization: `Bearer ${state.token}`,
            //          },
            //      })).data.data;
            // }

            const userData = user ?? JSON.parse(localStorage.getItem("user")) /* response */;
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
        dropUser({ commit }) {
            localStorage.removeItem("user");

            commit("changeUser", {});
        },
        dropToken({ commit }) {
            localStorage.removeItem("token");

            commit("changeToken", "");
        },
    },
    mutations: {
        changeUser(state, user) {
            state.user = { ...user };
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
        user(state) {
            return state.user;
        },
        token(state) {
            return state.token;
        },
    },
};
