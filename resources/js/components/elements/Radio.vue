<template>
   <div>
       <b-form-radio-group
           :name="attrs.name"
           :id="attrs.id"
           :options="attrs.options"
           v-model="value"
           :state="isErrors()"
           :aria-describedby="describedby()"
           @input="onChange()"
       >
       </b-form-radio-group>
       <b-form-invalid-feedback :id="describedby()">
           {{ errors[0] }}
       </b-form-invalid-feedback>
   </div>
</template>

<script>
    import AbstractElement from "./AbstractElement";

    export default {
        name: "Radio",
        extends:AbstractElement
    }
</script>
