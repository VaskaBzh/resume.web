<template>
    <div class="app_back">
        <!--        <main-preloader></main-preloader>-->
        <header-component :user="user" />
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
            <keep-alive>
                <slot></slot>
            </keep-alive>
        </div>
        <footer-component />
    </div>
</template>

<script>
import FooterComponent from "@/Components/FooterComponent.vue";
import HeaderComponent from "@/modules/common/Components/HeaderComponent.vue";
import { mapGetters } from "vuex";

export default {
    props: {
        message: {
            type: String,
        },
    },
    components: { HeaderComponent, FooterComponent },
    computed: {
        ...mapGetters(["getMessage", "allAccounts", "user"]),
    },
    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
};
</script>

<style lang="scss">
.page {
    z-index: 1;
}
.nav__logo {
    max-width: 170px;
    @media (max-width: 767.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
        max-width: 138px;
    }
}

.swiper {
    padding-bottom: 48px !important;

    .swiper-pagination {
        .swiper-pagination-bullet {
            position: relative;
            width: 21px;
            height: 21px;
            overflow: hidden;
            opacity: 1;
            background: transparent;
            border-radius: 3px;

            &::before {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                border: 5px solid rgba(63, 123, 222, 0.16);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            &::after {
                content: "";
                position: absolute;
                width: 100%;
                height: 100%;
                border: 8px solid #3f7bde;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                transition: all 0.3s ease 0s;
                opacity: 0;
                visibility: hidden;
            }

            &.swiper-pagination-bullet-active {
                &::after {
                    opacity: 1;
                    visibility: visible;
                }
            }
        }
    }
}
</style>
