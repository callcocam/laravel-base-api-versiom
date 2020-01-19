import Vuex from "vuex";
import Vue from "vue";
import largeSidebar from "./modules/largeSidebar";
import compactSidebar from "./modules/compactSidebar";
import toast from "./modules/toast";
import repository from "./modules/repository";
import config from "./modules/config";
import menus from "./modules/menus";
import authData from "./modules/authData";


// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
    modules: {
        largeSidebar,
        compactSidebar,
        toast,
        config,
        repository,
        menus,
        authData
    }
});

