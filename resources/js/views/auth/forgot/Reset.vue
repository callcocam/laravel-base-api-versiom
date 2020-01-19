<template>
    <div
        class="auth-layout-wrap"
        :style="{ backgroundImage: 'url(' + bgImage + ')' }">
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
                                                :attributes="resetForm.email"></g-input>
                                        </b-form-group>
                                    </ValidationProvider>

                                    <ValidationProvider vid="password" name="Password" v-slot="{ errors }">
                                        <b-form-group  class="text-12">
                                            <g-input
                                                v-on:input="values.password = $event"
                                                :errors="errors"
                                                :attributes="resetForm.password"></g-input>
                                        </b-form-group>
                                    </ValidationProvider>

                                    <ValidationProvider vid="password_confirmation" name="PasswordConfirmation" v-slot="{ errors }">
                                        <b-form-group  class="text-12">
                                            <g-input
                                                v-on:input="values.password_confirmation = $event"
                                                :errors="errors"
                                                :attributes="resetForm.password_confirmation"></g-input>
                                        </b-form-group>
                                    </ValidationProvider>

                                    <g-button :loading="loading">
                                        Forgot Password
                                    </g-button>
                                </form>
                            </ValidationObserver>
                        </div>
                    </b-col>

                    <g-access-options />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapGetters, mapActions } from "vuex";
    import AbstractAuth from "../AbstractAuth";
    export default {
        extends: AbstractAuth,
        metaInfo: {
            // if no subcomponents specify a metaInfo.title, this title will be used
            title: "Cadastrar Senha"
        },
        data() {
            return {
                values:{
                    token: this.$route.params.token,
                    email: "contato@sigasmart.com.br",
                    password: "password",
                    password_confirmation: "password",
                },
                resetForm:{
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
                    },
                    password_confirmation:{
                        name:"password_confirmation",
                        value:"password",
                        type:"password",
                        placeholder: "Repetir a senha"
                    }
                }
            };
        },
        computed: {
            ...mapGetters([ "loading", "error", "toast", "redirect"])
        },

        methods: {
            ...mapActions(["reset"]),
            formSubmit() {
                this.reset(this.values);
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
