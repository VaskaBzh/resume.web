<template>
    <article class="rate-container">
        <div class="rate-block">
            <span class="rate-title">BTC</span>
            <span class="rate-current-price"> ${{ price }}</span>
        </div>
        <div v-if="isRu && isUSD" class="rate-block">
            <span class="rate-title">USD</span>
            <span class="rate-current-price">{{ currentUSD }}₽</span>
        </div>
    </article>
</template>
<script>
import { mapGetters } from "vuex";
import axios from "axios";

export default {
    name: "CurrentExchangeRate",
    data() {
        return {
            currentUSD: null,
            isRu: false,
            interval: null,
            intervalUsd: null,
            price: "",
        };
    },
    computed: {
        ...mapGetters(["btcInfo", "currency"]),
        isUSD() {
            return !!this.currentUSD;
        },
    },
    watch: {
        async "$i18n.locale"() {
            await this.getUSD();
        },
    },
    async mounted() {
        await this.getUSD();

        const response = await this.fetchPrice();

        this.price = Number(response).toFixed(0);
        await this.setBitcoinCourse();
    },
    unmounted() {
        clearInterval(this.interval);
        if (this.intervalUsd) {
            clearInterval(this.intervalUsd);
        }
    },
    methods: {
        async getUSD() {
            if (this.$i18n.locale === "ru") {
                this.isRu = true;

                if (this.intervalUsd) {
                    clearInterval(this.intervalUsd);
                }

                this.currentUSD = (1 / this.currency.rates.USD).toFixed(2);

                this.intervalUsd = setInterval(async () => {
                    try {
                        const response = (
                            await axios.get(
                                "https://www.cbr-xml-daily.ru/latest.js"
                            )
                        ).data;
                        this.currentUSD = (1 / response.rates.USD).toFixed(2);
                    } catch (err) {
                        console.error(err);
                    }
                }, 5000);
            } else {
                this.isRu = false;
            }
        },
        async fetchPrice() {
            return (
                await axios.get(
                    "https://testnet.binancefuture.com/fapi/v1/premiumIndex?symbol=BTCUSDT"
                )
            ).data.indexPrice;
        },
        async setBitcoinCourse() {
            this.interval = setInterval(async () => {
                const response = await this.fetchPrice();

                this.price = Number(response).toFixed(0);
            }, 5000);
        },
    },
};
</script>
<style scoped>
.rate-container {
    /* width: 16%; */
    display: flex;
    justify-content: end;
    gap: 24px;
    font-family: Unbounded;
}

@media (max-width: 410px) {
    .rate-container .rate-block:not(:nth-child(1)) {
        display: none;
    }
}

.rate-block {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(128, 128, 154, 1);
}

.rate-title {
    color: var(--text-teritary);
    font-size: 14px;
    font-style: normal;
    font-weight: bold;
    line-height: 20px; /* 142.857% */
}

.rate-current-price {
    color: var(--text-primary);
    opacity: 0.8;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: 20px; /* 142.857% */
}
</style>
