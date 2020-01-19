<script>
    import { mapGetters } from "vuex";
    export default {
        name: "AbstractAuth",
        data(){
            return {
                bgImage: require("@/assets/images/photo-wide-4.jpg")
            }
        },
        computed: {
            ...mapGetters(["loggedInUser", "loading", "error", "toast", "redirect"])
        },
        watch: {
            error(errors) {
                if (errors != null) {
                    this.$refs.form.setErrors(JSON.parse(JSON.stringify(errors)));
                }
            },
            toast(errors) {
                if (errors != null) {
                    let error = JSON.parse(errors)
                    this.$bvToast.toast(error.msg, {
                        title: error.title || "OPS!!",
                        variant: error.variant,
                        solid: error.solid
                    });
                }
            },
            redirect(val){
               console.log(val)
                if(val){
                    setTimeout(()=>{
                        this.$router.replace(val);
                    }, 2000)
                }
            }
        }
    }
</script>

