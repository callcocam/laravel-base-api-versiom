
<script>
    import AbstractList from "@/components/AbstractList";
    export default {
        extends: AbstractList,
        name: "StoredRoutes",
        data(){
            return {
                params:{},
                pathNames:{
                    list:'/api/admin/stored-routes',
                    get:'/api/admin/stored-routes/id',
                    save:'/api/admin/stored-routes/store'
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
