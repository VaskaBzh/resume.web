<template>
    <div class="profit section">
        <div class="profit__container">
            <div class="profit__main">
                <img
                    v-if="!isDark"
                    src="../../../../assets/img/profit_view_img-1.svg"
                    alt="img"
                    class="profit__image"
                />
                <img
                    v-else
                    src="../../../../assets/img/profit_view_img-1-dark.svg"
                    alt="img"
                    class="profit__image"
                />
                <main-title class="title-blue"
                    >{{ $t("hosting.profit.title") }}
                </main-title>
                <p class="description">{{ $t("hosting.profit.text") }}</p>
                <!--                v-scroll="'left'"-->
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import { mapGetters } from "vuex";

export default {
    name: "ProfitView",
    components: {
        MainTitle,
    },
    computed: {
        ...mapGetters(["isDark"]),
    },
};
</script>

<style scoped lang="scss">
.profit {
    display: flex;
    flex-direction: column;

    .description {
        line-height: 140%;
        @media (max-width: 767.98px) {
            font-size: 16px;
        }
        @media (max-width: 479.98px) {
            font-size: 14px;
        }
    }

    &__container {
        margin: 0 auto;
        position: relative;
        @media (min-width: 991.98px) {
            width: 100%;
        }
    }

    &__main {
        display: flex;
        align-items: center;
        gap: 48px;
        justify-content: space-between;
        flex-direction: column;
        max-width: 706px;
        margin-left: auto;
        @media (max-width: 1320.98px) {
            max-width: calc(50% - 22px);
        }
        @media (max-width: 991.98px) {
            max-width: 100%;
            flex-direction: row;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 44px;
            .title {
                width: 100%;
            }
            .description {
                max-width: 344px;
                order: 2;
            }
        }
        @media (max-width: 767.98px) {
            .description {
                max-width: calc(50% - 24px);
            }
        }
        @media (max-width: 680.98px) {
            flex-direction: column;
            gap: 24px;
            .description {
                max-width: 100%;
            }
        }
    }

    // .profit__title
    &__title {
        font-family: "AmpleSoftPro", serif;
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 132.6%;
        color: #000034;
        margin-bottom: 24px;
        @media (max-width: 991.98px) {
            text-align: center;
        }
        @media (max-width: 767.98px) {
            font-size: 27px;
            line-height: 107.6%;
            margin-bottom: 16px;
        }
    }

    // .profit__image
    img {
        max-width: 486px;
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        @media (max-width: 1320.98px) {
            max-width: calc(50% - 22px);
        }
        @media (max-width: 991.98px) {
            max-width: calc(50% - 24px);
            order: 1;
            position: relative;
            top: 0;
            bottom: 0;
            transform: none;
        }
        @media (max-width: 767.98px) {
            margin: 0 0 -60px;
        }
        @media (max-width: 680.98px) {
            margin: 0 0 -80px;
            max-width: 100%;
        }
    }
}
</style>
