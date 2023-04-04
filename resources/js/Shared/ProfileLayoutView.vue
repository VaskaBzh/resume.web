<template>
    <header-component :is_auth="auth_user" />
    <div class="hidden">{{ this.allAccounts }}</div>
    <div class="page">
        <blue-button class="feedback">
            <a class="all-link" href="mailto:support@all-btc.com"
                >Обратная связь</a
            >
        </blue-button>
        <div class="observer_block"></div>
        <div class="account">
            <div class="account__container">
                <nav-tabs ref="tabs" />
                <slot
                    class="padding"
                    :histotyForDays="this.allHistoryForDays"
                    :histoty="this.allHistory"
                    :accounts="this.allAccounts"
                    :hash="this.allHash"
                />
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
import BlueButton from "@/Components/UI/BlueButton.vue";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        BlueButton,
        FooterComponent,
        HeaderComponent,
        NavTabs,
    },
    computed: {
        ...mapGetters([
            "allHistoryForDays",
            "allAccounts",
            "allHistory",
            "allHash",
            "getActive",
        ]),
    },
    async created() {
        if (this.$store.getters.getValid) {
            this.$store.dispatch("getConverter");
            this.$store.dispatch("getInfo");
            await this.$store.dispatch("getAccounts");
        }
    },
    unmounted() {
        if (!this.auth_user) {
            this.$store.commit("destroy_force");
        }
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
