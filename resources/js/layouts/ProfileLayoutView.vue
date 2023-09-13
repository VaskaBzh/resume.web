<template>
    <div class="layout">
        <div class="header-container">
            <header-component :user="user" />
        </div>
        <div class="nav-container">
            <nav-tabs ref="tabs" :user="user"/>
        </div>
            <div class="page-container">
                <keep-alive>
                   <slot />
                </keep-alive>
            </div>
        </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        message: {
            type: String,
        },
    },
    components: {
        // FooterComponent,
        HeaderComponent,
        NavTabs,
    },
    computed: {
        ...mapGetters([
            "allIncomeHistory",
            "allAccounts",
            "allHistory",
            "allHash",
            "getActive",
            "getMessage",
            "user",
        ]),
    },
};
</script>
<style scoped>
.layout{
    width: 100vw;
    height: 100vh;
    background: var(--secondary-white, #FFF);
}
.header-container{
    width: calc(100vw - 320px);
    height: 84px;
    position: fixed;
    display: flex;
    align-items: center;
    top: 0;
    right: 0;
    transition: all 0.3s ease 0s;
}
.nav-container{
    width: 320px;
    height: 100vh;
    padding: 0 24px;
    position: fixed;
    top: 0px;
    left: 0px;
}
.page-container{
    position: fixed;
    padding: 24px;
    border-radius: 40px 0px 0px 0px;
    background: var(--background-first, #F8FAFD);
    box-shadow: 0px 1px 4px 0px rgba(16, 24, 40, 0.05) inset;
    top: 84px;
    left: 320px;
    width: calc(100vw - 320px);
    height: calc(100vh - 84px);
}
</style>
