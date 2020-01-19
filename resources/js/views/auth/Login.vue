<template>
    <div
        class="auth-layout-wrap"
        :style="{ backgroundImage: 'url(' + bgImage + ')' }"
    >
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <b-col md="6">
                        <div class="p-4">
                            <g-logo />
                            <ValidationObserver ref="form" v-slot="{ passes }">
                                <form @submit.prevent="passes(formSubmit)">

                                    <ValidationProvider vid="email" name="E-mail" v-slot="{ errors }">
                                        <b-form-group  class="text-12">
                                            <g-input
                                                v-on:input="values.email = $event"
                                                :errors="errors"
                                                :attributes="loginForm.email"></g-input>
                                        </b-form-group>
                                    </ValidationProvider>

                                    <ValidationProvider vid="password" name="Password" v-slot="{ errors }">
                                        <b-form-group  class="text-12">
                                            <g-input
                                                v-on:input="values.password = $event"
                                                :errors="errors"
                                                :attributes="loginForm.password"></g-input>
                                        </b-form-group>
                                    </ValidationProvider>

                                    <g-button :loading="loading">
                                        SignIn
                                    </g-button>

<!--                                    <g-link :attributes="{to:'cadastre-se'}">Create an account</g-link>-->
                                </form>
                            </ValidationObserver>

                            <div class="mt-3 text-center">
                                <router-link :to="{name:'admin.auth.forgot.email'}" tag="a" class="text-muted">
                                    <u>Forgot Password?</u>
                                </router-link>
                            </div>
                        </div>
                    </b-col>

                    <g-access-options />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapActions } from "vuex";
    import AbstractAuth from "./AbstractAuth";
    export default {
        extends: AbstractAuth,
        metaInfo: {
            // if no subcomponents specify a metaInfo.title, this title will be used
            title: "Tela De Acesso"
        },
        data() {
            return {
                values:{
                    email: "contato@sigasmart.com.br",
                    password: "password",
                },
                loginForm:{
                    email:{
                        name:"email",
                        value:"contato@sigasmart.com.br",
                        type:"email",
                        placeholder: "Seu melhor e-mail"
                    },
                    password:{
                        name:"password",
                        value:"password",
                        type:"password",
                        placeholder: "Digite uma senha"
                    }
                }
            };
        },

        methods: {
            ...mapActions(["login"]),
            formSubmit() {
                this.login(this.values);
            }
        }
    };
</script>

<style>
    .spinner.sm {
        height: 2em;
        width: 2em;
    }
</style>
