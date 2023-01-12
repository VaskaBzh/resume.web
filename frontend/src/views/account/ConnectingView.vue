<template>
    <div class="connecting">
        <div class="connecting__wrapper">
            <main-title tag="h2" titleName="Подключение воркера"></main-title>
            <div class="connecting__wrap">
                <div class="connecting__block">
                    <div class="connecting__row">
                        1. Выберите добываемую монету:
                        <main-select
                            class="connecting__select"
                            :options="values"
                            selectType="mini"
                        ></main-select>
                    </div>
                </div>
                <div class="connecting__block">
                    <div class="connecting__row">
                        2. Выберите наиболее близкий к вам регион:
                        <main-select
                            class="connecting__select"
                            :options="countries"
                            selectType="mini"
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
                        <div class="connecting__block-copy">
                            {{ this.linkAddress }}
                            <svg
                                class="connecting__block-copy-copy"
                                @click="this.copyLink(1)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke="#000034"
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Address 1:
                        <div class="connecting__block-copy">
                            {{ this.linkAddress1 }}
                            <svg
                                class="connecting__block-copy-copy"
                                @click="this.copyLink(2)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke="#000034"
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Address 2:
                        <div class="connecting__block-copy">
                            {{ this.linkAddress2 }}
                            <svg
                                class="connecting__block-copy-copy"
                                @click="this.copyLink(3)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke="#000034"
                                    stroke-opacity="0.33"
                                    stroke-width="2"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="connecting__row connecting__row-copy">
                        Worker:
                        <div class="connecting__block-copy">
                            {{ this.linkWorker }}
                            <svg
                                class="connecting__block-copy-copy"
                                @click="this.copyLink(4)"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M15 3V6.4C15 6.96005 15 7.24008 15.109 7.45399C15.2049 7.64215 15.3578 7.79513 15.546 7.89101C15.7599 8 16.0399 8 16.6 8H20M10 8H6C4.89543 8 4 8.89543 4 10V19C4 20.1046 4.89543 21 6 21H12C13.1046 21 14 20.1046 14 19V16M16 3H13.2C12.0799 3 11.5198 3 11.092 3.21799C10.7157 3.40973 10.4097 3.71569 10.218 4.09202C10 4.51984 10 5.0799 10 6.2V12.8C10 13.9201 10 14.4802 10.218 14.908C10.4097 15.2843 10.7157 15.5903 11.092 15.782C11.5198 16 12.0799 16 13.2 16H16.8C17.9201 16 18.4802 16 18.908 15.782C19.2843 15.5903 19.5903 15.2843 19.782 14.908C20 14.4802 20 13.9201 20 12.8V7L16 3Z"
                                    stroke="#000034"
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
                        <div class="connecting__question_wrap"></div>
                        <div class="connecting__question_block">
                            <h4 class="connecting__question_title">
                                Остались вопросы?
                            </h4>
                            <router-link
                                class="connecting__question_text main__link main__link-underline"
                                to="/faqview"
                                >Подробнее про подключение устройств в
                                FAQ</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
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
            linkAddress: "stratum+tcp://gate.emcd.io:333",
            linkAddress1: "stratum+tcp://gate.emcd.io:333",
            linkAddress2: "stratum+tcp://gate.emcd.io:333",
            linkWorker: "stratum+tcp://worker",
        };
    },
    methods: {
        copyLink(i) {
            if (i == 1) {
                navigator.clipboard.writeText(this.linkAddress);
            } else if (i == 2) {
                navigator.clipboard.writeText(this.linkAddress1);
            } else if (i == 3) {
                navigator.clipboard.writeText(this.linkAddress2);
            } else if (i == 4) {
                navigator.clipboard.writeText(this.linkWorker);
            }
        },
    },
    mounted() {
        document.title = "Подключение";
    },
};
</script>
<style lang="scss">
.connecting {
    width: 100%;
    // .connecting_question
    &__question {
        width: 100%;
        min-height: 82px;
        padding: 16px;
        border-radius: 21px;
        background-color: #fff;
        display: flex;
        align-items: center;
        margin-top: 29px;
        &_wrap {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            margin-right: 12px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'%3E%3Cpath d='M11.8606 22H11.8734M7 6.66007C7.69445 4.53023 9.60832 3 11.8606 3C14.699 3 17 5.43045 17 8.42857C17 10.6766 15.7063 12.6055 13.8624 13.43C12.9106 13.8555 12.4347 14.0683 12.2682 14.2326C12.0699 14.4283 12.0323 14.4883 11.9389 14.7574C11.8606 14.9835 11.8606 15.3319 11.8606 16.0286L11.8606 17' stroke='%234182EC' stroke-width='4' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-color: rgba(194, 213, 242, 0.61);
            background-repeat: no-repeat;
            background-position: center;
        }
        &_title {
            font-weight: 700;
            font-size: 18px;
            line-height: 21px;
            color: #000000;
            margin-bottom: 8px;
        }
        &_text {
            font-weight: 400;
            line-height: 21px;
        }
    }
    // .connecting__wrapper
    &__wrapper {
        width: 100%;
    }
    // .connecting__wrap
    &__wrap {
        width: 100%;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        padding: 32px;
        margin-top: 16px;
    }
    // .connecting__block
    &__block {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        max-width: 613px;
    }
    // .connecting__row
    &__row {
        display: inline-flex;
        align-items: center;
        font-weight: 400;
        font-size: 18px;
        line-height: 18px;
        font-weight: 400;
        color: rgba(0, 0, 0, 0.62);
        &-copy {
            position: relative;
            margin-top: 20px;
        }
        span {
            margin: 0 3px;
            font-weight: 700;
        }
    }
    // .connecting__block-copy
    &__block-copy {
        max-width: 489px;
        width: 100%;
        min-height: 40px;
        border-radius: 21px;
        background: linear-gradient(0deg, #ffffff, #ffffff),
            linear-gradient(
                179.87deg,
                #e6eaf0 1.02%,
                #e6eaf1 4.79%,
                #e7ebf1 8.76%,
                #eaeef4 14.75%,
                #e8ecf2 19.07%
            );
        border: 1px solid #d6d6d6;
        padding: 7px 56px 7px 16px;
        outline: none;
        margin-left: auto;
        font-weight: 400;
        font-size: 18px;
        line-height: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        &-copy {
            width: 24px;
            height: 24px;
            cursor: pointer;
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
        }
        &::placeholder {
            color: rgba(0, 0, 52, 0.62);
        }
    }
    &__select {
        margin-left: auto;
        max-width: 158px !important;
    }
}
</style>
