<script>
    import AbstractForm from "../../components/AbstractForm";
    export default {
        extends: AbstractForm,
        name: "Company",
        data(){
            return {
                themeInfo:"g-user-info",
                params:{},
                pathNames:{
                    list:'/api/admin/settings',
                    get:'/api/admin/settings/settings',
                    save:'/api/admin/settings/store'
                },
            }
        }
    }
</script>
