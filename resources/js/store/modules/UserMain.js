import {apiService, MainApi, mainApiService, ProfileApi} from "@/api/api";
import {router} from "@/router/index";

export default {
    actions: {
        async setUser({commit, dispatch, state}, user = null) {
            let response = null;

            state.localUser = user ?? JSON.parse(localStorage.getItem("user"));

            if (!user && state.token) {
                try {
                    response = (
                        await MainApi.get(`/user/${state.localUser.id}`)
                    ).data.data;
                } catch (err) {
                    console.error(err);

                    if (err.response.status === 403) {
                        router.push({name: "home"});

                        this.dispatch("drop_all");
                        this.dispatch("dropUser");
                        this.dispatch("dropToken");
                    }

                    response = null;
                }
            }

            const userData =
                user ?? response ?? JSON.parse(localStorage.getItem("user"));
            commit("changeUser", userData);

            dispatch("saveUser");
        },
        async setLocalUser({commit, dispatch, state}, user = null) {
            state.localUser = user ?? JSON.parse(localStorage.getItem("user"));

            const userData = user ?? JSON.parse(localStorage.getItem("user"));
            commit("changeUser", userData);

            dispatch("saveUser");
        },
        async logout({dispatch}) {
            apiService.stopAxios();
            mainApiService.stopAxios();

            await ProfileApi.post("/logout");

            await router.push({name: "home"});

            dispatch("dropUser");
            dispatch("dropToken");
            dispatch("drop_all");
        },
        setToken({commit, dispatch}, token = null) {
            const tokenRow = token ?? JSON.parse(localStorage.getItem("token"));
            commit("changeToken", tokenRow);

            dispatch("saveToken");
        },
        saveUser({state}) {
            localStorage.setItem("user", JSON.stringify(state.user));
        },
        saveToken({state}) {
            localStorage.setItem("token", JSON.stringify(state.token));
        },
        dropUser({commit}) {
            localStorage.removeItem("user");

            commit("changeUser", {});
        },
        dropToken({commit}) {
            localStorage.removeItem("token");

            commit("changeToken", "");
        },
    },
    mutations: {
        changeUser(state, user) {
            state.user = user ;
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
