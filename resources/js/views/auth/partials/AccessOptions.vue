<template>
    <b-col
        md="6"
        class="text-center"
        style="backgroundSize: cover;"
        :style="{ backgroundImage: 'url(' + signInImage + ')' }"
    >
        <div class="pr-3 auth-right">
            <router-link
                to="signUp"
                class="btn btn-rounded btn-outline-primary btn-outline-email btn-block btn-icon-text"
                href="signup.html"
            >
                <i class="i-Mail-with-At-Sign"></i> Sign up with Email
            </router-link>
            <a
                class="btn btn-rounded btn-outline-primary btn-outline-google btn-block btn-icon-text"
            >
                <i class="i-Google-Plus"></i> Sign up with Google
            </a>
            <a
                class="btn btn-rounded btn-outline-primary btn-block btn-icon-text btn-outline-facebook"
            >
                <i class="i-Facebook-2"></i> Sign up with Facebook
            </a>
        </div>
    </b-col>
</template>
<script>
    export default {

        data(){

            return {
                signInImage: require("@/assets/images/photo-long-3.jpg")
            }
        }
    }
</script>
