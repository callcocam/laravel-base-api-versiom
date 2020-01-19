<template>
   <div>
       <b-button
           :to="attrs.to"
           :class="attrs.class"
           :variant="attrs.variant"
       >
           <slot></slot>
       </b-button>
   </div>
</template>

<script>
    export default {
        name: "Link",
        props:{
            attributes:{
                type: Object,
                default:null
            }
        },
        data(){
            return {
                value:'',
                attrs:{
                    class:"btn-rounded btn-block",
                    to:"",
                    variant:"primary mt-2"
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

