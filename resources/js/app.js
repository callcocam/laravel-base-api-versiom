/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// import "babel-polyfill";
import Vue from "vue";
import App from "./App.vue";
import router from "./router";
// import VueRouter from "vue-router";
import GullKit from "./plugins/gull.kit";
// import "babel-polyfill";
// import es6Promise from "es6-promise";
// es6Promise.polyfill();
import store from "./store";
//import Breadcumb from "./components/breadcumb";

import i18n from "./lang/lang";

//Vue.component("breadcumb", Breadcumb);
// Vue.use(VueRouter);

Vue.use(GullKit);
//firebase.initializeApp(firebaseSettings);

Vue.config.productionTip = false;

store.dispatch('attempt', localStorage.getItem('token'))

new Vue({
    store,
    router,
    i18n,
    render: h => h(App)
}).$mount("#app");
