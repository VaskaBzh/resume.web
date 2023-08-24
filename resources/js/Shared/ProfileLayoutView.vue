<template>
    <div class="app_back app_back-profile">
        <div class="app_back_elem-blur"></div>
        <header-component :user="user" :errors="errors" :is_auth="auth_user" />
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
        <footer-component :errors="errors" />
    </div>
</template>
<script>
import NavTabs from "@/modules/navs/Components/NavTabs.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";
import FooterComponent from "@/Components/FooterComponent.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
        },
        errors: Object,
        message: {
            type: String,
        },
    },
    data() {
        return {
            interval: null,
        };
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
        ]),
    },
    async mounted() {
        if (this.$store.getters.getValid) {
            this.$store.dispatch("getMiningStat");
            this.$store.dispatch("getGraph");
            await this.$store.dispatch("accounts_all", this.user.id);
        }
        this.interval = setInterval(async () => {
            await this.$store.dispatch("accounts_all", this.user.id);
        }, 60000);
        // if (!localStorage.getItem("location")) {
        //     axios.get("/get_location").then((res) => {
        //         localStorage.setItem("location", res.data);
        //     });
        // }
    },
    unmounted() {
        if (!this.auth_user) {
            this.$store.dispatch("destroyer");
        }
        clearInterval(this.interval);
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
