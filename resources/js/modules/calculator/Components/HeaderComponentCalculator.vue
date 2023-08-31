<template>
    <header class="header header-calculator">
        <nav class="header-calculator__container">
            <div class="header-calculator__main">
                <div class="header-calculator__content">
                    <Link href="/home">
                        <img
                            class="calculator__logo"
                            src="@/../assets/img/logo_high_quality-dark.svg"
                            alt="logo"
                        />
                    </Link>
                    <nav-links-burger
                        @closed="burgerClose"
                        :is_auth="is_auth"
                        :viewportWidth="viewportWidth"
                        :is_open="is_open"
                        :errors="errors"
                    />
                    <div class="header-calculator__buttons">
                        <select-language
                            :viewportWidth="viewportWidth"
                        ></select-language>
                        <div
                            @click="burgerAction"
                            class="nav__burger calculator__burger"
                            :class="{ 'nav__burger-active': is_open }"
                        >
                            <div class="nav__burger_con">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-calculator__content">
                    <Link
                        href="/login"
                        v-show="viewportWidth >= 991.98 && !is_auth"
                        class="header-calculator_button"
                    >
                        {{ $t("header.login_button") }}
                    </Link>
                    <Link
                        href="/statistic"
                        v-show="viewportWidth >= 991.98 && !accountLink && is_auth"
                        class="header-calculator_button"
                    >
                        {{ $t("header.login_button") }}
                    </Link>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import { mapGetters } from "vuex";
import NavLinksBurger from "../../navs/Components/NavLinksBurger.vue";

export default {
    name: "header-component-auth",
    components: {
        Link,
        SelectLanguage,
        NavLinksBurger,
    },
    computed: {
        ...mapGetters(["getTheme"]),
        accountLink() {
            let url = this.$page.url.startsWith("http")
                ? new URL(this.$page.url).pathname
                : this.$page.url;
            return url.startsWith("/profile");
        },
    },
    data() {
        return {
            is_clicked: false,
            viewportWidth: 0,
            is_reg: false,
            is_open: false,
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
        theme: Boolean,
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        burgerAction() {
            this.is_open = !this.is_open;
            this.is_open
                ? (document.querySelector("body").style.overflowY = "hidden")
                : (document.querySelector("body").style.overflowY = "auto");
        },
        burgerClose() {
            this.is_open = false;
            document.querySelector("body").style.overflowY = "auto";
        },
    },
};
</script>

<style lang="scss" scoped>
.header {
    &-calculator {
        width: 100%;
        padding: 53px 0;
        z-index: 1;
        margin-bottom: 80px;
        &__container {
            max-width: 100%;
        }
        &__content {
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1;
        }
        &__main {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        &__buttons {
            display: flex;
            gap: 32px;
        }
        &__burger {
            cursor: pointer;
        }
        &_button {
            border-radius: 8px;
            border: 1px solid #f5faff;
            color: #f5faff;
            font-family: Ubuntu, serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 150%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 14.5px;
            min-height: 40px;
            margin-left: auto;
        }
    }
}
</style>
