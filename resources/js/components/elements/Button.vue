<template>
   <div>
       <b-button
           :type="attrs.type"
           :tag="attrs.tag"
           :class="attrs.class"
           :variant="attrs.variant"
           :disabled="loading"
       >
           <slot></slot>
       </b-button>
       <div v-once class="typo__p" v-if="loading">
           <div class="spinner sm spinner-primary mt-3"></div>
       </div>
   </div>
</template>

<script>
    export default {
        name: "Button",
        props:{
            loading:{
                type: Boolean,
                default: false
            },
            attributes:{
                type: Object,
                default:null
            }
        },
        data(){
            return {
                value:'',
                attrs:{
                    class:"btn btn-primary btn-rounded btn-block mt-2",
                    type:"submit",
                    variant:"primary mt-2",
                    tag:"button",
                }
            }
        },
        created(){

            if(this.attributes){

                this.attrs = Object.assign(this.attrs, this.attributes)

            }




        }
    }
</script>

<style scoped>

</style>
