<template>
    <div class="advantages section">
        <div class="advantages__container">
            <div class="advantages__content">
                <main-title class="advantages_title title-blue"
                    >{{ $t("hosting.get_block.title") }}
                </main-title>
                <p
                    class="description"
                    v-html="$t('hosting.get_block.text')"
                ></p>
                <blue-button
                    class="button button-md button-reverce btn-consultation"
                >
                    <a
                        class="all-link"
                        target="_blank"
                        href="https://t.me/allbtc_connect"
                    >
                        <svg
                            width="21"
                            height="18"
                            viewBox="0 0 21 18"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18.6651 0.717003L0.935095 7.554C-0.274905 8.04 -0.267905 8.715 0.713095 9.016L5.26509 10.436L15.7971 3.791C16.2951 3.488 16.7501 3.651 16.3761 3.983L7.8431 11.684H7.84109L7.8431 11.685L7.5291 16.377C7.9891 16.377 8.19209 16.166 8.45009 15.917L10.6611 13.767L15.2601 17.164C16.1081 17.631 16.7171 17.391 16.9281 16.379L19.9471 2.151C20.2561 0.912003 19.4741 0.351003 18.6651 0.717003Z"
                            />
                            <defs>
                                <linearGradient
                                    id="paint0_linear_486_17338"
                                    x1="3.11531"
                                    y1="27.07"
                                    x2="21.2182"
                                    y2="24.8555"
                                    gradientUnits="userSpaceOnUse"
                                >
                                    <stop stop-color="#3F7BDD" />
                                    <stop offset="1" stop-color="#4282EC" />
                                </linearGradient>
                            </defs>
                        </svg>

                        {{ $t("hosting.get_block.button") }}
                    </a>
                </blue-button>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import BlueButton from "@/modules/common/Components/UI/ButtonBlue.vue";

export default {
    name: "AdvantagesView",
    components: {
        MainTitle,
        BlueButton,
    },
};
</script>

<style scoped lang="scss">
.advantages {
    &__container {
        margin: 0 auto;
    }

    &__content {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: center;
        @media (max-width: 479.98px) {
            gap: 16px;
        }

        .description {
            text-align: center;
        }

        .blue-button {
            margin-top: 40px;
            @media (max-width: 767.98px) {
                margin-top: 16px;
            }
            @media (max-width: 479.98px) {
                margin-top: 24px;
                width: 100%;
            }
        }
    }

    &_title {
        max-width: 1216px;
        text-align: center;
    }

    .btn-consultation {
        margin-top: 20px;
    }
}
</style>
