import { useDark } from "@vueuse/core";

export default {
    actions: {
        theme({ commit }, theme) {
            commit("setTheme", theme);
        },
        SetThemeVal({ commit }, theme) {
            commit("setVal", theme);
        },
    },
    mutations: {
        setTheme(state, data) {
            state.theme = data;
        },
        setVal(state, boolean) {
            state.dark = boolean;
        },
    },
    state: {
        timer: true,
        theme: "light",
        dark: useDark({
            selector: "body",
            attribute: "color-scheme",
            valueDark: "dark",
            valueLight: "light",
        }),
    },
    getters: {
        getTheme(state) {
            return state.theme;
        },
        isDark(state) {
            return state.dark;
        },
    },
};
