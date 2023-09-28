<template>
<div class="calculator-land">
    <div class="calculator-land__container">
        <head-line class="calculator-land_title_default">калькулятор доходности</head-line>
        <h3 class="calculator-land_title">
            <span>рассчитайте</span>
            <span class="calculator-land_title_one">свой доход</span>
            <span class="calculator-land_title_two">с помощью </span>
            <span class="calculator-land_title_three">калькулятора</span>
            <span class="calculator-land_title_four">доходности</span>
        </h3>
        <h4 class="calculator-land_subtitle">Позволяет
            оценить и спрогнозировать возможный
            приблизательный доход и прибыль за о
            пределенный период. Фактические доходы м
            огут незначительно отличаться.
        </h4>
        <light-calculator-view class="calculator-land_content"/>
    </div>
</div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import LightCalculatorView from "../../../calculator/Components/views/LightCalculatorView.vue";


export default {
    name: "CalculatorLand",
    components: {LightCalculatorView, HeadLine}
}
</script>


<style scoped lang="scss">
.calculator-land {
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: center;
    padding-top: 96px;
    border-radius: 70px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: var(--gray-4100, #0D0D0D);
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    &__container {
        margin: 0 auto;
    }

    &_title {
        width: fit-content;
        color: #F5FAFF;
        display: flex;
        flex-flow: column nowrap;
        margin: 0 auto 40px;
        justify-content: center;
        text-shadow: 0px 4.897561073303223px 8.570732116699219px rgba(14, 14, 14, 0.05);
        font-family: Unbounded, serif;
        font-size: 46px;
        font-style: normal;
        font-weight: 600;
        line-height: 100%;
        text-transform: uppercase;

        &_one {
            position: relative;
            left: -100px;
            top: 0;
        }
        &_two {
            position: relative;
            left: 50px;
            top: 0;
        }

        &_three {
            position: relative;
            left: 50px;
            top: 0;
        }

        &_text {
            display: block;
            position: relative;
        }

    }

    &_subtitle {
        color: rgba(245, 250, 255, 0.70);
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans, serif;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
        margin: 0 auto;
        width: 420px;
    }

}
</style>
