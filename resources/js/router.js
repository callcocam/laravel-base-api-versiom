import Vue from "vue";
import store from "@/store";
// import {isMobile} from "mobile-device-detect";
import Router from "vue-router";
import NProgress from "nprogress";
import authenticate from "@/auth/authenticate";
import { authRoute } from "@/views/auth/router";
import guest from "@/auth/guest";
Vue.use(Router);
// create new router

const routes = [
    {
        path: "/admin",
        component: () => import(/* webpackChunkName: "admin"*/ "./views"), //webpackChunkName app
        redirect: "/admin/dashboards",
        beforeEnter: authenticate,
        name:'admin.dashboards',
        children: [
            {
                path: "dashboards",
                beforeEnter: authenticate,
                name:'admin.dashboards.index',
                component: () => import(/* webpackChunkName: "dashboards" */ "@/views/dashboards/DashboardV1"), //dashboard
            },
            {
                path: "minha-empresa",
                name:'admin.settings.company',
                beforeEnter: authenticate,
                component: () => import(/* webpackChunkName: "setting" */ "@/views/company/Setting"), //profile
            },
            {
                path: "minha-conta",
                name:'admin.user.profile',
                beforeEnter: authenticate,
                component: () => import(/* webpackChunkName: "profile" */ "@/views/user/Profile"), //profile
            },

            {
                path: "blog",
                name:'admin.blog.index',
                redirect: {name:'admin.posts.index'},
                beforeEnter: authenticate,
                component: () => import(/* webpackChunkName: "posts" */ "@/views/blog"), //posts
                children:[
                    {
                        path: "posts",
                        name:'admin.posts.index',
                        beforeEnter: authenticate,
                        component: () => import(/* webpackChunkName: "profile" */ "@/views/blog/posts"), //profile
                    },
                ]
            },
            {
                path: "operacional",
                beforeEnter: authenticate,
                redirect: {name:'admin.roles.index'},
                component: () => import(/* webpackChunkName: "acl" */ "@/views/operational"), //posts
                children:[
                    {
                        path: "roles",
                        name:'admin.roles.index',
                        beforeEnter: authenticate,
                        component: () => import(/* webpackChunkName: "roles" */ "@/views/operational/acl/roles"), //profile
                    },
                    {
                        path: "permissions",
                        name:'admin.permissions.index',
                        beforeEnter: authenticate,
                        component: () => import(/* webpackChunkName: "permissions" */ "@/views/operational/acl/permissions"), //profile
                    },
                    {
                        path: "middlewares",
                        name:'admin.middlewares.index',
                        beforeEnter: authenticate,
                        component: () => import(/* webpackChunkName: "middlewares" */ "@/views/operational/middlewares"), //profile
                    },
                    {
                        path: "rotas",
                        name:'admin.stored-routes.index',
                        beforeEnter: authenticate,
                        component: () => import(/* webpackChunkName: "middlewares" */ "@/views/operational/stored-routes"), //profile
                    },
                    {
                        path: "tradutor",
                        name:'admin.translation.index',
                        beforeEnter: authenticate,
                        component: () => import(/* webpackChunkName: "translations" */ "@/views/operational/translates"), //profile
                    },
                ]
            },
            {
                path: "*",
                component: () => import("@/views/not-found")
            }

        ]
    },
    {
        path: "/admin/auth",
        component: () => import(/* webpackChunkName: "auth" */ "@/views/auth"), //webpackChunkName app
        redirect: "/admin/auth/login",
        name:'admin.auth',
        children: [
            ...authRoute
        ]
    }
]


store.commit('SET_MENUS', routes);

const router = new Router({
    mode: "history",
    linkActiveClass: "open",
    routes,
    scrollBehavior(to, from, savedPosition) {
        return {x: 0, y: 0};
    }
});

router.beforeEach((to, from, next) => {
    // If this isn't an initial page load.
    if (to.path) {
        // Start the route progress bar.

        NProgress.start();
        NProgress.set(0.1);
    }
    next();
});

router.afterEach(() => {
    // Remove initial loading
    const gullPreLoading = document.getElementById("loading_wrap");
    if (gullPreLoading) {
        gullPreLoading.style.display = "none";
    }
    // Complete the animation of the route progress bar.
    setTimeout(() => NProgress.done(), 500);
    // NProgress.done();
    // if (isMobile) {
    if (window.innerWidth <= 1200) {
        // console.log("mobile");
        store.dispatch("changeSidebarProperties");
        if (store.getters.getSideBarToggleProperties.isSecondarySideNavOpen) {
            store.dispatch("changeSecondarySidebarProperties");
        }

        if (store.getters.getCompactSideBarToggleProperties.isSideNavOpen) {
            store.dispatch("changeCompactSidebarProperties");
        }
    } else {
        if (store.getters.getSideBarToggleProperties.isSecondarySideNavOpen) {
            store.dispatch("changeSecondarySidebarProperties");
        }

        // store.state.sidebarToggleProperties.isSecondarySideNavOpen = false;
    }
});

export default router;
