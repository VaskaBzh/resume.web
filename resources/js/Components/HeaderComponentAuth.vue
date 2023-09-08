<template>
    <div class="sign__navigation">
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
                <select-language
                    :viewportWidth="viewportWidth"
                ></select-language>
                <select-theme :viewportWidth="viewportWidth"></select-theme>
            </div>
        </nav>
    </div>
</template>

<script>
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
                this.$router.go(-1);
            } else {
                this.$router.push({ name: "default" });
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.sign__navigation {
    position: fixed;
    width: 100%;
    height: 84px;
    z-index: 100;
    display: flex;
    justify-content: center;
    align-items: center;
    @media (max-width: 991.98px) {
        height: 64px;
    }
    &::before {
        content: "";
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: #fafafa;
        box-shadow: 0px 8px 24px 0px rgba(129, 135, 189, 0.15);
    }

    & nav.nav__container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        flex: 1 0 auto;

        @media (min-width: 1271px) {
            transition: all 0.3s ease 0s;
            // width: 100vw;
        }
        @media (max-width: 1270px) {
            padding: 21px 0;
            gap: 20px;
        }
        @media (max-width: 991.98px) {
            padding: 20px 15px 15px;
            gap: 15px;
            height: 64px;
        }
    }
}

.nav__buttons {
    display: flex;
    gap: 12px;
    align-items: center;
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
        // padding: 6px;

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
