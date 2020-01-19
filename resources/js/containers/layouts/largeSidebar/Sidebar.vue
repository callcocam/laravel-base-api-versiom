<template>
    <div
        class="side-content-wrap"
        @mouseenter="isMenuOver = true"
        @mouseleave="isMenuOver = false"
        @touchstart="isMenuOver = true"
    >
        <vue-perfect-scrollbar
            :settings="{ suppressScrollX: true, wheelPropagation: false }"
            :class="{ open: getSideBarToggleProperties.isSideNavOpen }"
            ref="myData"
            class="sidebar-left rtl-ps-none ps scroll"
        >
            <div>
                <ul class="navigation-left">

                    <Menu icon="i-Dashboard" route="admin.dashboards.index" menu="dashboards" v-on:input="selectedParentMenu = $event" :selected="selectedParentMenu">
                        {{ $t('versionOne') }}
                    </Menu>
                    <Menu icon="i-Office-Lamp" route="admin.settings.company" menu="minha-empresa" v-on:input="selectedParentMenu = $event" :selected="selectedParentMenu">
                        {{ $t('company') }}
                    </Menu>
                    <SubMenu icon="i-Lock" dataItem="operational" menu="operational" v-on:input="toggleSubMenu($event)" :selected="selectedParentMenu">
                        {{ $t('Operational') }}
                    </SubMenu>
                    <SubMenu icon="i-Aim" dataItem="blog" menu="blog" v-on:input="toggleSubMenu($event)" :selected="selectedParentMenu">
                        {{ $t('blog') }}
                    </SubMenu>
                    <Menu icon="i-Find-User" route="admin.user.profile" menu="minha-conta" v-on:input="selectedParentMenu = $event" :selected="selectedParentMenu">
                        {{ $t('profile') }}
                    </Menu>
                </ul>
            </div>
        </vue-perfect-scrollbar>

        <vue-perfect-scrollbar
            :class="{ open: getSideBarToggleProperties.isSecondarySideNavOpen }"
            :settings="{ suppressScrollX: true, wheelPropagation: false }"
            class="sidebar-left-secondary ps rtl-ps-none"
        >
            <div ref="sidebarChild">
                <!-- Submenu Dashboards -->
                <ul
                    class="childNav d-none"
                    data-parent="acl"
                    :class="{ 'd-block': selectedParentMenu == 'operational' }"
                >
                    <li class="nav-item">
                        <router-link tag="a" class :to="{name:'admin.roles.index'}">
                            <i class="nav-icon i-Arrow-Forward-2"></i>
                            <span class="item-name">{{ $t('Roles') }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="a" class :to="{name:'admin.permissions.index'}">
                            <i class="nav-icon i-Arrow-Forward-2"></i>
                            <span class="item-name">{{ $t('Permissions') }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="a" class :to="{name:'admin.middlewares.index'}">
                            <i class="nav-icon i-Arrow-Forward-2"></i>
                            <span class="item-name">{{ $t('Middlewares') }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="a" class :to="{name:'admin.stored-routes.index'}">
                            <i class="nav-icon i-Arrow-Forward-2"></i>
                            <span class="item-name">{{ $t('StoredRoutes') }}</span>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link tag="a" class :to="{name:'admin.translation.index'}">
                            <i class="nav-icon i-Arrow-Forward-2"></i>
                            <span class="item-name">{{ $t('Traductios') }}</span>
                        </router-link>
                    </li>
                </ul>

                <ul
                    class="childNav d-none"
                    data-parent="example"
                    :class="{ 'd-block': selectedParentMenu == 'blog' }"
                >
                    <li class="nav-item">
                        <router-link tag="a" class :to="{name:'admin.blog.index'}">
                            <i class="nav-icon i-Arrow-Forward-2"></i>
                            <span class="item-name">{{ $t('posts') }}</span>
                        </router-link>
                    </li>
                </ul>


            </div>
        </vue-perfect-scrollbar>
        <div
            @click="removeOverlay()"
            class="sidebar-overlay"
            :class="{ open: getSideBarToggleProperties.isSecondarySideNavOpen }"
        ></div>
    </div>
    <!--=============== Left side End ================-->
</template>

<script>
    import Topnav from "./TopNav";
    import Menu from "./patials/Menu";
    import SubMenu from "./patials/SubMenu";
    import { isMobile } from "mobile-device-detect";

    import { mapGetters, mapActions } from "vuex";

    export default {
        components: {
            Topnav,
            SubMenu,
            Menu
        },

        data() {
            return {
                isDisplay: true,
                isMenuOver: false,
                isStyle: true,
                selectedParentMenu: "",
                isMobile
            };
        },
        mounted() {
            this.toggleSelectedParentMenu();
            window.addEventListener("resize", this.handleWindowResize);
            document.addEventListener("click", this.returnSelectedParentMenu);
            this.handleWindowResize();
        },

        beforeDestroy() {
            document.removeEventListener("click", this.returnSelectedParentMenu);
            window.removeEventListener("resize", this.handleWindowResize);
        },
        computed: {
            ...mapGetters(["getSideBarToggleProperties","menus"])
        },

        methods: {
            ...mapActions([
                "changeSecondarySidebarProperties",
                "changeSecondarySidebarPropertiesViaMenuItem",
                "changeSecondarySidebarPropertiesViaOverlay",
                "changeSidebarProperties"
            ]),

            handleWindowResize() {
                //  console.log('not working is Mobile');
                if (window.innerWidth <= 1200) {
                    if (this.getSideBarToggleProperties.isSideNavOpen) {
                        this.changeSidebarProperties();
                    }
                    if (this.getSideBarToggleProperties.isSecondarySideNavOpen) {
                        this.changeSecondarySidebarProperties();
                    }
                } else {
                    if (!this.getSideBarToggleProperties.isSideNavOpen) {
                        this.changeSidebarProperties();
                    }
                }
            },
            toggleSelectedParentMenu() {
                const currentParentUrl = this.$route.path
                    .split("/")
                    .filter(x => x !== "")[1];

                if (currentParentUrl !== undefined || currentParentUrl !== null) {
                    this.selectedParentMenu = currentParentUrl.toLowerCase();
                }
            },
            toggleSubMenu(e) {
                let childrens = this.$refs.sidebarChild.children;
                let parent = e.target.dataset.item;

                this.selectedParentMenu = parent;

                this.changeSecondarySidebarPropertiesViaMenuItem(true);
            },

            removeOverlay() {
                this.changeSecondarySidebarPropertiesViaOverlay();
                if (window.innerWidth <= 1200) {
                    this.changeSidebarProperties();
                }
                this.toggleSelectedParentMenu();
            },
            returnSelectedParentMenu() {
                if (!this.isMenuOver) {
                    this.toggleSelectedParentMenu();
                }
            },

            toggleSidebarDropdwon(event) {
                let dropdownMenus = this.$el.querySelectorAll(".dropdown-sidemenu.open");

                event.currentTarget.classList.toggle("open");

                dropdownMenus.forEach(dropdown => {
                    dropdown.classList.remove("open");
                });
            }
        }
    };
</script>
