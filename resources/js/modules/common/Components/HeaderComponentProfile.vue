<template>
    <nav class="header-content">
        <div>
            <CurrentExchangeRate />
        </div>
        <div class="header-select-container">
            <select-theme
                v-if="viewportWidth >= 991.78"
                :viewportWidth="viewportWidth"
            ></select-theme>
            <select-language
                v-if="viewportWidth >= 991.78"
                :viewportWidth="viewportWidth"
            ></select-language>
        </div>
    </nav>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import NavLinks from "@/modules/navs/Components/NavLinks.vue";
import AccountMenu from "@/Components/UI/profile/AccountMenu.vue";
import { defineComponent, ref } from "vue";
import "swiper/css";
import "swiper/css/pagination";
import { mapGetters } from "vuex";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";
import CurrentExchangeRate from "../../../Components/technical/blocks/CurrentExchangeRate.vue";

export default defineComponent({
    components: {
        NavLinks,
        AccountMenu,
        SelectLanguage,
        SelectTheme,
        CurrentExchangeRate,
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
            let url = this.$route.fullPath.startsWith("http")
                ? new URL(this.$route.fullPath).pathname
                : this.$route.fullPath;
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

<!-- <style lang="scss" scoped>
.nav {
    &__container {
        display: flex;
        align-items: center;
        gap: 5px;
        height: 100%;
    }

    &__buttons {
        display: flex;
        gap: 12px;
        align-items: center;
        margin-left: auto;

        &_mobile {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            margin-left: auto;
            @media (max-width: 991.98px) {
                z-index: 100;
            }
        }
    }

    &__button {
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 150%;
        color: #3f7bdd;
        border-radius: 8px;
        border: 1px solid #3f7bdd;
        background: transparent;
        min-height: 40px;
        padding: 0 24px;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        margin-left: 40px;
        @media (any-hover: hover) {
            &:hover {
                border: 1px solid #c6d8f5;
                background: #c6d8f5;
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

    &__burger {
        background: transparent;
        gap: 4px;
        width: 48px;
        height: 48px;
        transition: all 0.3s ease 0s;
        margin-left: 40px;

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
</style> -->
<style scoped>
.header-content {
    padding: 0 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}
.header-select-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
}
</style>
