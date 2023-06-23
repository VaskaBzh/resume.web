<template>
    <div class="app_back">
        <header-component :is_auth="auth_user" />
        <div class="page">
            <div class="hint">
                <div class="hint_item" v-hide="this.getMessage !== ''">
                    {{ this.getMessage }}
                </div>
                <div class="hint_item" v-hide="this.message !== null">
                    {{ this.message }}
                </div>
            </div>
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
import NavTabs from "@/Components/navs/NavTabs.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";
import FooterComponent from "@/Components/FooterComponent.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
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
    async created() {
        if (this.$store.getters.getValid) {
            this.$store.dispatch("getConverter");
            await this.$store.dispatch("getAccounts");
        }
        this.interval = setInterval(() => {
            this.$store.dispatch("getAccounts");
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
    margin-top: 20px;
    @media (max-width: 991.98px) {
        margin-top: 0;
    }

    &__container {
        display: flex;
        justify-content: space-between;
        position: relative;
    }
}
</style>
