<template>
    <Head title="Подключение" />
    <div class="connecting">
        <div class="connecting__wrapper">
            <main-title tag="h2" titleName="Подключение воркера"></main-title>
            <div class="connecting__wrap wrap">
                <div class="connecting__block">
                    <div class="connecting__row">
                        1. Настройте ваше устройство согласно представленным
                        ниже данным:
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        PortAdress:
                        <div
                            class="connecting__block-copy copy"
                            ref="linkAddress"
                        >
                            {{ this.linkAddress }}
                            <svg
                                class="copy-button"
                                @click="this.copyLink(1)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        PortAdress 1:
                        <div
                            class="connecting__block-copy copy"
                            ref="linkAddress1"
                        >
                            {{ this.linkAddress1 }}
                            <svg
                                class="copy-button"
                                @click="this.copyLink(2)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        PortAddress 2:
                        <div
                            class="connecting__block-copy copy"
                            ref="linkAddress2"
                        >
                            {{ this.linkAddress2 }}
                            <svg
                                class="copy-button"
                                @click="this.copyLink(3)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import ProfileLayoutView from "@/Shared/ProfileLayoutView.vue";
import { router, Head } from "@inertiajs/vue3";
import { mapGetters } from "vuex";

export default {
    components: { MainTitle, Head },
    layout: ProfileLayoutView,
    data() {
        return {
            viewportWidth: 0,
            linkAddress: "btc.all-btc.com:4444",
            linkAddress1: "btc.all-btc.com:3333",
            linkAddress2: "btc.all-btc.com:2222",
        };
    },
    methods: {
        router() {
            return router;
        },
        copyLink(i) {
            if (i === 1) {
                navigator.clipboard.writeText(this.linkAddress);
                this.$refs.linkAddress.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress.classList.remove("active");
                }, 1000);
            } else if (i === 2) {
                navigator.clipboard.writeText(this.linkAddress1);
                this.$refs.linkAddress1.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress1.classList.remove("active");
                }, 1000);
            } else if (i === 3) {
                navigator.clipboard.writeText(this.linkAddress2);
                this.$refs.linkAddress2.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkAddress2.classList.remove("active");
                }, 1000);
            }
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    async created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
        ...mapGetters(["allAccounts"]),
    },
    mounted() {
        document.title = "Подключение";
    },
};
</script>
<style lang="scss">
.connecting {
    @media (min-width: 1271px) {
        padding-left: 330px;
    }
    width: 100%;
    .title {
        margin-bottom: 16px;
        @media (max-width: 479.98px) {
            margin-bottom: 20px;
        }
        @media (max-width: 320.98px) {
            margin-bottom: 24px;
        }
    }
    // .connecting_question
    &__question {
        width: 100%;
        min-height: 68px;
        padding: 12px 20px;
        border-radius: 21px;
        background-color: #fff;
        display: flex;
        align-items: center;
        @media (max-width: 767.98px) {
            padding: 12px;
        }
        &_wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            margin-right: 16px;
            background-color: rgba(194, 213, 242, 0.61);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            @media (max-width: 767.98px) {
                margin-right: 10px;
            }
        }
        &_title {
            font-weight: 700;
            font-family: AmpleSoftPro, serif;
            font-size: 18px;
            line-height: 21px;
            color: #000000;
            margin-bottom: 8px;
            @media (max-width: 767.98px) {
                margin: 0;
                font-size: 14px;
                line-height: 20px;
            }
        }
        &_text {
            font-weight: 400;
            line-height: 21px;
            @media (max-width: 767.98px) {
                font-size: 14px;
                line-height: 16px;
            }
        }
    }
    // .connecting__wrapper
    &__wrapper {
        width: 100%;
    }
    // .connecting__wrap
    &__wrap {
        padding: 32px;
        flex-direction: column;
        gap: 40px;
        svg {
            stroke: #4182ec;
        }
        @media (max-width: 991.98px) {
            padding: 20px;
            gap: 22px;
        }
    }
    // .connecting__block
    &__block {
        display: flex;
        flex-direction: column;
        gap: 20px;
        @media (max-width: 767.98px) {
            max-width: 100%;
            //&:not(:first-child) {
            .connecting__row {
                &:first-child {
                    margin-bottom: -16px;
                }
            }
            //}
            &:last-child {
                gap: 6px;
                .connecting__row {
                    flex-direction: row;
                    margin-top: 6px;
                    margin-bottom: 0 !important;
                }
            }
        }
    }
    // .connecting__row
    &__row {
        display: inline-flex;
        align-items: center;
        font-weight: 400;
        font-size: 18px;
        line-height: 18px;
        color: rgba(0, 0, 0, 0.62);
        @media (max-width: 767.98px) {
            flex-direction: column;
            align-items: center;
            font-size: 16px;
            line-height: 23px;
            color: #818c99;
        }
        @media (max-width: 320.98px) {
            font-size: 12px;
            line-height: 17px;
        }
        &-copy {
            position: relative;
            @media (max-width: 767.98px) {
                color: rgba(0, 0, 0, 0.62);
            }
        }
        span {
            margin: 0 3px;
            font-weight: 700;
        }
    }
    // .connecting__block-copy
    &__block-copy {
        max-width: calc(100% - 140px) !important;
        @media (max-width: 991.98px) {
            max-width: calc(100% - 92px) !important;
        }
    }
    &__select {
        max-width: 280px !important;
        height: 40px;
        @media (max-width: 767.98px) {
            margin: 6px 0 0;
            max-width: 100% !important;
            height: 38px;
        }
    }
    .title {
        @media (max-width: 767.98px) {
            margin-bottom: 24px;
        }
    }
}
</style>
