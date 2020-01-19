<template>
   <div>
       <b-form-file
           :name="attrs.name"
           :ref="attrs.name"
           :id="attrs.id"
           :class="attrs.class"
           :drop-placeholder="attrs.dropPlaceholder || 'Drop file here...'"
           :placeholder="attrs.placeholder || 'Drop file here...'"
            v-model="file"
           :state="isErrors()"
           :aria-describedby="describedby()"
           @input="handleFileUpload()"
       >
       </b-form-file>
       <b-form-invalid-feedback :id="describedby()">
           {{ errors[0] }}
       </b-form-invalid-feedback>
   </div>
</template>

<script>
    import AbstractElement from "./AbstractElement";

    export default {
        name: "Input",
        extends:AbstractElement,
        data(){
            return {
                file:null,
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
            if(this.attributes.value){
                this.attrs.placeholder = this.attributes.staticValue
            }
            this.attrs = Object.assign(this.attrs, this.attributes)
        },
        methods:{
            handleFileUpload(){
                this.$emit('inputBY',this.file)
            }
        }

    }
</script>

<style scop="scss">
    .custom-file-label::after {
        content: 'Selecione uma imagem';
    }
</style>
