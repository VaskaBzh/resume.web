<template>
    <div class="mining-info">
        <div class="mining-info__container">
            <div class="mining-info__main mining-im">
                <div class="mining-im__con">
                    <div
                        class="section__block section__block-blue mining-im__general"
                        v-scroll="'left delay--lg'"
                    >
                        <div class="mining-im__general_content">
                            <div class="subtitle subtitle-white">
                                {{ $t("info.title") }}
                            </div>
                            <Link
                                href="/profile/accounts"
                                v-if="this.auth_user"
                                class="link link-white"
                            >
                                {{ $t("info.link") }}
                                <svg
                                    width="14"
                                    height="14"
                                    viewBox="0 0 14 14"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M4.83882 3.08785C5.06663 2.86004 5.43598 2.86004 5.66378 3.08785L9.16378 6.58785C9.39159 6.81565 9.39159 7.185 9.16378 7.4128L5.66378 10.9128C5.43598 11.1406 5.06663 11.1406 4.83882 10.9128C4.61102 10.685 4.61102 10.3157 4.83882 10.0878L7.92634 7.00033L4.83882 3.9128C4.61102 3.685 4.61102 3.31565 4.83882 3.08785Z"
                                        fill="white"
                                    />
                                </svg>
                            </Link>
                            <Link
                                :href="route('page', { page: 'registration' })"
                                v-else
                                class="link link-white"
                            >
                                {{ $t("info.link") }}
                                <svg
                                    width="14"
                                    height="14"
                                    viewBox="0 0 14 14"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M4.83882 3.08785C5.06663 2.86004 5.43598 2.86004 5.66378 3.08785L9.16378 6.58785C9.39159 6.81565 9.39159 7.185 9.16378 7.4128L5.66378 10.9128C5.43598 11.1406 5.06663 11.1406 4.83882 10.9128C4.61102 10.685 4.61102 10.3157 4.83882 10.0878L7.92634 7.00033L4.83882 3.9128C4.61102 3.685 4.61102 3.31565 4.83882 3.08785Z"
                                        fill="white"
                                    />
                                </svg>
                            </Link>
                        </div>
                        <div class="mining-im__general_image_con">
                            <img
                                src="../../../../assets/img/more-coins.webp"
                                alt=""
                                class="mining-im__general_image"
                            />
                        </div>
                    </div>

                    <ul class="mining-im__list">
                        <li
                            class="section__block section__block-light"
                            v-scroll="'left delay--md'"
                            v-for="(card, i) in cards"
                            :key="i"
                        >
                            <div class="mining-im__item_top">
                                <img
                                    src="../../../../assets/img/static-propeller.svg"
                                    alt=""
                                    class="mining-im__item_icon"
                                />
                                <main-title
                                    tag="h4"
                                    class="mining-im__item_title"
                                >
                                    {{ card.title }}
                                </main-title>
                            </div>
                            <div class="description-xs description">
                                {{ card.text }}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import MainTitle from "@/Components/UI/MainTitle.vue";
export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
    },
    components: { Link, MainTitle },
    computed: {
        cards() {
            return [
                {
                    title: this.$t("info.blocks[0].title"),
                    text: this.$t("info.blocks[0].text"),
                },
                {
                    title: this.$t("info.blocks[1].title"),
                    text: this.$t("info.blocks[1].text"),
                },
                {
                    title: this.$t("info.blocks[2].title"),
                    text: this.$t("info.blocks[2].text"),
                },
                {
                    title: this.$t("info.blocks[3].title"),
                    text: this.$t("info.blocks[3].text"),
                },
            ];
        },
    },
};
</script>

<style lang="scss" scoped>
.mining-im {
    // .mining-im__con
    &__con {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        @media (max-width: 1320.98px) {
            grid-template-columns: 100%;
            width: 100%;
            gap: 16px;
        }
        @media (max-width: 479.98px) {
            gap: 8px;
        }
    }
    // .mining-im__general
    &__general {
        @media (max-width: 1320.98px) {
            order: 2;
        }
        @media (max-width: 991.98px) {
            display: flex;
            justify-content: space-between;
        }
        @media (max-width: 600.98px) {
            flex-direction: column;
            gap: 15px;
        }
        // .mining-im__general_content
        &_content {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            @media (max-width: 991.98px) {
                justify-content: space-between;
                height: 100%;
            }
            @media (max-width: 600.98px) {
                gap: 40px;
                height: fit-content;
                justify-content: flex-start;
            }
            .subtitle {
                @media (max-width: 767.98px) {
                    font-size: 40px;
                    line-height: 100%;
                }
                @media (max-width: 479.89px) {
                    font-size: 24px;
                    line-height: 100%;
                }
            }
        }
        // .mining-im__general_image
        &_image {
            max-width: 400px;
            @media (max-width: 1270px) {
                max-width: 300px;
            }
            @media (max-width: 767.98px) {
                max-width: 235px;
            }
            @media (max-width: 550px) {
                max-width: 280px;
                margin-top: -22px;
            }

            // .mining-im__general_image_con
            &_con {
                display: flex;
                justify-content: center;
            }
        }
    }
    // .mining-im__list
    &__list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        @media (max-width: 767.98px) {
            gap: 16px;
        }
        @media (max-width: 479.98px) {
            gap: 8px;
            grid-template-columns: 1fr;
        }
    }
    // .mining-im__item
    &__item {
        // .mining-im__item_top
        &_top {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 12px;
            @media (max-width: 1270px) {
                align-items: center;
            }
        }
    }
}
</style>
