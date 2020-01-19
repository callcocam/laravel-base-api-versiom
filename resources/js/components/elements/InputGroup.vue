<template>
   <div>
       <b-form-input
           :name="attrs.name"
           :id="attrs.id"
           :class="attrs.class"
           :type="attrs.type"
           :placeholder="attrs.placeholder"
           v-model="value"
           :state="isErrors()"
           :aria-describedby="describedby()"
           @change="onChange()"
       >
       </b-form-input>
       <b-form-invalid-feedback :id="describedby()">
           {{ errors[0] }}
       </b-form-invalid-feedback>
   </div>
</template>

<script>
    export default {
        name: "Input",
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
                value:'',
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
              this.$emit('input',this.value)
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
