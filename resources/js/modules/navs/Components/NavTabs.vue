<template>
    <div class="nav" :class="[isOpenBurger? 'open-burger' : 'close-burger']">
            <div class="nav__block">
            <logo-block class="nav_logo" />
            <div class="header-select-container">
                <select-theme
                ></select-theme>
                <select-language></select-language>
            </div>
            <div class="nav__tabs" >
                <account-menu
                    :viewportWidth="viewportWidth"
                    :user="user"
                ></account-menu>
                <nav class="nav__column">
                    <nav-group
                        v-for="(group, i) in service.links"
                        :group="group"
                        :key="i"
                    />
                </nav>
            </div>
        </div>
        <logout-link class="nav_logout" />
    </div>
    <div class="nav-bg-mobile" :class="[isOpenBurger? 'open-bg' : 'close-bg']" @click="$emit('changeBurger', !isOpenBurger)">
    </div>
</template>
<script>
import { TabsService } from "@/modules/navs/services/TabsService";
import { mapGetters } from "vuex";
import AccountMenu from "@/modules/common/Components/UI/AccountMenu.vue";
import { defineComponent } from "vue";
import LogoBlock from "@/modules/navs/Components/blocks/LogoBlock.vue";
import LogoutLink from "@/modules/navs/Components/UI/LogoutLink.vue";
import NavGroup from "@/modules/navs/Components/UI/NavGroup.vue";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";

export default defineComponent({
    components: {
        LogoutLink,
        AccountMenu,
        LogoBlock,
        NavGroup,
        SelectLanguage,
        SelectTheme
    },
    props:{
        isOpenBurger: {
            type: Boolean,
        }
    },
    data() {
        return {
            service: new TabsService(),
        };
    },
    mounted() {
        this.service.setLinks(this.user);
    },
    unmounted() {
        this.service.dropLinks();
    },
    computed: {
        ...mapGetters(["user", "viewportWidth"]),
    },
});
</script>
<style scoped>
.nav {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    min-height: 100vh;
    width: 320px;
    padding: 40px 16px 16px;
}
.header-select-container{
    display: none;
}

@media(max-width:900px){
    .nav {
        position: fixed;
        right: 0;
        top: 71px;
        padding: 20px 24px 24px;
        z-index: 100;
        background: var(--background-island);
        box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
        display: none;
    }
    .header-select-container{
        display: flex;
        justify-content: space-between;
        margin-bottom: 24px;
    }
    .nav_logo{
        display: none;
    }
    .nav-bg-mobile{
        position: fixed;
        background: rgba(0, 0, 0, 0.15);
        left: 0;
        right: 0;
        bottom: 0;
        top:71px;
        display: none;
    }
    .open-burger{
        display: inline-block;
        animation: openBurger 0.4s linear;
    }
    @keyframes openBurger{
        0%{
            transform: translateX(350px);
        }
        100%{
            transform: translateX(0px);
        }
    }
    .close-burger{
        animation: closeBurger 0.4s linear;
    }
    @keyframes closeBurger{
        0%{
        display: inline-block;

            transform: translateX(0px);
        }
        100%{
            transform: translateX(350px);
            display: none;
        }
    }
    .open-bg{
        display: inline-block;
        transition: all 0.3s linear;
    }
}
.nav_logo {
    margin: 0 0 40px 16px;
}
</style>
