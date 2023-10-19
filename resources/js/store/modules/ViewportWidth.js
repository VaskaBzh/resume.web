export default {
    actions: {
        getViewportWidth({commit}, viewportWidth) {
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
        isDesktop(state) {
            return state.viewportWidth > 991;
        },
        isTablet(state) {
            return state.viewportWidth <= 991;
        },
        isMobile(state) {
            return state.viewportWidth <= 768;
        },
    },
};
