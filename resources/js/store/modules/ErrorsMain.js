export default {
    actions: {
        setFullErrors({ commit }, errors) {
            console.log(errors);
            this.dispatch("setErrors", errors);
            this.dispatch("setErrorsExpired", errors);
        },
        setErrors({ commit }, errors) {
            commit("changeErrors", errors);
        },
        setErrorsExpired({ commit }, errors) {
            commit("changeErrorsExpired", errors);
        },
        dropErrors({ commit }) {
            commit("removeErrors");
        },
        dropErrorsExpired({ commit }) {
            commit("removeErrorsExpired");
        },
    },
    mutations: {
        changeErrors(state, errors) {
            state.errors = { ...errors };
        },
        changeErrorsExpired(state, errors) {
            state.errorsExpired = { ...errors };
            setTimeout(() => {
                state.errorsExpired = {};
            }, 1500);
        },
        removeErrors(state) {
            state.errors = {};
        },
        removeErrorsExpired(state) {
            state.errorsExpired = {};
        },
    },
    state: {
        errors: {},
        errorsExpired: "",
    },
    getters: {
        errors(state) {
            return state.errors;
        },
        errorsExpired(state) {
            return state.errorsExpired;
        },
    },
};
