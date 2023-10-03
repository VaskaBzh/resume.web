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
      <div class="flex-column">
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
  align-items: baseline;
}
@media(max-width:500px){
  .flex-jc{
    align-items: center;
  }
  .title{
    margin-bottom: 0px;
  }
}
.icome-container{
  width: 100%;
}
.title{
  color: var(--text-teritary);
  font-family: NunitoSans;
  font-size: 14px;
  font-weight: 600;
  line-height: 142%; /* 20.3px */
  margin-bottom: 4px;
}
.data-num{
  color: var(--text-primary);
  font-family: Unbounded;
  font-size: 27px;
  font-style: normal;
  font-weight: 400;
  line-height: 147%; /* 39.69px */
}
@media(max-width:900px){
  .data-num{
    font-size: 20px;
  }
}
.btc-gray-text{
  color: var(--text-fourth);
  font-family: Unbounded;
  font-size: 20px;
  font-style: normal;
  font-weight: 400;
  line-height: 160%; /* 32px */
  margin-left: 8px;
}
@media(max-width:500px){
  .btc-gray-text{
    font-size: 14px;
  }
  .title{
    font-size: 12px;
    margin-bottom: 0px;

  }
}
.rub-counter-text{
  color: var(--text-fourth);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 20px; /* 142.857% */
}
@media(max-width:900px){
  .rub-counter-text{
    font-size: 10px;
  }
}
@media(max-width:1100px){
  .flex-column{
    display: flex;
    flex-direction: column;
    align-items: end;
  }
}
</style>