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
    <div class="img-container">
      <img src="./images/Calculator.png" class="calc-img">
      <div class="img-text">
        <!-- <div class="income-inf-card"> -->
        <p class="title-inf-card">Доход</p>
        <div class="content-inf-card">
          <div>
            <span class="count-data-btc">0.0002269</span>
            <span class="count-title-btc"> BTC</span>
          </div>
          <p class="count-dara-ruble">$54.1 ≈ ₽4956.23</p>
        </div>
        <p class="title-inf-card">Затраты*</p>
        <div class="content-inf-card">
          <div>
            <span class="count-data-btc">0.0002269</span>
            <span class="count-title-btc"> BTC</span>
          </div>
          <p class="count-dara-ruble">$54.1 ≈ ₽4956.23</p>
        </div>
    </div>
      </div>
    </div>
    <!-- </div> -->

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
    // border-radius: 24px;
    background: var(--light-secondary-color-1, #FFF);
    // box-shadow: 2px 2px 4px -2px rgba(29, 41, 57, 0.05), 0px 4px 12px -4px rgba(29, 41, 57, 0.05);
    display: flex;
    margin: 12px 0 8px 0;
    padding: 16px;
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
    align-self: stretch;
    color: #F5FAFF;
  }
//   .income-inf-card{

// }
.content-inf-card{
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.title-inf-card{
  color: var(--gray-400, #98A2B3);
  font-size: 11px;
  font-weight: 400;
  line-height: 13px; /* 118.182% */
  letter-spacing: 0.066px;
}
.count-data-btc{
  color: var(--light-gray-700, #344054);
  font-size: 17px;
  font-weight: 400;
  line-height: 22px; /* 129.412% */
  letter-spacing: -0.408px;
}
.count-title-btc{
  color: var(--light-gray-700, #344054);
font-size: 11px;
font-weight: 600;
line-height: 13px;
letter-spacing: 0.06px;
}
.count-dara-ruble{
  color: var(--light-gray-300, #D0D5DD);
  font-size: 13px;
  font-weight: 400;
  line-height: 18px; /* 138.462% */
  letter-spacing: -0.078px;
}
</style>