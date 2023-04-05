<template>
    <div class="wallets">
        <div class="wallets__container">
            <main-title tag="h2" titleName="Мои кошельки">
                <!--                <blue-button class="wallets__button wallets__button-history">-->
                <!--                    <Link :href="route('history')"> История </Link>-->
                <!--                </blue-button>-->
            </main-title>
            <div class="wallets__wrap">
                <div class="wallets__row wallets__row-balance">
                    <h3 class="wallets__title">Обзор:</h3>
                </div>
                <div class="wallets__row">
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">Оплачено:</span>
                            <span class="wallets__value"
                                ><span> 0.00000000 </span>
                                BTC
                            </span>
                        </div>
                    </div>
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">
                                Неоплаченно:
                            </span>
                            <span class="wallets__value">
                                <span>
                                    {{ this.allEarn }}
                                </span>
                                BTC
                            </span>
                        </div>
                    </div>
                    <div class="wallets__block">
                        <div class="wallets__column">
                            <span class="wallets__subtitle">
                                Верашний доход:
                            </span>
                            <span class="wallets__value">
                                <span>
                                    {{ this.yesterdayProfit }}
                                </span>
                                BTC
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div ref="wallets" class="wallets__wrap">
                <h3 class="wallets__title">
                    Список кошельков
                    <main-checkbox
                        class="wallets__filter"
                        @is_checked="this.checkboxer"
                    >
                        Скрыть с нулевым балансом
                    </main-checkbox>
                </h3>
                <div
                    class="no-info"
                    v-scroll="'opacity'"
                    ref="noInfo"
                    v-if="!this.bool"
                >
                    <div class="propeller"></div>
                </div>
                <div ref="list" class="wallets__list" v-else>
                    <div
                        class="wallets__block wallets__block-wallet"
                        v-for="(wallet, i) in this.wallets"
                        :key="i"
                        v-scroll="'top'"
                    >
                        <div class="wallets__block_name">
                            <!--                            <img-->
                            <!--                                :src="-->
                            <!--                                    'http://127.0.0.1:5173' +-->
                            <!--                                    `/resources/assets/img/${wallet.img}`-->
                            <!--                                "-->
                            <!--                            />-->
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
                            ≈
                            <span>{{
                                (wallet.value * dollar).toFixed(2)
                            }}</span>
                            $ ≈
                            <span>{{
                                ((wallet.value * dollar) / ruble).toFixed(2)
                            }}</span>
                            ₽
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import MainCheckbox from "@/Components/UI/MainCheckbox.vue";
import { mapGetters } from "vuex";
import Vue from "lodash";

export default {
    components: { MainCheckbox, BlueButton, MainTitle },
    computed: {
        ...mapGetters(["FullEarn", "allAccounts", "allHistoryForDays"]),
        waitingCash() {
            return 100;
        },
        // eslint-disable-next-line vue/return-in-computed-property
        bool() {
            return this.wallets.length > 0;
        },
        allEarn() {
            let sum = 0;
            if (this.FullEarn) {
                Object.values(this.FullEarn).forEach((acc) => {
                    sum += Number(acc);
                });
            }
            return sum.toFixed(8);
        },
        yesterdayProfit() {
            let sum = 0;
            if (this.allHistoryForDays) {
                Object.values(this.allHistoryForDays).forEach((acc) => {
                    if (acc) {
                        sum += Number(acc[1][3]);
                    }
                });
            }
            return sum.toFixed(8);
        },
        walletsCash() {
            let sum = 0;
            if (Object.values(this.FullEarn).length > 0) {
                Object.values(this.FullEarn).forEach((el) => {
                    sum += Number(el);
                });
            }
            return sum;
        },
        wallets() {
            let arr = [];
            if (Object.values(this.allAccounts)) {
                if (this.isChecked) {
                    Object.values(this.allAccounts).forEach((acc, i) => {
                        let val = 0;
                        if (this.FullEarn[i]) {
                            val = this.FullEarn[i];
                        }
                        if (val > 0) {
                            let walletModel = {
                                img: "bitcoin_img.png",
                                name: acc.name,
                                shortName: "BTC",
                                value: val.toFixed(8),
                                dollarValue: 0,
                                rubleValue: 0,
                            };
                            Vue.set(arr, i, walletModel);
                        }
                    });
                } else {
                    Object.values(this.allAccounts).forEach((acc, i) => {
                        let val = 0;
                        if (this.FullEarn[i]) {
                            val = this.FullEarn[i];
                        }
                        let walletModel = {
                            img: "bitcoin_img.png",
                            name: acc.name,
                            shortName: "BTC",
                            value: val.toFixed(8),
                            dollarValue: 0,
                            rubleValue: 0,
                        };
                        Vue.set(arr, i, walletModel);
                    });
                }
            }
            return arr;
        },
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
        axios
            .get("https://api.minerstat.com/v2/coins?list=BTC,BCH,BSV")
            .then((response) => (this.dollar = response.data[0].price));
        setTimeout(() => {
            axios
                .get("https://www.cbr-xml-daily.ru/latest.js")
                .then((response) => (this.ruble = response.data.rates.USD));
        }, 100);
    },
    data() {
        return {
            miningCash: 0,
            isChecked: false,
            viewportWidth: 0,
            ruble: 0,
            dollar: 0,
        };
    },
    methods: {
        checkboxer(is_checked) {
            this.isChecked = is_checked;
            setTimeout(() => {
                if (this.$refs.list) {
                    if (this.viewportWidth > 768) {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                48 + 46 + this.$refs.list.offsetHeight + "px";
                        }, 1);
                    } else {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                40 + 114 + this.$refs.list.offsetHeight + "px";
                        }, 1);
                    }
                } else {
                    if (this.viewportWidth > 768) {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                48 + 46 + this.$refs.noInfo.offsetHeight + "px";
                        }, 1);
                    } else {
                        setTimeout(() => {
                            this.$refs.wallets.style.height =
                                40 +
                                114 +
                                this.$refs.noInfo.offsetHeight +
                                "px";
                        }, 1);
                    }
                }
            }, 100);
        },
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    mounted() {
        document.title = "Кошельки";
    },
    props: ["errors", "message", "user", "auth_user"],
};
</script>
<style lang="scss" scoped>
.wallets {
    &__title {
        font-family: AmpleSoftPro, serif;
        font-style: normal;
        color: #000;
        margin: 0 0 16px;
        font-weight: 700;
        font-size: 24px;
        line-height: 30px;
        width: 100%;
        display: inline-flex;
        justify-content: space-between;
        @media (max-width: 479.89px) {
            font-size: 21px;
            line-height: 26px;
        }
        @media (max-width: 767.98px) {
            position: relative;
            margin-bottom: 90px !important;
            flex-direction: column;
            &:after {
                content: "";
                height: 1px;
                position: absolute;
                bottom: -20px;
                left: 0;
                width: 100%;
                background-color: #d7d8d9;
            }
        }
    }

    // .wallets__filter
    &__filter {
        line-height: 23px;
        font-size: 16px;
        color: #99acd3;
        @media (max-width: 767.98px) {
            position: absolute;
            left: 0;
            bottom: calc(-40px - 100%);
        }
        @media (max-width: 479.98px) {
            width: 100%;
        }
    }

    .title {
        margin: 49px 0 24px;
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: space-between;
    }

    &__list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        transition: all 0.3s ease 0s;
        @media (max-width: 991.98px) {
            grid-template-columns: repeat(3, 1fr);
        }
        @media (max-width: 767.98px) {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            .wallets__block {
                border-radius: 12px;
                border: none;
            }
        }
        @media (max-width: 479.98px) {
            grid-template-columns: repeat(1, 1fr);
        }
    }

    // .wallets__block
    &__block {
        padding: 16px;
        background-color: #fff;
        border-radius: 13px;
        width: 100%;

        &-wallet {
            width: 100%;
            padding: 12px 0;
            transition: all 0.5s ease;
            @media (max-width: 767.98px) {
                padding: 14px 0;
            }

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
            padding: 0 16px 16px;
            border-bottom: 1px solid #e8ecf2;
            @media (max-width: 767.98px) {
                padding: 0 10px 10px;
            }

            img {
                margin-right: 16px;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                @media (max-width: 767.98px) {
                    margin-right: 6px;
                }
            }

            span {
                font-weight: 500;
                font-size: 18px;
                line-height: 26px;
                color: #000000;
                @media (max-width: 991.98px) {
                    font-size: 16px;
                    line-height: 23px;
                }
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
            @media (max-width: 767.98px) {
                width: 20px;
                gap: 2.5px;
            }

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
            padding: 16px 16px 0;
            margin-bottom: 8px;
            font-weight: 400;
            font-size: 20px;
            line-height: 28px;
            color: #0000009e;
            width: 100%;
            @media (max-width: 767.98px) {
                padding: 10px 10px 0;
                font-weight: 500;
                font-size: 16px;
                line-height: 23px;
                color: #000034;
                margin-bottom: 0;
                span {
                    font-weight: 500;
                }
            }

            span {
                font-weight: 700;
                color: #000034;
            }
        }

        &_convert {
            padding: 0 16px;
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
            color: rgba(0, 0, 0, 0.62);
            @media (max-width: 767.98px) {
                color: #000034;
            }
        }

        .wallets__subtitle {
            font-weight: 400;
            font-size: 16px;
            line-height: 23px;
        }
    }

    // .wallets__button
    &__button {
        color: #68809d;
        background: #fff;
        min-width: 179px;
        box-shadow: none;
        transform: translate(0, 0);
        max-height: 51px;
        gap: 10px;
        @media (max-width: 991.98px) {
            min-width: 160px;
            height: 38px;
        }
        @media (max-width: 767.98px) {
            font-size: 18px;
            line-height: 22px;
            width: 100%;
            min-width: 120px;
            &:before {
                content: none;
            }
        }
        @media (max-width: 479.98px) {
            flex-direction: column;
            gap: 6px;
            min-height: 54px;
            min-width: 0;
            font-size: 12px;
            line-height: 14px;
            padding: 0;
        }

        &:first-child {
            margin-left: 0;
        }

        svg {
            stroke: #68809d;
            transition: all 0.3s ease;
            @media (max-width: 767.98px) {
                width: 20px;
                height: 20px;
                stroke: #68809d;
                margin-right: 6px;
            }
            @media (max-width: 479.98px) {
                margin: 0;
            }
        }

        &::before {
            z-index: -1;
            content: "";
            position: absolute;
            background: transparent;
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            transition: all 0.3s ease 0s;
            @media (max-width: 767.98px) {
                background: #fff;
            }
        }

        @media (any-hover: hover) {
            &:hover {
                background-color: #4182ec;
                color: #fff;

                &:before {
                    background: linear-gradient(
                        84.14deg,
                        rgba(63, 123, 221, 0.27) 8.75%,
                        rgba(66, 130, 236, 0.27) 92.01%
                    );
                }

                svg {
                    stroke: #fff;
                }
            }
        }
        // .wallets__button-history
        &-history {
            min-height: 51px;
            color: #fff;
            background-color: #4182ec;
            min-width: 210px;
            padding: 0;

            &:before {
                background: linear-gradient(
                    84.14deg,
                    rgba(63, 123, 221, 0.27) 8.75%,
                    rgba(66, 130, 236, 0.27) 92.01%
                );
            }

            a {
                width: 100%;
                height: 100%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            @media (min-width: 767.98px) {
                font-size: 20px;
                line-height: 28px;
            }
            @media (max-width: 767.98px) {
                width: auto;
                min-height: 48px;
                min-width: 150px;
                &:before {
                    content: none;
                }
            }
            @media (max-width: 479.98px) {
                min-height: 28px;
                height: auto;
                font-size: 14px;
                line-height: 20px;
                min-width: 90px;
            }
        }
    }

    // .wallets__wrap
    &__wrap {
        margin-bottom: 40px;
        background: rgba(255, 255, 255, 0.29);
        border-radius: 21px;
        width: 100%;
        padding: 24px 16px;
        @media (max-width: 1270px) {
            padding: 20px;
        }
        @media (max-width: 767.98px) {
            margin: 0 -15px 20px;
            width: calc(100% + 30px);
        }
        @media (max-width: 479.98px) {
            margin: 0 -20px 20px;
            width: calc(100% + 40px);
        }

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
        @media (max-width: 767.98px) {
            flex-direction: column;
            gap: 0;
            background-color: #fff;
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            padding: 4px 10px;
        }
        @media (max-width: 767.98px) {
            .wallets__block {
                padding: 10px 0 10px;
                border-top: 1px solid #d7d8d9;
                border-radius: 0;

                &:last-child {
                    padding: 10px 0 0;
                }

                &:first-child {
                    border-top: none;
                    padding: 0 0 10px;
                }
            }
        }
        // .wallets__row-balance
        &-balance {
            gap: 0;
            justify-content: space-between;
            margin-bottom: 16px;
            h3 {
                margin-bottom: 0;
                @media (max-width: 767.98px) {
                    margin-bottom: 30px !important;
                }
            }
            @media (max-width: 767.98px) {
                background-color: transparent;
                padding: 0;
                border: none;
                .wallets__column {
                    gap: 0;
                    background-color: #fff;
                    border: 0.5px solid rgba(0, 0, 0, 0.08);
                    border-radius: 8px;
                    padding: 10px 10px;
                    margin-bottom: 10px;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                }
            }
            @media (max-width: 479.98px) {
                .wallets__column {
                    padding: 4px 10px;
                    flex-direction: column;
                    align-items: flex-start;
                }
            }
        }
    }

    // .wallets__column
    &__column {
        display: flex;
        flex-direction: column;
        @media (max-width: 767.98px) {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        @media (max-width: 479.98px) {
            gap: 0;
            flex-direction: column;
            align-items: flex-start;
        }
    }

    // .wallets__subtitle
    &__subtitle {
        font-weight: 500;
        font-size: 18px;
        line-height: 26px;
        color: rgba(0, 0, 0, 0.62);
        margin-bottom: 8px;
        @media (max-width: 767.98px) {
            margin-bottom: 0;
            font-size: 14px;
            line-height: 20px;
            font-weight: 400;
        }
    }

    // .wallets__value
    &__value {
        color: #000034;
        font-weight: 500;
        font-size: 24px;
        line-height: 34px;
        @media (max-width: 767.98px) {
            margin-left: 5px;
            font-size: 21px;
            line-height: 30px;
        }
        @media (max-width: 479.98px) {
            margin-left: 0;
        }

        span {
            font-weight: 700;
        }
    }

    // .wallets__buttons
    &__buttons {
        display: flex;
        gap: 16px;
        @media (max-width: 767.98px) {
            width: 100%;
            justify-content: space-between;
            gap: 11px;
        }
    }
}
</style>
