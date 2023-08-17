<template>
  <article  v-scroll="'left delay--md'">
    <main-title
      tag="h2"
      class="home__title page__title title-blue"
      v-scroll="'left delay--md'"
    >
      {{ $t("home.calculator.title") }}
    </main-title>  
    <div class="calculator-container">
      <div class="input-block">
      <div
       class="description description-sm calculator-description"
      >
        {{ $t("home.calculator.text") }}
      </div>
      <p v-show="notificationCalc" class="notification-calc-red">{{ $t("home.calculator.notification_calc") }}</p>
      <div class="input-container">
        <input type="number" :placeholder='$t("home.calculator.placeholder[0]")' class="input-calc" :class="{'error-border': isHashrate}" v-model="calculatorService.inputs[0]">
        <span class="unit">
            TH/s
        </span>
      </div>
      <div class="input-container">
        <input type="number" :placeholder='$t("home.calculator.placeholder[1]")' class="input-calc" :class="{'error-border': isWorkers}" v-model="calculatorService.inputs[1]">
      </div>

      <div class="input-container">
        <input type="number"  :placeholder='$t("home.calculator.placeholder[2]")' class="input-calc" :class="{'error-border': isPower}" v-model="calculatorService.inputs[2]">
        <span class="unit">
          W
        </span>
      </div>
      <div class="input-container">
        <input type="number"  :placeholder='$t("home.calculator.placeholder[3]")' class="input-calc" :class="{'error-border': isExpenses}" v-model="calculatorService.inputs[3]">
        <span class="unit">
          р/кВт
        </span>
      </div>
      <div class="button-container">
        <button class="blue-button big" @click="calculateYield(720)">{{ $t("home.calculator.button") }}</button>
      </div>
    </div>
    <div class="img-container">
      <img src="./images/Calculator.png" class="calc-img">
      <div class="img-text" v-show="isCalculate"  v-scroll="'left delay--md'">

        <div class="row-calc">
          <div class="btc-container">
            <p class="title-calc-img">{{ $t("home.calculator.img_title[0]") }}</p>
            <span class="count-data-btc">{{ incomeValue }}</span>
            <span class="count-unit"> BTC</span>
          </div>
          <div class="count-data-ruble" v-if="$i18n.locale === 'ru'">
              <span class="count-data-text">${{  Number(converterIncome?.usd ).toFixed(2) }} ≈ </span>
              <span class="count-data-text"> ₽{{ Number(converterIncome?.rub ).toFixed(2) }}</span>
          </div>
        </div>
        <div class="row-calc">
          <div>
            <p class="title-calc-img">{{ $t("home.calculator.img_title[1]") }}</p>
            <span class="count-data-btc">{{ consumptionVulue }}</span>
            <span class="count-unit"> BTC</span>
          </div>
          <div class="count-data-ruble" v-if="$i18n.locale === 'ru'">
              <span class="count-data-text">${{  Number(converterConsumption?.usd ).toFixed(2) }} ≈ </span>
              <span class="count-data-text"> ₽{{ Number(converterConsumption?.rub ).toFixed(2) }}</span>
          </div>
        </div>
      </div>
      <div class="img-blur"></div>
    </div>
    </div>
  </article>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import CalculatorInput from './CalculatorInput.vue'
import { CalculatorService } from './CalculatorService'
import { Converter } from "../../Scripts/converter";
import { mapGetters } from "vuex";
export default {
    components: {
      MainTitle,
      CalculatorInput,
      CalculatorService
    },
    data() {
      return {
        isCalculate: false,
        calculatorService: new CalculatorService(),
        incomeValue: null,
        consumptionVulue: null,
        converterConsumption: null,
        converterIncome: null,
        isHashrate: false,
        isWorkers: false,
        isPower: false,
        isExpenses: false,
        notificationCalc: false
      }
    },
    computed: {
      ...mapGetters(['btcInfo']),
    },
    watch: {
        "btcInfo.btc"(newValue) {
            if (newValue) {
                this.calculatorService.setInputs(newValue);
            }
        },
    },
    methods: {
      async calculateYield(num) {
        this.checkedInput()
        if(Object.values(this.calculatorService.inputs).length == 4){
          this.notificationCalc = false
          this.isCalculate = true
          this.incomeValue = await this.calculatorService.getProfit(num)
          await this.calculatorService.getCost()
          this.consumptionVulue = this.calculatorService.cost
          this.initConverter()
        }
        else{
         this.notificationCalc = true
        }
      },
      async initConverter() {
            this.converterConsumption = new Converter(
                this.consumptionVulue,
                this.btcInfo.btc.price
            );
            this.converterIncome = new Converter(
                this.incomeValue,
                this.btcInfo.btc.price
            );           
            await this.converterIncome.convert();
            await this.converterConsumption.convert();
        },
        checkedInput(){
          this.calculatorService.inputs[0]? this.isHashrate = false : this.isHashrate = true;
          this.calculatorService.inputs[1]? this.isWorkers = false : this.isWorkers = true;
          this.calculatorService.inputs[2]? this.isPower = false : this.isPower = true;
          this.calculatorService.inputs[3]? this.isExpenses = false : this.isExpenses = true;
        }
    },
}
</script>
<style lang="scss" scoped>
.home {
    &__title {
        margin-bottom: 20px;
        @media (max-width: 479.98px) {
            font-size: 35px;
            line-height: 107.6%;
        }
    }
  }
  .input-block{
    width: 630px;
    height: 208px;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 8px;
  }
  .input-container{
    position: relative;
    width: 311px;
  }
  .unit{
    position: absolute;
    right: 12px;
    top: 16px;
    color: var(--light-theme-gray-3, #818C99);
    font-family: Ubuntu;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 135%; /* 24.3px */
  }
  .input-calc{
    width: 100%;
    border-radius: 8px;
    background: #FFF;
    padding: 20px 16px;
    border: 1px solid transparent;
    outline: none;
  }
  .input-calc::placeholder{
    color: var(--light-theme-gray-3, #818C99);
    font-family: Ubuntu;
    font-size: 18px;
    font-style: normal;
    font-weight: 300;
    line-height: 135%; /* 24.3px */
  }
  .button-container, button{
    width: 100% ;
  }
  .calculator-container{
    display: flex;
    width: 100%;
    justify-content: space-between;
  }
  .img-container{
    position: relative;
    margin-right: 70px;
    top: -32px;
  }
  .img-text{
    position: absolute;
    top: 0;
    width: 100%;
    display: flex;
    margin: 12px 0 8px 0;
    padding: 48px 59px;
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
    align-self: stretch;
    color: #F5FAFF;
  }
  .content-calc-img{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: end;
  }
  .row-calc{
    width: 100%;
    display: flex;
    justify-content: space-between;
  }
  .title-calc-img{
    color: #FFF;
    padding-bottom: 8px;
    font-size: 16px;
    font-weight: 400;
    line-height: 135%; /* 21.6px */
    opacity: 0.7;
  }
  .count-data-btc{
    color: #FFF;
    font-size: 18px;
    font-weight: 500;
    line-height: 135%; /* 24.3px */
  }
  .count-data-ruble{
    width: 50%;
    display: flex;
    justify-content: flex-end;
    flex-direction: column;
    text-align: end;
    color: var(--blue-10, #ECF2FC);
    font-size: 14px;
    font-weight: 400;
    line-height: 135%; /* 18.9px */
  }
  .calculator-description{
    padding: 4px 0 48px;
  }
  .count-unit{
    font-size: 12px;
  }
  .img-blur{
    position: absolute;
    bottom: -9px;
    width: 100%;
    background: rgba(141, 141, 141, 0.50);
    height: 68px;
    filter: blur(50px);
  }
  .error-border{
    border-radius: 8px;
    border: 1px solid var(--light-theme-red, #ED1818);
  }
  .notification-calc-red{
    width: 100%;
    color: var(--light-theme-red, #ED1818);
    font-size: 16px;
    font-weight: 400;
    line-height: 135%; /* 21.6px */
  }
  .input-container{
    @media (max-width: $pc) {
      width: 49.4%;
    }
    @media (max-width: $mobile) {
      width: 100%;
    }
  }
  .calc-img, .img-blur{
    @media (max-width: $pc) {
      display: none;
    }
  }
  .input-block{
    @media (max-width: $pc) {
      width: 100%;
      height: auto;
    }
  }
  .calculator-container{
    @media (max-width: $pc) {
      flex-direction: column;
    }
  }
  .calculator-description{
    @media (max-width: $pc) {
      padding: 4px 0 24px;
    }
  }
  .img-text{
    @media (max-width: $pc) {
      position:static;
      flex-direction: row;
      gap: 48px;
      border-radius: 16px;
      background: #FFF;
      padding: 16px 24px;
      box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.10);
    }
    @media (max-width: $mobile) {
      flex-direction: column;
      gap: 16px;
    }
  }
  .img-container{
    @media (max-width: $pc) {
      width: 100%;
      margin-right: 0;
      top: 0px;
    }
  }
  .title-calc-img{
    @media (max-width: $pc) {
      color: var(--light-theme-text, #7C7C7C);
    }
  }
  .count-data-btc{
    @media (max-width: $pc) {
      color: var(--light-theme-text, #7C7C7C);
    }
  }
  .count-data-text{
    @media (max-width: $pc) {
      color: var(--dark-theme-gray, #989898);
  }
  }
  .count-data-ruble{
    @media (max-width: $pc) {
      align-items: flex-end;
      margin-bottom: 2px;
    }
    @media (max-width: $mobile) {
      flex-direction: column;
    }
  }
  .content-calc-img{
    @media (max-width: $pc) {
      justify-content: flex-start;
      gap: 40px;
    }
    @media (max-width: $mobile) {
      justify-content: space-between;
      gap: 40px;
    }
  }
    .row-calc{
    @media (max-width: $mobile) {
      justify-content: space-between;;
    }
  }
</style>