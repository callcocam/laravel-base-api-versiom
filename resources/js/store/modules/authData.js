export default {
    state: {
        loggedInUser: null ,
        token: null
    },
    getters: {
        loggedInUser: state => {

            let data = [];

            if(state.loggedInUser){

                let user = JSON.parse(state.loggedInUser);

                Object.keys(user).map(v => {

                    data[v] = user[v].value

                })

                return  data;
            }


            return  null
        },
        token: state => state.token
    },
    mutations: {
        SET_TOKEN(state, data) {
            localStorage.setItem("token", data);
            state.token = data
            state.loading = false;
            state.error = null;
        },
        SET_USER(state, data) {
            localStorage.setItem("userInfo", JSON.stringify(data));
            state.loggedInUser = JSON.stringify(data);
            state.loading = false;
            state.error = null;
        },
        SET_USER_INFO(state, data) {
            localStorage.setItem("userInfo", JSON.stringify(data));
            state.loggedInUser = JSON.stringify(data);
        },
        SET_LOGOUT(state) {
            state.loggedInUser = null;
            state.loading = false;
            state.error = null;
            localStorage.removeItem("token");
            localStorage.removeItem("userInfo");
        }
    },
    actions: {
        login({dispatch,commit}, data) {
            commit("CLEAR_TOAST");//limpa as menssagens
            commit("SET_REDIRECT", null);//limpa o redirect
            commit("CLEAR_ERROR");//limpa os errors
            commit("SET_LOADING", true);//seta o load
            Resource.post('/api/auth/login', data).then(response=>{

                commit("SET_LOADING", false);

                dispatch('attempt', response.body);

                commit("SET_REDIRECT", {
                    name:"admin.dashboards"
                });

            }).catch((e)=>{

                commit("SET_LOADING", false);
                commit("SET_ERROR", e.data.errors);
                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            });

        },
        async attempt({commit},data) {

            if(data){
                commit("SET_TOKEN", data);
            }else{
                return ;
            }

            try {

                let response = await Resource.get('/api/auth/me');

                commit("SET_USER", response.data);

                commit("SET_TOAST", {
                    msg:`Seja bem vindo ${response.data.name}!!`,
                    variant:'success'
                });

            }catch (e) {
                commit("SET_LOGOUT");
                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            }

        },
        signUserUp({commit}, data) {
            commit("CLEAR_TOAST");//limpa as menssagens
            commit("SET_REDIRECT", null);//limpa o redirect
            commit("CLEAR_ERROR");//limpa os errors
            commit("SET_LOADING", true);//seta o load
        },
        refresh({commit}) {

            return  Resource.post('/api/auth/refresh').then(response => {

                localStorage.setItem('token', response.body)


                return response;
            })
        },
        signOut({commit}) {
            commit("CLEAR_TOAST");//limpa as menssagens
            commit("SET_REDIRECT", null);//limpa o redirect
            commit("CLEAR_ERROR");//limpa os errors
            commit("SET_LOADING", true);//seta o load
            Resource.post('/api/auth/logout').then(response=>{
                commit("SET_LOGOUT");
                commit("SET_LOADING", false);
                commit("SET_REDIRECT", {
                    name:'admin.auth.login'
                });
            }).catch((e)=>{
                commit("SET_LOGOUT");
                commit("SET_LOADING", false);
                commit("SET_REDIRECT", {
                    name:'admin.auth.login'
                });
                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            });


        },
        forgot({commit}, data) {
            commit("CLEAR_TOAST");//limpa as menssagens
            commit("SET_REDIRECT", null);//limpa o redirect
            commit("CLEAR_ERROR");//limpa os errors
            commit("SET_LOADING", true);//seta o load
            Resource.post('/api/auth/reset-password', data).then(response=>{
                commit("SET_LOADING", false);
                commit("SET_REDIRECT", {
                    name:'admin.auth.login'
                });
                commit("SET_TOAST", {
                    msg:response.data.message,
                    variant:'success'
                });
            }).catch((e)=>{
                commit("SET_LOADING", false);
                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            });

        },
        reset({dispatch,commit}, data) {
            commit("CLEAR_TOAST");//limpa as menssagens
            commit("SET_REDIRECT", null);//limpa o redirect
            commit("CLEAR_ERROR");//limpa os errors
            commit("SET_LOADING", true);//seta o load
            Resource.post('/api/auth/reset/password', data).then(response=>{
                commit("SET_LOADING", false);
                commit("SET_REDIRECT", {
                    name:'admin.auth.login'
                })
                commit("SET_TOAST", {
                    msg:response.data.message,
                    variant:'success'
                });
            }).catch((e)=>{
                commit("SET_LOADING", false);
                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            })
        }
    }
};
