<template>
    <li
        @mouseenter="setInput($event)"
        @mouseleave="toggleSelectedParentMenu()"
        class="nav-item"
        :class="{ active: selectedMenu == menu }"
        :data-item="dataItem"
    ><router-link tag="a" class="nav-item-hold" to="#">
            <i :class="getIcon()"></i>
            <span class="item-name"> <slot></slot></span>
        </router-link>
        <div class="triangle"></div>
    </li>
</template>

<script>
    import {  mapActions } from "vuex";
    export default {
        name: "SubMenu",
        props:['selected','icon','selectedParentMenu', "menu", "dataItem"],
        data(){
            return {
                selectedMenu:''
            }
        },
        mounted() {
            this.returnSelectedParentMenu();
            document.addEventListener("click", this.returnSelectedParentMenu);
        },
        beforeDestroy() {
            document.removeEventListener("click", this.returnSelectedParentMenu);
        },
        watch:{
            selected(val){
                this.selectedMenu = val
            }
        },
        methods:{
            toggleSelectedParentMenu() {
                const currentParentUrl = this.$route.path
                    .split("/")
                    .filter(x => x !== "")[1];

                if (currentParentUrl !== undefined || currentParentUrl !== null) {
                    this.selectedMenu = currentParentUrl.toLowerCase();
                } else {
                    this.selectedMenu =  this.menu;
                }
            },
            returnSelectedParentMenu() {
                this.toggleSelectedParentMenu();
            },
            setInput(event){

                this.$emit('input' , event)
            },
            getIcon(){
                return `nav-icon ${this.icon}`
            }
        }
    }
</script>

<style scoped>

</style>
