<template>
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
</template>
<script>
import NavTabs from "@/Components/navs/NavTabs.vue";
import HeaderComponent from "@/Components/HeaderComponent.vue";
import FooterComponent from "@/Components/FooterComponent.vue";
import { mapGetters } from "vuex";
import { Inertia } from "@inertiajs/inertia";
import axios from "axios";

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
    },
    // mounted() {
    //     Inertia.on("success", (event) => {
    //         if (this.$page.props.message) {
    //             console.log(this.$page.props.message);
    //             const csrfMetaTag = document.querySelector(
    //                 'meta[name="csrf-token"]'
    //             );
    //             if (csrfMetaTag) {
    //                 csrfMetaTag.setAttribute(
    //                     "content",
    //                     event.detail.visit.page.props.newCsrfToken
    //                 );
    //             }
    //         }
    //     });
    // },
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
    @media (max-width: 1280.98px) {
        margin-top: 104px;
    }
    @media (max-width: 767.98px) {
        margin-top: 0;
    }

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
