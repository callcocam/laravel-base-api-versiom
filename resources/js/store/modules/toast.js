export default {
    state: {
        toast:null,
        redirect: null,
        loading: false,
        error: null
    },
    getters: {
        toast: state => state.toast,
        redirect: state => state.redirect,
        loading: state => state.loading,
        error: state => state.error
    },
    mutations: {

        SET_TOAST(state, data) {
            state.toast = JSON.stringify( data );
        },
        CLEAR_TOAST(state) {
            state.toast = null;
        },
        SET_LOADING(state, data) {
            state.loading = data;
            state.error = null;
        },
        SET_REDIRECT(state, data) {
            state.redirect = data;
        },
        SET_ERROR(state, data) {
            state.error = data;
            state.loggedInUser = null;
            state.loading = false;
        },
        CLEAR_ERROR(state) {
            state.error = null;
        }
    },
    actions: {
        makeToast({commit}, data) {

                commit('SET_TOAST', data);

        }
    }
};
