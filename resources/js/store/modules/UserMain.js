import { MainApi, ProfileApi, mainApiService, apiService } from "@/api/api";
import { router } from "@/router/index";

export default {
    actions: {
        async setUser({ commit, dispatch, state }, user = null) {
            let response = null;

            state.localUser = user ?? JSON.parse(localStorage.getItem("user"));

            if (!user && state.token) {
                try {
                    response = (await MainApi.get("/user")).data.data;
                } catch (err) {
                    console.error(err);

                    response = null;
                }
            }

            const userData = user ?? response ?? JSON.parse(localStorage.getItem("user"));
            commit("changeUser", userData);

            dispatch("saveUser");
        },
        async logout({ dispatch }) {
            apiService.stopAxios();
            mainApiService.stopAxios();

            await ProfileApi.post("/logout");

            await router.push({ name: "home" });

            dispatch("dropUser");
            dispatch("dropToken");
            dispatch("drop_all");
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
        localUser: {},
        token: "",
    },
    getters: {
        user(state) {
            return state.user;
        },
        localUser(state) {
            return state.localUser;
        },
        token(state) {
            return state.token;
        },
    },
};
