
import guest from "@/auth/guest";

export const authRoute =  [
            {
                path: "login",
                name:'admin.auth.login',
                beforeEnter: guest,
                component: () => import(/* webpackChunkName: "login" */ "@/views/auth/Login"), //login
            },
            {
                path: "cadastre-se",
                name:'admin.auth.register',
                beforeEnter: guest,
                component: () => import(/* webpackChunkName: "register" */ "@/views/auth/register"), //register
            },
            {
                path: "recuperar-senha",
                name:'admin.auth.forgot',
                beforeEnter: guest,
                redirect: "/admin/auth/recuperar-senha/email",
                component: () => import(/* webpackChunkName: "forgot" */ "@/views/auth/forgot"), //forgot
                children:[
                    {
                        path: "email",
                        name:'admin.auth.forgot.email',
                        beforeEnter: guest,
                        component: () => import(/* webpackChunkName: "reset" */ "@/views/auth/forgot/Forgot") //reset
                    },
                    {
                        path: ":token",
                        name:'admin.auth.forgot.reset',
                        beforeEnter: guest,
                        component: () => import(/* webpackChunkName: "reset" */ "@/views/auth/forgot/Reset") //reset
                    }
                ]
            },
]

