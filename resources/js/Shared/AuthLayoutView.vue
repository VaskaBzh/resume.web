<template>
    <div class="app_back app_back-auth">
        <header-component-auth :errors="errors" :is_auth="auth_user" />
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
            <div class="section">
                <div class="page__container">
                    <div class="page__main">
                        <div class="page__content">
                            <Link :href="route('home')">
                                <img
                                    v-if="!isDark"
                                    src="../../assets/img/logo_high_quality-lg.svg"
                                    alt="logo"
                                />
                                <img
                                    v-else
                                    src="../../assets/img/logo_high_quality-lg-dark.svg"
                                    alt="logo"
                                />
                            </Link>
                            <keep-alive>
                                <slot :errors="errors"></slot>
                            </keep-alive>
                        </div>
                        <div class="page__image">
                            <img
                                v-show="!isDark"
                                src="../../assets/img/auth_img-back.png"
                                alt=""
                            />
                            <img
                                v-show="isDark"
                                src="../../assets/img/auth_img-back-dark.png"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HeaderComponentAuth from "@/Components/HeaderComponentAuth.vue";
import { mapGetters } from "vuex";
import { Link } from "@inertiajs/vue3";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
        message: {
            type: String,
        },
        errors: {
            type: Object,
        },
    },
    components: { HeaderComponentAuth, Link },
    computed: {
        ...mapGetters(["getMessage", "isDark"]),
    },
};
</script>

<style lang="scss" scoped>
.page {
    &__content {
        flex: 1 0 55%;
        @media (max-width: 991.98px) {
            flex: 1 0 100%;
        }
        img {
            margin: 0 0 88px;
            @media (max-width: 991.98px) {
                margin: 100px 0 88px;
            }
            @media (max-width: 767.98px) {
                max-width: 326px;
            }
            @media (max-width: 479.98px) {
                max-width: 146px;
                margin: 80px 0 72px;
            }
        }
    }
    &__main {
        flex-direction: row;
        align-items: flex-start;
    }
    &__image {
        order: 0;
        transform: translateX(-3%);
        img {
            max-width: 1255px;
        }
        @media (max-width: 991.98px) {
            transform: translateX(-40%);
            img {
                max-width: 756px;
            }
        }
        @media (max-width: 767.98px) {
            transform: translateX(-25%);
            img {
                max-width: 600px;
            }
        }
        @media (max-width: 479.98px) {
            transform: translateX(-50%);
            img {
                max-width: 376px;
            }
        }
    }
}
</style>
