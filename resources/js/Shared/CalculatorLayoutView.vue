<template>
    <div class="app_back un-theme app_back-calculator">
        <div class="page page-calculator">
            <div class="page__con">
                <div class="page__main page__main-calculator">
                    <keep-alive>
                        <slot :errors="errors"></slot>
                    </keep-alive>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
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
    computed: {
        ...mapGetters(["getMessage", "isDark"]),
    },
    async created() {
        await this.$store.dispatch("getMiningStat");
        await this.$store.dispatch("getGraph");
    },
};
</script>

<style lang="scss" scoped>
.app_back-calculator {
    font-family: SFPro, serif;
    font-size: 18px;
    position: relative;
    background: transparent;
    &:before {
        content: none;
    }
}
.page {
    &-calculator {
        margin: 0;
    }
    &__main {
        &-calculator {
            margin-top: 0;
        }
    }
}
</style>
