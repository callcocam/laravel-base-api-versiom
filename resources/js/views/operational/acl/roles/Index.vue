<script>

    import AbstractList from "@/components/AbstractList";

    export default {
        extends: AbstractList,
        name: "Roles",
        data(){
            return {
                params:{},
                pathNames:{
                    list:'/api/admin/roles',
                    get:'/api/admin/roles/id',
                    save:'/api/admin/roles/store'
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
