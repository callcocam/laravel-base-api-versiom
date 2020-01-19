<template>
    <div class="auth-logo text-center mb-30">
        <img :src="logo" />
    </div>
</template>

<script>
    export default {
        name: "Logo",
        data(){
            return {
                logo: require("@/assets/images/logo.png"),
            }
        }
    }
</script>

<style scoped>

</style>
