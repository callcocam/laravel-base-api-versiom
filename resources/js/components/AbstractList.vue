<template>
    <div class="card user-profile o-hidden mb-4">
        <component v-if="themeInfo" :is="themeInfo"></component>
        <div class="card-body" v-if="!loading">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <b-table striped hover
                             ref="selectableTable"
                             :items="rows.items"
                             :fields="rows.headers"
                             :sort-by.sync="sortBy"
                             :sort-desc.sync="sortDesc"
                             :select-mode="selectMode"
                             :busy="loading"
                             @row-selected="onRowSelected"
                             responsive="sm"
                             sort-icon-left
                             selectable
                    >
                        <template v-slot:head(id)="data">
                            <b-form-checkbox @change="selectAllRows"> Select All</b-form-checkbox>
                        </template>

                        <template v-slot:cell(id)="data">
                            <b-form-checkbox v-model="selected" :value="data.item.id" size="lg"></b-form-checkbox>
                        </template>
                        <template v-slot:cell(name)="data">
                            {{ data.item.name }}
                        </template>
                        <template v-slot:cell(status)="data">
                            <b-badge v-if="data.item.status == 'published'" href="#" variant="success">Success</b-badge>
                            <b-badge v-else href="#" variant="danger">Danger</b-badge>
                        </template>
                        <template v-slot:cell(actions)="data">
                            <b-button-group size="sm">
                                <b-button pill variant="outline-success">Edit</b-button>
                                <b-button pill variant="outline-danger">Delete</b-button>
                            </b-button-group>
                        </template>

                        <template v-slot:cell(id)="{ rowSelected }">
                            <template v-if="rowSelected">
                                <span aria-hidden="true">&check;</span>
                                <span class="sr-only">Selected</span>
                            </template>
                            <template v-else>
                                <span aria-hidden="true">&nbsp;</span>
                                <span class="sr-only">Not selected</span>
                            </template>
                        </template>

                        <template v-slot:table-busy>
                            <div class="text-center text-danger my-2">
                                <b-spinner class="align-middle"></b-spinner>
                                <strong>Loading...</strong>
                            </div>
                        </template>
                    </b-table>

                    <div>
                        Sorting By: <b>{{ sortBy }}</b>, Sort Direction:
                        <b>{{ sortDesc ? 'Descending' : 'Ascending' }}</b>
                    </div>
                    <b-pagination
                        v-model="rows.options.currentPage"
                        :total-rows="rows.options.total"
                        :per-page="rows.options.itemPerPage"
                        class="mt-4"
                    ></b-pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from "vuex";

    export default {
        name: "AbstractList",
        data(){
            return {
                selectMode: 'multi',
                selected: [],
                sortBy: 'age',
                sortDesc: false,
                themeInfo:null,
                params:{},
                pathNames:{
                    list:'/api/auth/me',
                    get:'/api/auth/me',
                    delete:'/api/auth/id',
                    save:'/api/auth/profile'
                },
            }
        },
        computed: {
            ...mapGetters(["row","event", "loading", "rows", "toast"])
        },
        created(){


            this.path(this.pathNames);

            this.loadResource();

        },
        methods: {
            ...mapActions(["get", "list", "save", "path", "delete"]),
            setValue(event){
                console.log(event)
            },
            loadResource() {

                this.list(this.params);

            },
            deleteResource(id){

                this.pathNames.delete = this.pathNames.delete.replace('id', id)

                this.path(this.pathNames);

                this.delete(this.params)

                this.pathNames.delete = this.pathNames.delete.replace(id, 'id')

                this.path(this.pathNames);
            },
            onRowSelected(items) {
                this.selected = items
            },
            selectAllRows(event) {
                if(event){
                    this.$refs.selectableTable.selectAllRows()
                }
                else{
                    this.$refs.selectableTable.clearSelected()
                }

            },
        },
        watch: {
            selected(newVal, oldVal) {
                // Handle changes in individual flavour checkboxes
                if (newVal.length === 0) {
                    this.allSelected = false
                } else if (newVal.length === this.rows.items.itemPerPage) {
                    this.allSelected = true
                } else {
                    this.allSelected = false
                }
            }
        }
    }
</script>

<style scoped>

</style>
