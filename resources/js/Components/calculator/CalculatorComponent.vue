<template>
  <article>
    <main-title
      tag="h2"
      class="home__title page__title title-blue"
      v-scroll="'left delay--md'"
    >
      {{ $t("home.calculator.title") }}
    </main-title>  
    <div class="calculator-container">
      <div class="input-block"  v-scroll="'left delay--md'">
      <div
       class="description description-sm"
      >
        {{ $t("home.calculator.text") }}
      </div>
      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[0]")'>
        <span class="unit">
            TH/s
        </span>
      </div>

      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[1]")'>
      </div>

      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[2]")'>
        <span class="unit">
          W
        </span>
      </div>

      <div class="input-container">
        <input :placeholder='$t("home.calculator.placeholder[3]")'>
        <span class="unit">
          р/кВт
        </span>
      </div>
      <div class="button-container">
        <button class="blue-button big">Расчитать</button>
      </div>
    </div>
    <div class="img-container" v-scroll="'left delay--md'">
      <img src="./images/Calculator.png" class="calc-img">
      <div class="img-text">
        <p class="title-calc-img">Доход</p>
        <div class="content-calc-img">
          <div>
            <span class="count-data-btc">0.0002269 BTC</span>
          </div>
          <p class="count-dara-ruble">$54.1 ≈ ₽4956.23</p>
        </div>

        <p class="title-calc-img">Расходы</p>
        <div class="content-calc-img">
          <div>
            <span class="count-data-btc">0.0002269 BTC</span>
          </div>
          <p class="count-dara-ruble">$54.1 ≈ ₽4956.23</p>
        </div>
      </div>
      </div>
    </div>

  </article>
</template>
<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import CalculatorInput from './CalculatorInput.vue'

export default {
    components: {
      MainTitle,
      CalculatorInput,
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
    width: 49%;
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
</style>