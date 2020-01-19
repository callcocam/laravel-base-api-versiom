import BootstrapVue from "bootstrap-vue";

import VueResource from 'vue-resource';
import CKEditor from '@ckeditor/ckeditor5-vue';


import VueTheMask from "vue-the-mask";
import VueLazyload from "vue-lazyload";
import Meta from "vue-meta";
import FlagIcon from "vue-flag-icon";

import "@/assets/styles/sass/themes/lite-purple.scss";

import "@/plugins/interceptors";

import "@/plugins/sweetalert2";
import "@/plugins/vee-validate";

export default {
    install(Vue) {

        Vue.use(VueResource);
        Vue.use( CKEditor );
        Vue.use(BootstrapVue);
        Vue.component(
            "large-sidebar",
            // The `import` function returns a Promise.
            () => import("@/containers/layouts/largeSidebar")
        );
        Vue.component("vue-perfect-scrollbar", () =>
            import("vue-perfect-scrollbar")
        );

        Vue.component("g-user-info", require("@/components/partials/UserInfo.vue").default);
        Vue.component("g-cover-info", require("@/components/partials/CoverInfo.vue").default);

        Vue.component("g-editor", require("@/components/elements/Editor.vue").default);
        Vue.component("g-input", require("@/components/elements/Input.vue").default);
        Vue.component("g-textarea", require("@/components/elements/Textarea.vue").default);
        Vue.component("g-radio", require("@/components/elements/Radio.vue").default);
        Vue.component("g-file", require("@/components/elements/File.vue").default);
        Vue.component("g-button",require("@/components/elements/Button.vue").default);
        Vue.component("g-link", require("@/components/elements/Link.vue").default);
        Vue.component("g-logo",require("@/views/auth/partials/Logo.vue").default);
        Vue.component("g-access-options",require("@/views/auth/partials/AccessOptions.vue").default);

        Vue.use(Meta, {
            keyName: "metaInfo",
            attribute: "data-vue-meta",
            ssrAttribute: "data-vue-meta-server-rendered",
            tagIDKeyName: "vmid",
            refreshOnceOnNavigation: true
        });

        Vue.use(FlagIcon);
        // maskForm
        Vue.use(VueTheMask);
        Vue.use(VueLazyload, {
            observer: true,
            // optional
            observerOptions: {
                rootMargin: "0px",
                threshold: 0.1
            }
        });
    }
}
