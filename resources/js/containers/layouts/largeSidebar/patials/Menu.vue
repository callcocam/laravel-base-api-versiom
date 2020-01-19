<template>
    <li
        @mouseenter="setInput()"
        @mouseleave="toggleSelectedParentMenu()"
        class="nav-item"
        :class="{ active: selectedMenu == menu }"
    >
        <router-link tag="a" class="nav-item-hold" :to="getRoute()">
            <i :class="getIcon()"></i>
            <span class="item-name"> <slot></slot></span>
        </router-link>
        <div class="triangle"></div>
    </li>
</template>

<script>
    import {  mapActions } from "vuex";
    export default {
        name: "Menu",
        props:['selected','route','icon','selectedParentMenu', "menu"],
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
            setInput(){

                this.$emit('input' , this.menu)
            },
            getIcon(){
                return `nav-icon ${this.icon}`
            },
            getRoute(){
                if(typeof this.route == "string"){
                    return {
                        name: this.route
                    }
                }
                return this.route
            }
        }
    }
</script>

<style scoped>

</style>
