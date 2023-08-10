<template>
    <div class="app_back un-theme app_back-calculator">
        <header-component-calculator :errors="errors" :is_auth="auth_user" />
        <div class="page page-calculator">
            <div class="page__con">
                <div class="page__container">
                    <div class="page__main">
                        <div class="page__content">
                            <keep-alive>
                                <slot :errors="errors"></slot>
                            </keep-alive>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HeaderComponentCalculator from "../modules/calculator/Components/HeaderComponentCalculator.vue";
import { mapGetters } from "vuex";

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
    components: { HeaderComponentCalculator },
    computed: {
        ...mapGetters(["getMessage", "isDark"]),
    },
};
</script>

<style lang="scss" scoped>
.app_back-calculator {
    background: #16181A;
    font-family: SFPro, serif;
    font-size: 18px;
    &:before {
        content: none;
    }
}
.page {
    &-calculator {
        margin: 0;
    }
}
</style>
