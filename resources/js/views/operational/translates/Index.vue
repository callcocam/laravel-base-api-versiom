<template>
    <div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <h4>{{ $t('List Translate')}}</h4>
                <p>{{ $t('List Translate, admin panel')}}.</p>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-md-9">
                                <input v-model="configs.filter" class="form-control" type="text" :placeholder="$t('Term')">
                            </div>
                            <div class="col-md-3 mt-3 mt-md-0">
                                <button class="btn btn-primary btn-block">{{ $t('search') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row row-xs">
                            <div class="col-md-5">
                                <ValidationProvider vid="key" name="key" v-slot="{ errors }">
                                    <b-form-group>
                                        <b-form-input v-model="form.key" placeholder="Key Value"></b-form-input>
                                    </b-form-group>
                                </ValidationProvider>
                            </div>
                            <div class="col-md-5 mt-3 mt-md-0">
                                <ValidationProvider vid="value" name="value" v-slot="{ errors }">
                                    <b-form-group>
                                        <b-form-input v-model="form.value" placeholder="Traducing Value"></b-form-input>
                                    </b-form-group>
                                </ValidationProvider>
                            </div>
                            <div class="col-md-2 mt-3 mt-md-0">
                                <button class="btn btn-success btn-block" @click="submitTranslate(form)">Add translate</button>
                            </div>
                        </div>
                        <template v-if="repos">
                            <template v-for="(row, index) in repos">
                                <div class="row row-xs mt-3" v-if="row.value" :key="index">
                                    <div class="col-md-4">
                                        <ValidationProvider vid="key" name="key" v-slot="{ errors }">
                                            <b-form-input v-model="row.key" placeholder="Key Value"></b-form-input>
                                        </ValidationProvider>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <ValidationProvider vid="value" name="value" v-slot="{ errors }">
                                            <b-form-input v-model="row.value" placeholder="Traducing Value"></b-form-input>
                                        </ValidationProvider>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <button class="btn btn-primary btn-block" @click="submitTranslate(row)">Update translate</button>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <button class="btn btn-danger btn-block" @click="deleteTranslate(row)">Delete translate</button>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    import AbstractList from "@/components/AbstractList";
    import { orderBy, isEmpty } from 'lodash';
    import filterByName from '@/helpers/filters/by-name';
    export default {
        extends: AbstractList,
        name: "Translate",
        data(){
            return {
                configs: {
                    by: 'key',
                    order: 'desc',
                    filter: ''
                },
                params:{},
                form:{
                    key:'',
                    value:''
                },
                pathNames:{
                    list:'/api/admin/settings/translation',
                    get:'/api/admin/settings/translation',
                    delete:'/api/admin/settings/translation/id',
                    save:'/api/admin/settings/translation'
                },
            }
        },
        methods:{
            submitTranslate(form){

                let data = new FormData;

                data.append('key',form.key);

                data.append('value',form.value);

                this.save(data);

                this.form.key = ''

                this.form.value = ''


            },
            deleteTranslate(form){

                this.deleteResource(form.key);

            }
        },
        computed:{
            listOrdened() {
                const { by, order } = this.configs;

                return orderBy(this.event, by, order);
            },
            repos() {
                const filter = this.configs.filter;
                if (isEmpty(filter)) {
                    return this.listOrdened;
                }

                return filterByName(this.listOrdened, filter);
            }
        },
        watch:{
            event(val){

                if(val){

                    return val

                }

            }
        }

    }
</script>
