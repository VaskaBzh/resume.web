<template>
    <Head title="Подключение" />
    <div class="connecting">
        <div class="connecting__wrapper">
            <main-title tag="h2" titleName="Подключение воркера"></main-title>
            <div class="connecting__wrap wrap">
                <div class="connecting__block">
                    <div class="connecting__row">
                        1. Выберите добываемую монету:
                        <main-select
                            class="connecting__select connecting__select-priority mini"
                            :options="values"
                        ></main-select>
                    </div>
                    <div class="connecting__row">
                        2. Выберите наиболее близкий к вам регион:
                        <main-select
                            class="connecting__select mini"
                            :options="countries"
                        ></main-select>
                    </div>
                </div>
                <div class="connecting__block">
                    <div class="connecting__row">
                        3. Настройте ваше устройство согласно представленным
                        ниже данным:
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Address:
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
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Address 1:
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
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Address 2:
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
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Worker:
                        <div
                            class="connecting__block-copy copy"
                            ref="linkWorker"
                        >
                            {{ this.linkWorker }}
                            <svg
                                class="copy-button"
                                @click="this.copyLink(4)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="connecting__block">
                    <div class="connecting__row">
                        4. Наслаждайтесь добычей активов на <span>allbtc</span>!
                    </div>
                    <div class="connecting__question">
                        <div class="connecting__question_wrap">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M11.8606 22H11.8734M7 6.66007C7.69445 4.53023 9.60832 3 11.8606 3C14.699 3 17 5.43045 17 8.42857C17 10.6766 15.7063 12.6055 13.8624 13.43C12.9106 13.8555 12.4347 14.0683 12.2682 14.2326C12.0699 14.4283 12.0323 14.4883 11.9389 14.7574C11.8606 14.9835 11.8606 15.3319 11.8606 16.0286L11.8606 17"
                                    stroke-width="4"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                        <div class="connecting__question_block">
                            <h4 class="connecting__question_title">
                                Остались вопросы?
                            </h4>
                            <router-link
                                class="connecting__question_text main__link main__link-underline"
                                to="/faqview"
                                v-if="this.viewportWidth > 767.98"
                            >
                                Подробнее про подключение устройств в FAQ
                            </router-link>
                            <router-link
                                class="connecting__question_text main__link main__link-underline"
                                to="/faqview"
                                v-else
                            >
                                Узнать больше
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainSelect from "@/Components/UI/MainSelect.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";
import ProfileLayoutView from "@/Shared/ProfileLayoutView.vue";

export default {
    components: { MainTitle, MainSelect },
    layout: ProfileLayoutView,
    data() {
        return {
            viewportWidth: 0,
            values: [
                { title: "BTC", value: 1, img: "bitcoin_img.png" },
                { title: "Dash", value: 2, img: "dash_img.png" },
                { title: "Doge", value: 3, img: "doge_img.png" },
                { title: "Etc", value: 4, img: "etc_img.png" },
                { title: "Eth", value: 5, img: "eth_img.png" },
            ],
            countries: [
                { title: "Russia", value: 1, img: "russian_img.png" },
                { title: "Belarus", value: 2, img: "belarus_img.png" },
                { title: "Kazakhstan", value: 3, img: "kazakhstan_img.png" },
                { title: "Georgia", value: 4, img: "georgia_img.png" },
                { title: "Serbia", value: 5, img: "serbia_img.png" },
            ],
            linkAddress: "stratum+tcp://gate.all-btc.com:333",
            linkAddress1: "stratum+tcp://gate.all-btc.com:333",
            linkAddress2: "stratum+tcp://gate.all-btc.com:333",
            linkWorker: "stratum+tcp://worker",
        };
    },
    methods: {
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
            } else if (i === 4) {
                navigator.clipboard.writeText(this.linkWorker);
                this.$refs.linkWorker.classList.add("active");
                setTimeout(() => {
                    this.$refs.linkWorker.classList.remove("active");
                }, 1000);
            }
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    mounted() {
        document.title = "Подключение";
    },
};
</script>
<style lang="scss" scoped>
.connecting {
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
        &:first-child {
            display: grid;
            grid-template-columns: repeat(2, auto);
            gap: 0;
            @media (max-width: 991.98px) {
                gap: 16px;
            }
            @media (max-width: 767.98px) {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(2, auto);
                gap: 22px;
            }
            .connecting__row {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
                @media (max-width: 991.98px) {
                    gap: 6px;
                }
            }
        }
        @media (max-width: 767.98px) {
            max-width: 100%;
            &:not(:first-child) {
                .connecting__row {
                    &:first-child {
                        margin-bottom: -16px;
                    }
                }
            }
            &:last-child {
                gap: 6px;
                .connecting__row {
                    flex-direction: row;
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
            align-items: flex-start;
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
        max-width: 730px;
        @media (max-width: 991.98px) {
            max-width: 600px;
        }
        @media (max-width: 767.98px) {
            margin-top: 6px;
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
