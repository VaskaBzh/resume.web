<template>
    <div class="app_back app_back-auth">
        <header-component-auth :errors="errors" :is_auth="auth_user" />
        <div class="page auth">
            <teleport to="body">
                <div class="hint">
                    <div class="hint_item" v-hide="this.getMessage !== ''">
                        {{ this.getMessage }}
                    </div>
                    <div class="hint_item" v-hide="this.message !== null">
                        {{ this.message }}
                    </div>
                </div></teleport
            >
            <div class="observer_block"></div>
            <div class="auth__con">
                <div class="page__container">
                    <div class="auth__main">
                        <div class="page__content">
                            <router-link :to="{ name: 'home' }">
                                <img
                                    v-show="!isDark"
                                    src="../../assets/img/logo_high_quality-lg.svg"
                                    alt="logo"
                                />
                                <img
                                    v-show="isDark"
                                    src="../../assets/img/logo_high_quality-lg-dark.svg"
                                    alt="logo"
                                />
                            </router-link>
                            <keep-alive>
                                <slot :errors="errors"></slot>
                            </keep-alive>
                        </div>
                        <div class="page__image">
                            <img
                                v-show="!isDark"
                                src="../../assets/img/graph_img-back.svg"
                                alt=""
                            />
                            <img
                                v-show="isDark"
                                src="../../assets/img/graph_img-back-dark.svg"
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
.page.auth {
    padding: 0;
}
.auth {
    display: flex;
    justify-content: center;
    // .auth__con
    &__con {
        & .page {
            // .page__container
            &__container {
                height: 100%;
            }
            // .page__content
            &__content {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                flex: 1 0 40%;
                z-index: 2;

                & a {
                    display: block;
                    margin-bottom: 88px;
                    @media (max-width: 1550px) {
                        margin-bottom: 48px;
                        & img {
                            max-width: 300px;
                        }
                    }
                    @media (max-width: 991.98px) {
                        text-align: center;
                    }
                    @media (max-width: 767.98px) {
                        & img {
                            max-width: 250px;
                        }
                    }
                    @media (max-width: 479.98px) {
                        & img {
                            max-width: 150px;
                        }
                    }
                }
            }
            // .page__image
            &__image {
                position: fixed;
                left: 47vw;
                top: 50%;
                transform: translate(0, -50%);
                & img {
                    max-width: unset;
                }
                @media (max-width: 1550px) {
                    & img {
                        max-width: 1000px;
                    }
                }
                @media (max-width: 991.98px) {
                    display: none;
                }
            }
        }
    }
    // .auth__main
    &__main {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        padding: 56px 0 100px;
        gap: 100px;
        position: relative;
        &::after {
            content: "";
            flex: 1 0 auto;
            min-width: 1000px;
            @media (max-width: 991.98px) {
                display: none;
            }
        }

        @media (max-width: 1550px) {
            padding: 40px 0 56px;
        }
        @media (max-width: 991.98px) {
            gap: 0;
            justify-content: start;
        }
    }
}
</style>
