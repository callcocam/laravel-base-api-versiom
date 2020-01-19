const _lodash = require('lodash')

export default {
    state: {
        menus:null
    },
    getters: {
        menus: state => state.menus
    },
    mutations: {

        SET_MENUS(state, data) {

            state.menus = _lodash.filter(data, menu => menu.name == 'admin.dashboards')

        },
        CLEAR_MENUS(state) {
            state.menus = null;
        }
    },
    actions: {
    }
};
