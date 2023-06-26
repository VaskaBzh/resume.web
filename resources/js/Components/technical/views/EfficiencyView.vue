<template>
    <div class="efficiency section">
        <div class="efficiency__container">
            <div class="efficiency__main">
                <main-title tag="h2" class="title-blue">{{
                    this.$t("hosting.eff.title")
                }}</main-title>
                <img src="../../../../assets/img/efficiency_img-1.webp" alt="" />
                <p class="description">
                    {{ this.$t("hosting.eff.text") }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "efficiency-view",
    components: {
        MainTitle,
    },
};
</script>

<style scoped lang="scss">
.efficiency {
    &__main {
        display: flex;
        flex-direction: column;
        gap: 48px;
        align-items: center;
        max-width: calc(100% - 505px);
        @media (max-width: 1320.98px) {
            max-width: calc(100% - 378px);
        }
        @media (max-width: 767.98px) {
            max-width: calc(100% - 278px);
        }
        @media (max-width: 600.98px) {
            gap: 40px;
            max-width: 100%;
        }
        img {
            filter: drop-shadow(0px 10px 50px rgba(112, 165, 236, 0.25));
            @media (max-width: 767.98px) {
                max-width: 200px;
            }
            @media (max-width: 600.98px) {
                max-width: 173px;
            }
            @media (min-width: 767.98px) {
                right: 0;
            }
            @media (min-width: 600.98px) {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
            }
        }
    }
    &__container {
        @media (min-width: 479.98px) {
            position: relative;
        }
    }
}
</style>
