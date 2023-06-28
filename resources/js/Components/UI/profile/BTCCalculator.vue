<template>
    <div class="BTC__block">
        <span class="text text-md">{{ title }}</span>
        <div class="BTC__value text text-md text-blue">
            <b>{{ Number(clearBTC).toFixed(8) }} BTC</b>
            <span class="text text-md">{{ dollarCalc.toFixed(2) }} $</span>
            <span class="text text-md" v-if="this.$i18n.locale === 'ru'"
                >{{ rubleCalc.toFixed(2) }} ₽</span
            >
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    props: {
        BTC: {
            type: Number,
            default: 0,
        },
        title: String,
        clearProfit: Number,
    },
    data() {
        return {
            dollarCalc: 0,
            rubleCalc: 0,
            clearBTC: 0,
        };
    },
    watch: {
        BTC() {
            this.calculator();
        },
    },
    methods: {
        calculator() {
            this.clearBTC = this.BTC;
            axios
                .get("https://api.minerstat.com/v2/coins?list=BTC,BCH,BSV")
                .then((response) => {
                    this.dollarCalc = this.BTC * response.data[0].price;
                    if (this.clearProfit && this.BTC !== 0) {
                        this.dollarCalc = this.dollarCalc - this.clearProfit;
                        this.clearBTC =
                            this.dollarCalc / response.data[0].price;
                    }
                });
            setTimeout(() => {
                axios
                    .get("https://www.cbr-xml-daily.ru/latest.js")
                    .then((response) => {
                        this.rubleCalc =
                            this.dollarCalc / response.data.rates.USD;
                    });
            }, 200);
        },
    },
    mounted() {
        this.calculator();
    },
    // updated() {
    //     this.calculator();
    // },
    name: "btc-calculator",
};
</script>
<style lang="scss" scoped>
.BTC {
    &__block {
        display: flex;
        flex-direction: column;
        position: relative;
        gap: 4px;
    }

    &__value {
        display: inline-flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
        @media (max-width: 479.98px) {
            gap: 0 5px;
        }

        span {
            white-space: nowrap;
            display: inline-flex;
            gap: 5px;
            @media (max-width: 479.98px) {
                gap: 0 5px;
                font-weight: 500;
            }

            &::before {
                content: "≈";
            }

            &:last-child {
                margin-right: 0;
            }
        }
    }
}
</style>
