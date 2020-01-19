
<script>
    import AbstractList from "@/components/AbstractList";
    export default {
        extends: AbstractList,
        name: "Middlewares",
        data(){
            return {
                params:{},
                pathNames:{
                    list:'/api/admin/middlewares',
                    get:'/api/admin/middlewares/id',
                    save:'/api/admin/middlewares/store'
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
