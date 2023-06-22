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
                    <Link :href="route('accounts')" class="all-link">
                        {{ $t("hosting.button") }}
                        <div class="button_propeller"></div
                    ></Link>
                </blue-button>
                <blue-button
                    class="button button-lg button-with-propeller"
                    v-else
                >
                    <Link :href="route('registration')" class="all-link">
                        {{ $t("hosting.button") }}
                        <div class="button_propeller"></div
                    ></Link>
                </blue-button>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
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
}
</style>
