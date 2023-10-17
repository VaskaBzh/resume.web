<template>
  <article class="rate-container">
    <div class="rate-block">
      <span class="rate-title">BTC</span>
      <span class="rate-current-price"> ${{ price }}</span>
    </div>
    <div class="rate-block" v-if="isRu && isUSD">
      <span class="rate-title">USD</span>
      <span class="rate-current-price">{{ currentUSD }}₽</span>
    </div>
  </article>
</template>
<script>
import {mapGetters} from "vuex";
import axios from "axios";

export default {
  name: "current-exchange-rate",
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
  methods: {
    async getUSD() {
      if (this.$i18n.locale === "ru") {
        this.isRu = true;

        if (this.intervalUsd) {
          clearInterval(this.intervalUsd);
        }

        this.currentUSD = (1 / this.currency.rates.USD).toFixed(2);

        this.intervalUsd = setInterval(async () => {
          const response = (
              await axios.get(
                  "https://www.cbr-xml-daily.ru/latest.js"
              )
          ).data;
          this.currentUSD = (1 / response.rates.USD).toFixed(2);
        }, 5000);
      } else {
        this.isRu = false;
      }
    },
    async setBitcoinCourse() {
      const response = await axios({
        method: "get",
        url: `https://blockchain.info/q/24hrprice`,
        xhrFields: {
          withCredentials: true,
        },
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Access-Control-Allow-Headers": "*",
          "Access-Control-Allow-Methods": "GET",
          "Access-Control-Allow-Credentials": "true",
          "Content-Type": "application/json;charset=utf-8",
        },
      });

      this.price = response;
    },
  },
  async mounted() {
    await this.getUSD();

    await this.setBitcoinCourse();
    this.interval = setInterval(await this.setBitcoinCourse, 5000);
  },
  unmounted() {
    clearInterval(this.interval);
    if (this.intervalUsd) {
      clearInterval(this.intervalUsd);
    }
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
  font-weight: 400;
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
