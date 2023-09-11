<template>
    <div class="app_back app_back-profile">
        <div class="app_back_elem-blur"></div>
        <header-component :user="user" />
        <div class="page">
            <teleport to="body">
                <div class="hint">
                    <div class="hint_item" v-hide="this.getMessage !== ''">
                        {{ this.getMessage }}
                    </div>
                    <div class="hint_item" v-hide="this.message !== null">
                        {{ this.message }}
                    </div>
                </div>
            </teleport>
            <div class="observer_block"></div>
            <div class="account">
                <div class="account__container">
                    <nav-tabs ref="tabs" />
                    <keep-alive>
                        <slot />
                    </keep-alive>
                </div>
            </div>
        </div>
        <footer-component />
    </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";
import FooterComponent from "@/Components/FooterComponent.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        message: {
            type: String,
        },
    },
    components: {
        FooterComponent,
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
<style lang="scss">
.account {
    margin-top: 40px;
    @media (max-width: 767.98px) {
        margin-top: 32px;
    }
    @media (max-width: 479.98px) {
        margin-top: 24px;
    }

    &__container {
        display: flex;
        justify-content: space-between;
        position: relative;
    }
}
</style>
