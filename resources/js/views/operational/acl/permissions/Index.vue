<script>

    import AbstractList from "@/components/AbstractList";

    export default {
        extends: AbstractList,
        name: "Roles",
        data(){
            return {
                params:{},
                pathNames:{
                    list:'/api/admin/permissions',
                    get:'/api/admin/permissions/id',
                    save:'/api/admin/permissions/store'
                },
            }
        },
        watch:{
            event(val){

                if(val){


                }

            }
        }
    }
</script>
