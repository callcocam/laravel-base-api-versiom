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
    import AbstractElement from "./AbstractElement";

    export default {
        name: "Input",
        extends:AbstractElement

    }
</script>
