<template>
    <nav class="nav__container">
        <Link :href="route('home')">
            <img
                v-if="!getTheme"
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality.svg"
                alt="logo"
            />
            <img
                v-else
                class="nav__logo headder"
                src="../../assets/img/logo_high_quality-dark.svg"
                alt="logo"
            />
        </Link>

        <teleport to="body" :disabled="viewportWidth >= 991.98">
            <nav-links
                @closed="burgerClose"
                :is_auth="is_auth"
                :viewportWidth="viewportWidth"
                :is_open="is_open"
                :errors="errors"
            />
        </teleport>

        <div class="nav__buttons" v-show="viewportWidth >= 991.78">
            <select-language
                v-if="viewportWidth >= 991.78"
                :viewportWidth="viewportWidth"
            ></select-language>
            <select-theme
                v-if="viewportWidth >= 991.78"
                :viewportWidth="viewportWidth"
            ></select-theme>

            <account-menu
                :errors="errors"
                :viewportWidth="viewportWidth"
                v-if="is_auth && accountLink"
            ></account-menu>
            <Link
                :href="route('login')"
                v-show="viewportWidth >= 991.98 && !is_auth"
                class="nav__button"
                @mousedown="this.linkChanger"
            >
                {{ $t("header.login_button") }}
            </Link>
            <Link
                :href="route('statistic')"
                v-show="viewportWidth >= 991.98 && !accountLink && is_auth"
                class="nav__button"
                @mousedown="this.linkChanger"
            >
                {{ $t("header.login_button") }}
            </Link>
        </div>

        <div v-show="viewportWidth < 991.98" class="nav__buttons_mobile">
            <select-language
                v-show="viewportWidth > 479.98"
                :viewportWidth="viewportWidth"
            ></select-language>
            <select-theme
                v-show="viewportWidth > 479.98"
                :viewportWidth="viewportWidth"
            ></select-theme>
            <div
                @click="burgerAction"
                class="nav__burger"
                :class="{ active: is_open }"
            >
                <div class="nav__burger_con">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link, useForm } from "@inertiajs/vue3";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import NavLinks from "@/Components/navs/NavLinks.vue";
import AccountMenu from "@/Components/UI/profile/AccountMenu.vue";
import { defineComponent, ref } from "vue";
import "swiper/css";
import "swiper/css/pagination";
import { mapGetters } from "vuex";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";

export default defineComponent({
    components: {
        Link,
        NavLinks,
        AccountMenu,
        SelectLanguage,
        SelectTheme,
    },
    data() {
        return {
            is_open: false,
            viewportWidth: 0,
        };
    },
    props: {
        is_auth: {
            type: Boolean,
            default: false,
        },
        user: {
            type: Object,
        },
        errors: {
            type: Object,
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    setup() {
        let message = ref("");
        let noInfo = ref(false);
        let closed = ref(false);

        const form = useForm({
            email: "",
            password: "",
            remember: false,
        });

        // const reverify = () => {
        //     form.post("/reverify", {});
        // };

        return {
            runCallbacksOnInit: {},
            form,
            message,
            noInfo,
            closed,
        };
    },
    computed: {
        ...mapGetters(["getIncome", "allAccounts", "getActive", "getTheme"]),
        accountLink() {
            let url = this.$page.url.startsWith("http")
                ? new URL(this.$page.url).pathname
                : this.$page.url;
            return url.startsWith("/profile");
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        burgerAction() {
            if (this.viewportWidth < 991.98) {
                this.is_open = !this.is_open;
                this.is_open
                    ? (document.querySelector("body").style.overflowY =
                          "hidden")
                    : (document.querySelector("body").style.overflowY = "auto");
            }
        },
        burgerClose() {
            if (this.viewportWidth < 991.98) {
                this.is_open = false;
                document.querySelector("body").style.overflowY = "auto";
            }
        },
    },
});
</script>

<style lang="scss" scoped>
.all-link {
    padding: 2px 40px;
}
.nav__logo {
    max-width: 170px;
    @media (max-width: 991.98px) {
        &.headder {
            position: relative;
            z-index: 100;
        }
    }
    @media (max-width: 479.98px) {
        max-width: 138px;
    }
}
nav.nav__container {
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 21px 0;
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%) translateY(0);
    &:before {
        transition: all 0.3s ease 0s;
        left: 50%;
        content: "";
        transform: translateX(-50%);
        top: 0;
        width: 100vw;
        height: 84px;
        z-index: -1;
        position: fixed;
        background: #eef1f5;
        box-shadow: 0 8px 24px rgba(129, 135, 189, 0.15);
    }
    @media (min-width: 1320.98px) {
        transition: all 0.3s ease 0s;
        width: 100vw;
        z-index: 100;
    }
    @media (max-width: 991.98px) {
        position: fixed;
        left: 50%;
        top: 0;
        transform: translate(-50%, 0);
        gap: 15px;
        height: 80px;
        width: 100vw;
        padding: 16px 0;
        &::before {
            content: "";
            position: absolute;
            z-index: 100;
            width: 100vw;
            height: 100%;
            top: 0;
            left: 50%;
            transform: translate(-50%, 0);
            filter: drop-shadow(0px 1px 1px rgba(0, 0, 0, 0.1));
            background: linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        }
    }
    @media (max-width: 767.98px) {
        padding: 16px 15px;
    }
    @media (max-width: 479.98px) {
        padding: 13px 16px;
        height: 59px;
        &:before {
            box-shadow: 0px 8px 24px 0px rgba(129, 135, 189, 0.15);
        }
    }
}

.nav__buttons_mobile {
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    z-index: 100;

    & .nav__burger {
        background: transparent;
        border-radius: 14px;
        gap: 4px;
        width: 38px;
        height: 38px;
        transition: all 0.3s ease 0s;
        margin-left: 28px;
        @media (max-width: 767.98px) {
            margin-left: 48px;
        }
        @media (max-width: 479.98px) {
            margin-left: 0;
        }

        &:active {
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.25);
        }

        &_con {
            margin: 0 auto;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 4px;
            width: 18px;
            overflow: hidden;
        }

        & span {
            display: block;
            width: 18px;
            height: 2px;
            flex: 0 0 2px;
            background-color: #4182ec;
            border-radius: 5px;
            position: relative;
            right: 0;
            transition: all 0.3s ease 0.3s;

            &:nth-child(2) {
                transition: all 0.3s ease 0s;

                &::before {
                    transition: all 0.3s ease 0s;
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: #4182ec;
                }
            }
        }

        &.active {
            & span {
                &:nth-child(1) {
                    transition: all 0.3s ease 0s;
                    right: 100%;
                }

                &:nth-child(2) {
                    transition: all 0.3s ease 0.3s;
                    transform: rotate(45deg);

                    &::before {
                        transition: all 0.3s ease 0.3s;
                        transform: rotate(-90deg);
                    }
                }

                &:nth-child(3) {
                    transition: all 0.3s ease 0s;
                    right: -100%;
                }
            }
        }
    }
}
.nav__buttons {
    display: flex;
    gap: 12px;
    align-items: center;
    .button,
    .nav__button {
        margin-left: 28px;
        @media (max-width: 767.98px) {
            margin-left: 48px;
        }
    }
}
.nav__button {
    font-style: normal;
    font-weight: 400;
    font-size: 17px;
    line-height: 143.1%;
    color: #3f7bdd;
    background: rgba(194, 213, 242, 0.61);
    border-radius: 14px;
    padding: 11px 36px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    cursor: pointer;
    @media (any-hover: hover) {
        &:hover {
            background: rgba(194, 213, 242);
        }
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 14px;
        min-width: 65px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        &:hover {
            background: rgba(194, 213, 242);
        }
    }
    &_link {
        padding: 0 20px;
        width: 100%;
        height: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
}
.nav__button {
    font-style: normal;
    font-weight: 400;
    color: #3f7bdd;
    background: transparent;
    border: 1px solid #3f7bdd;
    padding: 8px 24px;
    white-space: nowrap;
    transition: all 0.3s ease 0s;
    border-radius: 8px;
    font-size: 17px;
    line-height: 140%;
    @media (any-hover: hover) {
        &:hover {
            background: #c6d8f5;
            border: 1px solid #c6d8f5;
        }
    }

    &_mobile {
        background: rgba(194, 213, 242, 0.61);
        border-radius: 5px;
        width: 60px;
        height: 45px;
        display: flex;
        justify-content: center;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        @media (any-hover: hover) {
            &:hover {
                background: rgba(194, 213, 242);
            }
        }
    }
}
</style>
