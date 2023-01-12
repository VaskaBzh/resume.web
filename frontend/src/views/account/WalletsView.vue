<template>
    <div class="wallets">
        <div class="wallets__container">
            <main-title tag="h2" titleName="Мои кошельки">
                <router-link
                    class="wallets__button wallets__button-history"
                    to="/history"
                >
                    История
                </router-link>
            </main-title>
            <div class="wallets__wrap">
                <div class="wallets__row wallets__row-balance">
                    <div class="wallets__column">
                        <span class="wallets__subtitle">Суммарный баланс:</span>
                        <span class="wallets__value">
                            $ <span>{{ this.fullCash }}</span></span
                        >
                    </div>
                    <div class="wallets__buttons">
                        <button class="wallets__button">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M16.5156 9.34814H21.0156V4.84814"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M6.16602 6.16637C6.9321 5.40029 7.84157 4.7926 8.84251 4.37799C9.84344 3.96339 10.9162 3.75 11.9996 3.75C13.0831 3.75 14.1558 3.96339 15.1568 4.37799C16.1577 4.7926 17.0672 5.40029 17.8333 6.16637L21.0153 9.34835"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M7.48438 14.6519H2.98438V19.1519"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M17.8336 17.8338C17.0675 18.5999 16.1581 19.2076 15.1571 19.6222C14.1562 20.0368 13.0834 20.2502 12 20.2502C10.9166 20.2502 9.84378 20.0368 8.84285 19.6222C7.84191 19.2076 6.93244 18.5999 6.16635 17.8338L2.98438 14.6519"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Обменять
                        </button>
                        <button class="wallets__button">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M8.0625 7.68457L12 3.74707L15.9375 7.68457"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M12 14.25V3.75"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M21 12.75V19.5C21 19.6989 20.921 19.8897 20.7803 20.0303C20.6397 20.171 20.4489 20.25 20.25 20.25H3.75C3.55109 20.25 3.36032 20.171 3.21967 20.0303C3.07902 19.8897 3 19.6989 3 19.5V12.75"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Вывести
                        </button>
                        <button class="wallets__button">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                            >
                                <path
                                    d="M8.0625 10.3125L12 14.25L15.9375 10.3125"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M12 3.74707V14.2471"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M21 12.75V19.5C21 19.6989 20.921 19.8897 20.7803 20.0303C20.6397 20.171 20.4489 20.25 20.25 20.25H3.75C3.55109 20.25 3.36032 20.171 3.21967 20.0303C3.07902 19.8897 3 19.6989 3 19.5V12.75"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                            Пополнить
                        </button>
                    </div>
                </div>
                <div class="wallets__row">
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">На кошельках:</span>
                            <span class="wallets__value"
                                >$ <span>{{ this.walletsCash }}</span></span
                            >
                        </div>
                    </div>
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle"
                                >Счет майнинга:</span
                            >
                            <span class="wallets__value"
                                >$ <span>{{ this.miningCash }}</span></span
                            >
                        </div>
                    </div>
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle"
                                >В ожидании выплаты</span
                            >
                            <span class="wallets__value"
                                >$ <span>{{ this.waitingCash }}</span></span
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div ref="wallets" class="wallets__wrap">
                <h3 class="wallets__title">
                    Список кошельков
                    <div class="wallets__filter" @click="checkboxer">
                        <span ref="checkbox">Скрыть с нулевым балансом</span>
                    </div>
                </h3>
                <div ref="list" class="wallets__list" v-if="!this.isChecked">
                    <div
                        class="wallets__block wallets__block-wallet"
                        v-for="(wallet, i) in this.wallets"
                        :key="i"
                        v-scroll="'top'"
                    >
                        <div class="wallets__block_name">
                            <img :src="require(`@/assets/img/${wallet.img}`)" />
                            <span>{{ wallet.name }}</span>
                            <div class="wallets__block_doths">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="wallets__block_value">
                            <span>{{ wallet.value }}</span>
                            {{ wallet.shortName }}
                        </div>
                        <div class="wallets__block_convert">
                            ≈ {{ wallet.dollarValue.toFixed(2) }} $ ≈
                            {{ wallet.rubleValue.toFixed(2) }} ₽
                        </div>
                    </div>
                </div>
                <div ref="lowList" class="wallets__list" v-else>
                    <div
                        class="wallets__block wallets__block-wallet"
                        v-for="(wallet, i) in this.unEmptyWallets"
                        :key="i"
                        v-scroll="'top'"
                    >
                        <div class="wallets__block_name">
                            <img :src="require(`@/assets/img/${wallet.img}`)" />
                            <span>{{ wallet.name }}</span>
                            <div class="wallets__block_doths">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div class="wallets__block_value">
                            <span>{{ wallet.value }}</span>
                            {{ wallet.shortName }}
                        </div>
                        <div class="wallets__block_convert">
                            ≈ {{ wallet.dollarValue.toFixed(2) }} $ ≈
                            {{ wallet.rubleValue.toFixed(2) }} ₽
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
            walletsCash: 0,
            miningCash: 0,
            waitingCash: 0,
            isChecked: false,
            wallets: [
                {
                    img: "dash_img.png",
                    name: "Dash",
                    shortName: "DASH",
                    value: 0,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "doge_img.png",
                    name: "Dogecoin",
                    shortName: "DOGE",
                    value: 1,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "etc_img.png",
                    name: "Ethereum Classic",
                    shortName: "ETC",
                    value: 0,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "eth_img.png",
                    name: "Ethereum",
                    shortName: "BCH",
                    value: 0,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "bitcoin-cash_img.png",
                    name: "Bitcoin Cash",
                    shortName: "BCH",
                    value: 23.7,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "bitcoin_img.png",
                    name: "Bitcoin",
                    shortName: "BTC",
                    value: 0,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "litecoin_img.png",
                    name: "Litecoin",
                    shortName: "LTC",
                    value: 0,
                    dollarValue: 0,
                    rubleValue: 0,
                },
                {
                    img: "usdt_img.png",
                    name: "USDT",
                    shortName: "USDT",
                    value: 0,
                    dollarValue: 0,
                    rubleValue: 0,
                },
            ],
        };
    },
    computed: {
        fullCash() {
            return this.walletsCash + this.miningCash + this.waitingCash;
        },
        unEmptyWallets() {
            let arr = [];
            for (let i = 0; i < this.wallets.length; i++) {
                if (this.wallets[i].value != 0) {
                    arr.push(this.wallets[i]);
                }
            }
            return arr;
        },
    },
    methods: {
        checkboxer() {
            if (!this.isChecked) {
                this.$refs.checkbox.classList.add("active");
                setTimeout(() => {
                    this.$refs.wallets.style.height =
                        48 + 46 + this.$refs.lowList.offsetHeight + "px";
                }, 1);
                this.isChecked = true;
            } else {
                setTimeout(() => {
                    this.$refs.wallets.style.height =
                        48 + 46 + this.$refs.list.offsetHeight + "px";
                }, 1);
                this.$refs.checkbox.classList.remove("active");
                this.isChecked = false;
            }
        },
    },
    mounted() {
        document.title = "Кошельки";
        this.$refs.wallets.style.height =
            48 + 46 + this.$refs.list.offsetHeight / 2 + "px";
        this.$refs.wallets.style.height =
            48 + 46 + this.$refs.list.offsetHeight + "px";
    },
};
</script>
<style lang="scss" scoped>
.wallets {
    &__title {
        font-family: AmpleSoftPro;
        font-style: normal;
        color: #000;
        margin: 0 0 16px;
        font-weight: 700;
        font-size: 24px;
        line-height: 30px;
        width: 100%;
        display: inline-flex;
    }

    // .wallets__filter
    &__filter {
        display: flex;
        align-items: center;
        margin-left: auto;

        span {
            line-height: 23px;
            font-size: 16px;
            color: #99acd3;
            display: inline-flex;
            position: relative;
            align-items: center;
            user-select: none;
            cursor: pointer;

            &::after {
                content: "";
                display: inline-block;
                width: 52px;
                height: 28px;
                background: rgba(194, 213, 242, 0.61);
                border-radius: 32px;
                margin-left: 12px;
            }

            &::before {
                content: "";
                display: inline-block;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 27px;
                width: 22px;
                height: 22px;
                border-radius: 50%;
                background-color: #fff;
                transition: all 0.3s ease;
            }

            &.active {
                &::before {
                    right: 3px;
                    background-color: #4282ec;
                }
            }
        }
    }

    .title {
        margin: 49px 0 20px;
        display: flex;
        width: 100%;
        align-items: center;
    }

    &__list {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        transition: all 0.3s ease 0s;
        height: fit-content;
    }

    // .wallets__block
    &__block {
        padding: 16px;
        background-color: #fff;
        border-radius: 13px;
        width: 100%;

        &-wallet {
            width: calc(25% - 12px);
            padding: 12px 0;
            transition: all 0.5s ease;

            &.top {
                &-before-enter {
                    opacity: 0;
                }

                &-enter {
                    opacity: 1;
                }
            }
        }

        &_name {
            width: 100%;
            display: inline-flex;
            align-items: center;
            padding: 0 12px 12px;
            border-bottom: 1px solid #e8ecf2;

            img {
                margin-right: 12px;
                width: 24px;
                height: 24px;
                border-radius: 50%;
            }

            span {
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                color: #000000;
            }
        }

        &_doths {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 23.5px;
            gap: 3px;
            cursor: pointer;

            &:hover {
                div {
                    background-color: #3f7bdd;
                }
            }

            div {
                width: 4px;
                height: 4px;
                border-radius: 50%;
                background-color: rgba(0, 0, 0, 0.62);
                transition: all 0.3s ease;
            }
        }

        &_value {
            padding: 12px 12px 0;
            margin-bottom: 4px;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
            color: #0000009e;
            width: 100%;

            span {
                font-weight: 700;
                color: #000034;
            }
        }

        &_convert {
            padding: 0 12px;
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
        }

        .wallets__subtitle {
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
        }
    }

    // .wallets__button
    &__button {
        height: 48px;
        border-radius: 13px;
        color: #5173b9;
        background: rgba(194, 213, 242, 0.61);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        line-height: 26px;
        font-weight: 400;
        min-width: 179px;
        margin-left: 16px;
        box-shadow: none;
        transform: translate(0, 0);
        transition: all 0.3s ease;

        &:hover {
            box-shadow: 4px 4px rgba(63, 123, 221, 0.27);
            background-color: #4182ec;
            color: #fff;
            transform: translate(-4px, -4px);

            svg {
                stroke: #fff;
            }
        }

        &:first-child {
            margin-left: 0;
        }

        svg {
            stroke: #5173b9;
            margin-right: 10%;
            transition: all 0.3s ease;
        }

        // .wallets__button-history
        &-history {
            font-size: 20px;
            line-height: 28px;
            font-weight: 500;
            height: 51px;
            color: #fff;
            background-color: #4182ec;
            min-width: 210px;
            margin-left: auto !important;
        }
    }

    // .wallets__wrap
    &__wrap {
        margin-bottom: 40px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        width: 100%;
        padding: 24px 18px;

        &:last-child {
            margin-bottom: 0;
            overflow-y: hidden;
            transition: all 0.3s ease;
        }
    }

    // .wallets__row
    &__row {
        width: 100%;
        display: flex;
        gap: 16px;
        // .wallets__row-balance
        &-balance {
            gap: auto;
            justify-content: space-between;
            margin-bottom: 32px;
        }
    }

    // .wallets__column
    &__column {
        display: flex;
        flex-direction: column;
    }

    // .wallets__subtitle
    &__subtitle {
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: rgba(0, 0, 0, 0.62);
        margin-bottom: 4px;
    }

    // .wallets__value
    &__value {
        color: #ababba;
        font-weight: 700;
        font-size: 24px;
        line-height: 34px;

        span {
            font-weight: 500;
            color: #000034;
        }
    }

    // .wallets__buttons
    &__buttons {
        display: flex;
        justify-content: flex-end;
    }
}
</style>
