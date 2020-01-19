<template>
    <div v-if="row" class="header-cover" :style="{backgroundImage:  row.file.staticValue}"></div>
</template>
<script>
    import { mapGetters } from "vuex";
    export default {
        name: "CoverInfo",
        computed:{
            ...mapGetters(["row"])
        }
    }
</script>

<style scoped>

</style>
