<script>

    import AbstractList from "../../../components/AbstractList";

    export default {
        extends: AbstractList,
        name: "Post",
        data(){
            return {
                params:{},
                pathNames:{
                    list:'/api/admin/posts',
                    get:'/api/admin/posts',
                    save:'/api/admin/posts'
                },
            }
        },
        watch:{
            event(val){


            }
        }
    }
</script>
