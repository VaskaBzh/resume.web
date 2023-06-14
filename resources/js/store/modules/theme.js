export default {
    actions: {
        theme({ commit }, theme) {
            commit("setTheme", theme);
        },
    },
    mutations: {
        setTheme(state, data) {
            state.theme = data;
        },
    },
    state: {
        theme: false,
    },
    getters: {
        getTheme(state) {
            return state.theme;
        },
    },
};
