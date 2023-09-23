<template>
  <div class="icome-container">
    <p class="title" >
      <slot name="title"></slot>
    </p>
    <div class="flex-jc">
      <div class="data-container">
        <span class="data-num">
          <slot name="num"></slot>
        </span>
        <span class="btc-gray-text">BTC</span>
      </div>
      <div>
        <span class="rub-counter-text"> ≈ {{ converter?.usd }} $ </span>
        <span class="rub-counter-text" v-if="$i18n.locale === 'ru'"> 
          ≈ {{ converter?.rub }} ₽
          </span>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import { Converter } from "@/Scripts/converter";
export default {
  computed: {
        ...mapGetters([
            "btcInfo",
        ]),
      },
    data() {
        return {
            converter: null,
            BTC: 0,
        };
    },
    methods: {
        async updateConversion() {
            this.converter = new Converter(
                this.BTC,
                this.btcInfo?.btc ? this.btcInfo.btc.price : 0
            );
            await this.converter.convert();
        },
    },
    created() {
        this.updateConversion();
    },
    watch: {
        btcInfo: {
            immediate: true,
            handler() {
                this.updateConversion();
            },
        },
        BTC: {
            immediate: true,
            handler() {
                this.updateConversion();
            },
        },
    },
}
</script>
<style scoped>
.flex-jc{
  display: flex;
  width: 100%;
  justify-content: space-between;
  align-items: center;
}
.icome-container{
  width: 100%;
}
.title{
  color: var(--gray-400, #98A2B3);
  font-family: NunitoSans;
  font-size: 14px;
  font-weight: 600;
  line-height: 145%; /* 20.3px */
  margin-bottom: 4px;
}
.data-num{
  color: var(--text-primary, #1D2939);
  font-family: Unbounded;
  font-size: 27px;
  font-style: normal;
  font-weight: 400;
  line-height: 147%; /* 39.69px */
}
.btc-gray-text{
  color: var(--gray-300, #D0D5DD);
  font-family: Unbounded;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 160%; /* 32px */
  margin-left: 8px;
}
.rub-counter-text{
  color: var(--gray-300, #D0D5DD);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 145%; /* 20.3px */
}
</style>