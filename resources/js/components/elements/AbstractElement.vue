<script>
    export default {
        name: "AbstractElement",
        props:{
            errors:{
                type:[Array, Object],
                default: []
            },
            attributes:{
                type:[Array, Object],
                default:{}
            }
        },
        data(){
            return {
                value:null,
                attrs:{
                    class:"form-control-rounded",
                    type:"text",
                    placeholder:"Digite...",
                }
            }
        },
        created(){
            if(!this.attributes.id){
                this.attrs.id = this.attributes.name
            }
            if(!this.attributes.placeholder){
                this.attrs.placeholder = this.attributes.name
            }
            if(this.attributes.value){
                this.value = this.attributes.value
            }
            this.attrs = Object.assign(this.attrs, this.attributes)
        },
        methods:{
            onChange(){
                console.log(this.value)
                this.$emit('inputBY',this.value)
            },
            describedby(){
                return `input-${this.attrs.id}-live-feedback`;
            },
            isErrors(){
                if (this.errors) {
                    if (this.errors.length) {
                        return false;
                    }
                }
                return true;
            }
        }
    }
</script>
