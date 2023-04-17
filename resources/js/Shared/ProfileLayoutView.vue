<template>
    <header-component :is_auth="auth_user" />
    <div class="page">
        <div class="observer_block"></div>
        <div class="account">
            <div class="account__container">
                <nav-tabs ref="tabs" />
                <keep-alive>
                    <slot
                        :histotyForDays="this.allIncomeHistory"
                        :histoty="this.allHistory"
                        :accounts="this.allAccounts"
                        :hash="this.allHash"
                    />
                </keep-alive>
            </div>
        </div>
    </div>
    <footer-component />
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
    margin-top: 32px;

    &__container {
        display: flex;
        justify-content: space-between;
        position: relative;

        .padding {
            @media (min-width: 1271px) {
                padding-left: 330px;
            }
        }
    }
}
</style>
