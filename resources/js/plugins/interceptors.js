import Vue from 'vue';
import VueResource from 'vue-resource';
Vue.use(VueResource);

import store from '../store';

Vue.http.interceptors.push((request, next) => {
    request.headers.set('Authorization',  `Bearer ${localStorage.getItem("token")}`);
    next();
});

Vue.http.interceptors.push((request, next) => {
    next(response => {
        if (response.status === 401) { //token expirado
            return store.dispatch('refresh')
                .then(() => {
                    return Vue.http(request);
                }).catch(() => {
                    store.commit("SET_LOGOUT");
                    store.commit("SET_REDIRECT", {
                        name:'admin.auth.login'
                    });
                });
        }
    });
});
