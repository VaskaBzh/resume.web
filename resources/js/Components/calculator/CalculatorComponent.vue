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
      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[0]")' v-model="calculatorService.inputs[0]">
        <span class="unit">
            TH/s
        </span>
      </div>
      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[1]")' v-model="calculatorService.inputs[1]">
      </div>

      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[2]")' v-model="calculatorService.inputs[2]">
        <span class="unit">
          W
        </span>
      </div>
      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[3]")' v-model="calculatorService.inputs[3]">
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
          <p class="title-calc-img">{{ $t("home.calculator.img_title[0]") }}</p>
          <div class="content-calc-img">
            <div>
              <span class="count-data-btc">{{ incomeValue }} BTC</span>
            </div>
            <p class="count-dara-ruble">$54.1 ≈ ₽4956.23</p>
          </div>
        </div>
        <div class="row-calc">
          <p class="title-calc-img">{{ $t("home.calculator.img_title[1]") }}</p>
          <div class="content-calc-img">
            <div>
              <span class="count-data-btc">0.0002269 BTC</span>
            </div>
            <p class="count-dara-ruble">$54.1 ≈ ₽4956.23</p>
          </div>
        </div>
      </div>
      </div>
    </div>

  </article>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import CalculatorInput from './CalculatorInput.vue'
// import { LightCalculatorService } from '../../modules/calculator/services/LightCalculatorService'
import { CalculatorService } from './CalculatorService'
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
        this.isCalculate = true
        this.incomeValue = await this.calculatorService.getProfit(num)
        await this.calculatorService.getCost()
        this.consumptionVulue = this.calculatorService.cost
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
  input{
    width: 100%;
    border-radius: 8px;
    background: #FFF;
    padding: 20px 16px;
    border: 1px solid transparent;
    outline: none;
  }
  input::placeholder{
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
    gap: 8px;
    align-self: stretch;
    color: #F5FAFF;
  }
  .calc-img{
    // filter: blur(50px);
  }
  .content-calc-img{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .title-calc-img{
    color: #FFF;
    font-size: 16px;
    font-weight: 400;
    line-height: 135%; /* 21.6px */
    opacity: 0.7;
    padding-bottom: 8px;
  }
  .count-data-btc{
    color: #FFF;
    font-size: 18px;
    font-weight: 500;
    line-height: 135%; /* 24.3px */
  }
  .count-dara-ruble{
    color: var(--blue-10, #ECF2FC);
    font-size: 14px;
    font-weight: 400;
    line-height: 135%; /* 18.9px */
  }
  .calculator-description{
    padding: 4px 0 48px;
  }
  .row-calc{
    width: 100%;
  }
  .input-container{
    @media (max-width: $pc) {
      width: 49.4%;
    }
    @media (max-width: $mobile) {
      width: 100%;
    }
  }
  .calc-img{
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
  .count-dara-ruble{
    @media (max-width: $pc) {
      color: var(--dark-theme-gray, #989898);
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

</style>