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
                                                :attributes="forgotForm.email"></g-input>
                                        </b-form-group>
                                    </ValidationProvider>

                                    <g-button :loading="loading">
                                        Forgot
                                    </g-button>

                                </form>
                            </ValidationObserver>

                            <div class="mt-3 text-center">
                                <router-link :to="{name:'admin.auth.login'}" tag="a" class="text-muted">
                                    <u>Back Password?</u>
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
    import { mapGetters, mapActions } from "vuex";
    import AbstractAuth from "../AbstractAuth";
    export default {
        extends: AbstractAuth,
        metaInfo: {
            // if no subcomponents specify a metaInfo.title, this title will be used
            title: "Tela De Acesso"
        },
        data() {
            return {
                values:{
                    email: "contato@sigasmart.com.br"
                },
                forgotForm:{
                    email:{
                        name:"email",
                        value:"contato@sigasmart.com.br",
                        type:"email",
                        placeholder: "Seu melhor e-mail"
                    }
                }
            };
        },
        computed: {
            ...mapGetters([ "loading", "error", "toast", "redirect"])
        },

        methods: {
            ...mapActions(["forgot","makeToast"]),
            formSubmit() {
                this.forgot(this.values);
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
