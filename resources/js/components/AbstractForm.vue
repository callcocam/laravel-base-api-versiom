<template>
    <div class="card user-profile o-hidden mb-4">
        <component v-if="themeInfo" :is="themeInfo"></component>
        <div class="card-body" v-if="!loading">
            <div class="row">
                <div class="col-lg-8 col-md-12 m-auto">
                    <ValidationObserver ref="form" v-slot="{ passes }">
                        <form @submit.prevent="passes(formSubmit)">
                            <template v-for="(element, index) in row">
                                <template v-if="element.type">
                                    <template v-if="element.type == 'textarea'">
                                        <ValidationProvider :vid="element.name" :name="element.label || element.name" v-slot="{ errors }">
                                            <b-form-group :label="element.label || element.name">
                                                <g-textarea
                                                    v-on:inputBY="element.value = $event"
                                                    :errors="errors"
                                                    :attributes="element"></g-textarea>
                                            </b-form-group>
                                        </ValidationProvider>
                                    </template>
                                    <template v-else-if="element.type == 'hidden'">
                                        <input type="hidden" v-model="element.value">
                                    </template>
                                    <template v-else-if="element.type == 'radio'">
                                        <ValidationProvider :vid="element.name" :name="element.label || element.name" v-slot="{ errors }">
                                            <b-form-group :label="element.label || element.name">
                                                <g-radio
                                                    v-on:inputBY="element.value = $event"
                                                    :errors="errors"
                                                    :attributes="element"></g-radio>
                                            </b-form-group>
                                        </ValidationProvider>
                                    </template>

                                    <template v-else-if="element.type == 'file'">
                                        <ValidationProvider :vid="element.name" :name="element.label || element.name" v-slot="{ errors }">
                                            <b-form-group :label="element.label || element.name">
                                                <g-file
                                                    v-on:inputBY="element.value = $event"
                                                    :errors="errors"
                                                    :attributes="element"></g-file>
                                            </b-form-group>
                                        </ValidationProvider>
                                    </template>
                                    <template v-else-if="element.type == 'editor'">
                                        <ValidationProvider :vid="element.name" :name="element.label || element.name" v-slot="{ errors }">
                                            <b-form-group :label="element.label || element.name">
                                                <g-editor
                                                    v-on:inputBY="element.value = $event"
                                                    :errors="errors"
                                                    :attributes="element"></g-editor>
                                            </b-form-group>
                                        </ValidationProvider>
                                    </template>

                                    <template v-else-if="element.type == 'separator'">
                                        <label class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">{{ element.label }}</label>
                                    </template>
                                    <template v-else>
                                        <ValidationProvider :vid="element.name" :name="element.label || element.name" v-slot="{ errors }">
                                            <b-form-group :label="element.label || element.name">
                                                <g-input
                                                    v-on:inputBY="element.value = $event"
                                                    :errors="errors"
                                                    :attributes="element"></g-input>
                                            </b-form-group>
                                        </ValidationProvider>
                                    </template>
                                </template>
                            </template>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">Salvar Dados</button>
                            </div>
                        </form>
                    </ValidationObserver>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        name: "AbstractForm",
        data(){
            return {
                themeInfo:null,
                params:{},
                pathNames:{
                    list:'/api/auth/me',
                    get:'/api/auth/me',
                    save:'/api/auth/profile'
                },
            }
        },
        computed: {
            ...mapGetters(["row","event", "loading", "rows"])
        },
        created(){


            this.path(this.pathNames);

            this.loadResource();

        },
        methods: {
            ...mapActions(["get", "list", "save", "path"]),
            setValue(event){
                console.log(event)
            },
            loadResource() {

                this.get(this.params);

            },
            formSubmit(){
                let data = new FormData;

                Object.keys(this.row).map(v => {

                    if(undefined === this.row[v].value){
                        data.append(v,'');
                    }
                    else{
                        data.append(v,this.row[v].value)
                    }

                })

                this.saveResource(data);
            },
            saveResource(data){
                this.save(data);
            }
        },
        watch:{
            toast(errors) {
                if (errors != null) {
                    let error = JSON.parse(errors)
                    this.$bvToast.toast(error.msg, {
                        title: error.title || "OPS!!",
                        variant: error.variant,
                        solid: error.solid
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>
