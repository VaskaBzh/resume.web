<template>
  <article class="rate-container">
    <div class="rate-block">
      <span class="rate-title">BTC</span> 
      <span class="rate-current-price"> ${{ this.btcInfo.btc?.price }}</span>
    </div>
    <div class="rate-block" v-if="isRu && isUSD">
      <span class="rate-title">USD</span> 
      <span class="rate-current-price">{{ currentUSD }}₽</span>      
    </div>
  </article>
</template>
<script>
import { mapGetters } from "vuex";
import currency from "@/api/currency";
export default {
    name: "current-exchange-rate",
    data(){
      return{
        currentUSD: null,
        isRu: false,
      }
    },
    computed: {
        ...mapGetters(["btcInfo"]),
        isUSD() {
            if(this.currentUSD){
                return true
            }
            else{
                return false
            }
        },
    },
    methods: {
      async getUSD () {
        if(this.$i18n.locale === 'ru'){
          this.isRu = true
          this.currentUSD = (1 / (await currency()).data.rates.USD).toFixed(2)
        }
        else{
                this.isRu = false
            }
      }
    },
    mounted() {
      this.getUSD()
    }
    
};
</script>
<style scoped>
.rate-container{
  /* width: 16%; */
  display: flex;
  justify-content: end;
  gap: 24px;
}
.rate-block{
  display: flex;
  align-items: center;
  gap: 8px;
  color: rgba(128, 128, 154, 1);

}
.rate-title{
  color: var(--gray-400, #98A2B3);
  font-size: 14px;
  font-family: Unbounded;
  font-style: normal;
  font-weight: 400;
  line-height: 145%; /* 20.3px */
}
.rate-current-price{
  color: var(--text-primary-80);
  font-family: Unbounded;
  font-size: 14px;
  font-style: normal;
  font-weight: 400;
  line-height: 145%; /* 20.3px */
}
</style>