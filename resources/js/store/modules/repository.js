export default {
    state: {
        pathname:{
            list:'',
            get:'',
            save:'',
            delete:'',
        },
        row:null,
        event:null,
        rows:[],
    },
    getters: {
        pathname: state => state.pathname,
        row: state => state.row,
        event: state => state.event,
        rows: state => state.rows,
    },
    mutations: {

        SET_EVENT(state, data) {
            state.event =  data ;
        },

        SET_ROWS(state, data) {
            state.rows =  data ;
        },

        SET_ROW(state, data) {
            state.row =  data ;
        },

        CLEAR_ROW(state) {
            state.row = null;
        },

        CLEAR_ROWS(state) {
            state.rows = [];
        },

        CLEAR_EVENTS(state) {
            state.event = [];
        },


        SET_PATH(state, data) {

            state.pathname = data;

        }
    },
    actions: {
        path({commit}, data = {}) {

            commit("SET_PATH", data);

        },
        get({commit,state}, data = {}) {

            commit("SET_LOADING", true);

            commit('CLEAR_ROW');


            Resource.get(state.pathname.get,data).then(response=>{

                commit("SET_LOADING", false);

                commit("SET_ROW", response.body);

                commit("SET_EVENT", response.body);

            }).catch((e)=>{

                commit("SET_LOADING", false);

                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });

            });
        }, delete({commit,state}, data = {}) {

            commit("SET_LOADING", true);

            commit('CLEAR_ROW');


            Resource.delete(state.pathname.delete,data).then(response=>{

                commit("SET_LOADING", false);

                commit("SET_ROWS", response.body);

                commit("SET_EVENT", response.body);

                if(response.body.message.value){
                    commit("SET_TOAST", {
                        msg:response.body.message.value,
                        variant:'success'
                    });
                }
                else {
                    if(response.body.message){
                        commit("SET_TOAST", {
                            msg:response.body.message,
                            variant:'success'
                        });
                    }
                }


            }).catch((e)=>{

                commit("SET_LOADING", false);

                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });

            });
        },
        list({commit,state}, data) {

            commit("SET_LOADING", true);

            commit('CLEAR_TOAST');

            commit('CLEAR_ROWS');

            Resource.get(state.pathname.list,data).then(response=>{

                commit("SET_LOADING", false);

                commit("SET_ROWS", response.body);

                commit("SET_EVENT", response.body);


            }).catch((e)=>{

                commit("SET_LOADING", false);

                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            });
        },
        save({commit,state}, data) {

            commit("SET_LOADING", true);

            //commit('CLEAR_ROW');

            commit('CLEAR_TOAST');

            Resource.post(state.pathname.save,data).then(response=>{

                commit("SET_LOADING", false);

                commit("SET_ROW", response.body);

                commit("SET_EVENT", response.body);

                if(response.body.message.value){
                    commit("SET_TOAST", {
                        msg:response.body.message.value,
                        variant:'success'
                    });
                }
                else {
                    if(response.body.message){
                        commit("SET_TOAST", {
                            msg:response.body.message,
                            variant:'success'
                        });
                    }
                }


            }).catch((e)=>{

                commit("SET_LOADING", false);

                commit("SET_TOAST", {
                    msg:e.data.message,
                    variant:'danger'
                });
            });
        }
    }
};
