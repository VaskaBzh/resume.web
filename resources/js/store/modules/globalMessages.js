export default {
    actions: {
        getMessage({ commit }, message) {
            commit("setMessage", message);
        },
    },
    mutations: {
        setMessage(state, data) {
            state.message = data;
        },
    },
    state: {
        message: "",
    },
    getters: {
        getMessage(state) {
            return state.message;
        },
    },
};
