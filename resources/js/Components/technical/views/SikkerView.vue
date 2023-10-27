<template>
    <div class="sikker section">
        <div class="sikker__container">
            <div class="sikker__main">
                <img src="../../../../assets/img/sikker_img-1.svg" alt="" />
                <div class="sikker__content">
                    <main-title tag="h3" class="sikker_title">{{
                        this.$t("hosting.security.title")
                    }}</main-title>
                    <p class="description">
                        {{ this.$t("hosting.security.text") }}
                    </p>
                </div>
                <blue-button
                    class="button button-lg button-with-propeller"
                    v-if="this.auth_user"
                >
                    <router-link :to="{ name: 'accounts' }" class="all-link">
                        {{ $t("hosting.button") }}
                        <div class="button_propeller"></div
                    ></router-link>
                </blue-button>
                <blue-button
                    class="button button-lg button-with-propeller"
                    v-else
                >
                    <router-link :to="{ name: 'registration' }" class="all-link">
                        {{ $t("hosting.button") }}
                        <div class="button_propeller"></div
                    ></router-link>
                </blue-button>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "sikker-view",
    components: {
        MainTitle,
        BlueButton,
        Link,
    },
    props: {
        auth_user: Boolean,
    },
};
</script>

<style scoped lang="scss">
.sikker {
    &__container {
        margin: 0 auto;
    }
    &__main {
        display: flex;
        flex-direction: column;
        gap: 48px;
        align-items: center;
        @media (max-width: 767.98px) {
            gap: 32px;
        }
        img {
            margin-bottom: 16px;
            filter: drop-shadow(0px 10px 50px rgba(112, 165, 236, 0.25));
            @media (max-width: 767.98px) {
                margin-bottom: 8px;
            }
            @media (max-width: 479.98px) {
                margin-bottom: 0;
                height: 100px;
                width: 80px;
            }
        }
        .description {
            text-align: center;
        }
        .title {
            @media (max-width: 991.98px) {
                text-align: center;
            }
        }
    }
    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        @media (max-width: 479.98px) {
            gap: 12px;
        }
    }
    .button_propeller {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #366DC8 url("../../../../assets/img/propeller.svg") no-repeat center;
        transition: all 0.5s ease;
        animation: rotate 1.9s linear infinite;
        stroke-width: 1px;
        stroke: #FFF;
        box-shadow: 0px 11px 6px 0px rgba(0, 0, 0, 0.08) inset;
        filter: drop-shadow(0px 0px 35px rgba(255, 255, 255, 0.04));

        @keyframes rotate {
            from {
                transform: rotate(360deg);
            }
        }
    }
}
</style>
