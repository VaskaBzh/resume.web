<template>
  <article class="rate-container">
    <div class="rate-block">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
        <g clip-path="url(#clip0_1421_33544)">
          <path d="M18 9C18 10.78 17.4722 12.5201 16.4832 14.0001C15.4943 15.4802 14.0887 16.6337 12.4442 17.3149C10.7996 17.9961 8.99002 18.1743 7.24419 17.8271C5.49836 17.4798 3.89472 16.6226 2.63604 15.364C1.37737 14.1053 0.520204 12.5016 0.172937 10.7558C-0.17433 9.00998 0.00389952 7.20038 0.685088 5.55585C1.36628 3.91131 2.51983 2.50571 3.99987 1.51677C5.47991 0.527841 7.21997 0 9 0C11.387 0 13.6761 0.948212 15.364 2.63604C17.0518 4.32387 18 6.61305 18 9Z" fill="#F7931A"/>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M6.39752 4.10961L8.46588 4.66352L8.92816 2.94043L9.96234 3.22107L9.51806 4.87298L10.3616 5.09961L10.8067 3.4297L11.8589 3.71116L11.4056 5.39007C11.4056 5.39007 13.1238 5.77052 13.528 7.16798C13.9322 8.56543 12.6394 9.29934 12.2402 9.32716C12.2402 9.32716 13.7456 10.1527 13.2285 11.7768C12.7114 13.4009 11.1242 13.6913 9.45425 13.3191L9.00097 15.0602L7.94879 14.7787L8.41107 13.0646L7.57652 12.8372L7.11425 14.5635L6.07025 14.2829L6.53334 12.5647L4.41016 11.992L4.94525 10.804C4.94525 10.804 5.54416 10.9676 5.77079 11.0216C5.99743 11.0756 6.14307 10.84 6.20688 10.6043C6.2707 10.3687 7.23206 6.46352 7.32288 6.14198C7.4137 5.82043 7.37688 5.56925 6.99561 5.47025C6.61434 5.37125 6.09561 5.21661 6.09561 5.21661L6.39752 4.10961ZM8.48388 9.28134L7.91116 11.5583C7.91116 11.5583 10.7511 12.5835 11.1143 11.1411C11.4776 9.69861 8.48388 9.28134 8.48388 9.28134ZM8.74734 8.20134L9.30943 6.11498C9.30943 6.11498 11.7411 6.55025 11.4416 7.71125C11.1422 8.87225 9.7087 8.42716 8.74734 8.20134Z" fill="white"/>
        </g>
        <defs>
          <clipPath id="clip0_1421_33544">
            <rect width="18" height="18" fill="white"/>
          </clipPath>
        </defs>
      </svg>
      <span class="rate-title">BTC</span> 
      <span class="rate-current-price"> ${{ this.btcInfo.btc?.price }}</span>
    </div>
    <div class="rate-block" v-if="isRu && isUSD">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
        <path d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z" fill="#5EBF09"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6562 10.7741C12.6562 12.2197 11.4829 13.1794 9.75037 13.3239V14.625H8.5635V13.311C7.39163 13.1789 6.27822 12.7287 5.34375 12.0094L6.21675 10.8135C6.99469 11.4182 7.731 11.8125 8.61806 11.9441V9.36787C6.62625 8.86837 5.69869 8.14556 5.69869 6.66056C5.69869 5.24137 6.858 4.26881 8.5635 4.13719V3.375H9.75037V4.16363C10.678 4.26666 11.5624 4.61111 12.3154 5.16263L11.5509 6.39787C10.9507 5.96419 10.3371 5.688 9.69581 5.55694V8.05387C11.7697 8.55337 12.6562 9.35494 12.6562 10.7741ZM8.6175 7.77769V5.46469C7.75856 5.5305 7.30856 5.99063 7.30856 6.56888C7.30856 7.12013 7.56731 7.47563 8.61806 7.77825L8.6175 7.77769ZM11.0464 10.8658C11.0464 10.2752 10.7595 9.92025 9.69581 9.61762V11.997C10.5553 11.9306 11.0464 11.4969 11.0464 10.8664V10.8658Z" fill="white"/>
    </svg>
      <span class="rate-title">USD</span> 
      <span class="rate-current-price">₽{{ currentUSD }}</span>      
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
  gap:4px;
  color: rgba(128, 128, 154, 1);

}
.rate-title{
  font-size: 16px;
  font-weight: 500;
}
.rate-current-price{
  font-size: 14px;
  padding-left: 4px;
}
</style>