<template>
    <div class="layout">
        <div class="nav-container">
            <nav-tabs ref="tabs" :user="user" />
        </div>
        <div>
            <div class="header-container">
            <header-component-profile :user="user" />
            </div>

            <div class="page-container">
                <keep-alive>
                    <slot />
                </keep-alive>
            </div>
        </div>

    </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponentProfile from "@/modules/common/Components/HeaderComponentProfile.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        message: {
            type: String,
        },
    },
    components: {
        // FooterComponent,
        HeaderComponentProfile,
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
.layout {
    width: 100vw;
    height: 100vh;
    background: var(--secondary-white, #fff);
    display: flex;
}
.header-container {
    width: calc(100vw - 320px);
    height: 84px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease 0s;
}
.nav-container {
    width: 320px;
    height: 100vh;
    padding: 0 24px;
}
.page-container {
    padding: 24px;
    border-radius: 40px 0px 0px 0px;
    background: var(--background-first, #f8fafd);
    box-shadow: 0px 1px 4px 0px rgba(16, 24, 40, 0.05) inset;
    top: 84px;
    left: 320px;
    width: calc(100vw - 320px);
    height: calc(100vh - 84px);
}
</style>
