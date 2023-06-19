export default {
    actions: {
        getMessage({ commit }, message) {
            commit("SetMessage", message);
            setTimeout(() => commit("ClearMessage"), 3000);
        },
    },
    mutations: {
        SetMessage(state, data) {
            state.message = data;
        },
        ClearMessage(state) {
            state.message = "";
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
