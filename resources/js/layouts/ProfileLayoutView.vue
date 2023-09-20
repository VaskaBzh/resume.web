<template>
    <div class="layout">
        <nav-tabs ref="tabs" />
        <div class="layout__content">
            <header-component-profile class="header-container" />

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
    width: 100%;
    min-height: 100vh;
    height: 100%;
    background: var(--background-bg, #fff);
    display: flex;
}
.layout__content {
    width: 100%;
    display: flex;
    flex-direction: column;
}
.header-container {
    width: 100%;
    min-height: 84px;
    display: flex;
    align-items: center;
    transition: all 0.3s ease 0s;
}
.page-container {
    padding: 24px;
    border-radius: 40px 0px 0px 0px;
    background: var(--background-first, #f8fafd);
    box-shadow: 0px 1px 4px 0px rgba(16, 24, 40, 0.05) inset;
    width: 100%;
    height: 100%;
    flex: 1 1 auto;
}
</style>
