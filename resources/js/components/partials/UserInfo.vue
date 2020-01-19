<template>
    <div class="user-info mt-3" v-if="row">
        <img :src="row.file.staticValue" alt="" id="image_tag" class="profile-picture avatar-lg mb-2"> <p class="m-0 text-24">{{ row.name.value }}</p> <p class="text-muted m-0">{{ row.email.value }}</p>
    </div>
</template>
<script>
    import { mapGetters } from "vuex";
    export default {
        name: "UserInfo",
        computed:{
            ...mapGetters(["row"])
        }
    }
</script>

<style scoped>

</style>
