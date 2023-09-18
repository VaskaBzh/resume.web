export default {
    actions: {
        getViewportWidth({ commit }, viewportWidth) {
            commit("setViewportWidth", viewportWidth);
        },
    },
    mutations: {
        setViewportWidth(state, viewportWidth) {
            state.viewportWidth = viewportWidth;
        },
    },
    state: {
        viewportWidth: 0,
    },
    getters: {
        viewportWidth(state) {
            return state.viewportWidth;
        },
    },
};
