<script>
    import AbstractForm from "../../components/AbstractForm";
    export default {
        extends: AbstractForm,
        name: "Profile",
        data(){
            return {
                themeInfo:"g-user-info",
                params:{},
                pathNames:{
                    list:'/api/auth/me',
                    get:'/api/auth/me',
                    save:'/api/auth/profile'
                },
            }
        },
        watch:{
            event(val){

                if(val){

                    let user = Object.assign(JSON.parse(localStorage.getItem("userInfo")), val);

                    this.$store.commit('SET_USER_INFO', user)

                }

            }
        }
    }
</script>
