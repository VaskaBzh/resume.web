<template>
    <nav class="nav__container">
        <div class="back" @click="back">
            <div class="back_link">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M14 18L8 12L14 6"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
            </div>
            {{ this.$t("back") }}
        </div>
        <div class="nav__buttons">
            <select-language :viewportWidth="viewportWidth"></select-language>
            <select-theme :viewportWidth="viewportWidth"></select-theme>
        </div>
    </nav>
</template>

<script>
import { router } from "@inertiajs/vue3";
import SelectLanguage from "@/Components/technical/language/SelectLanguage.vue";
import SelectTheme from "@/Components/technical/theme/SelectTheme.vue";

export default {
    name: "header-component-auth",
    components: {
        SelectLanguage,
        SelectTheme,
    },
    data() {
        return {
            is_clicked: false,
            viewportWidth: 0,
            is_reg: false,
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
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
        back() {
            if (window.history.state !== "") {
                window.history.back();
            } else {
                router.visit("/home");
            }
        },
    },
};
</script>

<style lang="scss" scoped>
#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    overflow: hidden;
    background: linear-gradient(
        179.87deg,
        #e6eaf0 1.02%,
        #e6eaf1 4.79%,
        #e7ebf1 8.76%,
        #eaeef4 14.75%,
        #e8ecf2 19.07%
    );
    width: 100vw;
}

nav.nav__container {
    z-index: 100;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 115px;
    width: 100%;
    box-sizing: border-box !important;
    padding: 22px 0;
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%) translateY(0);
    @media (min-width: 1271px) {
        transition: all 0.3s ease 0s;
        width: 100vw;
    }
    @media (max-width: 1270px) {
        padding: 21px 0;
        gap: 20px;
    }
    @media (max-width: 991.98px) {
        padding: 20px 15px 15px;
        position: fixed;
        left: 50%;
        top: 0;
        transform: translate(-50%, 0);
        gap: 15px;
        height: 64px;
        width: 100vw;
    }
}

.nav__buttons {
    display: flex;
    gap: 12px;
    align-items: center;
    .button {
        margin-left: 28px;
    }
}
.back {
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 16px;
    color: #7c7c7c;
    font-size: 24px;
    font-family: AmpleSoftPro, serif;
    line-height: 135%;
    @media (max-width: 479.98px) {
        font-size: 14px;
    }
    &_link {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: 1px solid #3f7bdd;
        svg {
            stroke: #3f7bdd;
        }
        @media (max-width: 479.98px) {
            width: 24px;
            height: 24px;
            border-radius: 4px;
            font-size: 14px;
        }
    }
}
</style>
