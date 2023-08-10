<template>
    <div class="calculator__main">
        <calculator-title class="title-white title-h1 calculator_title">
            Рассчитайте свой
            доход с помощью
            калькулятора
            доходности
        </calculator-title>
        <p class="calculator_text">
            Позволяет оценить и спрогнозировать возможный приблизательный доход и прибыль за определенный период. Фактические доходы могут незначительно отличаться.
        </p>
        <calculator-button @click.prevent="$emit('swipePage', 'light')" class="calculator_button">
            Калькулятор Pro
        </calculator-button>
        <p class="calculator_text calculator_text-md">
            *Калькулятор Pro - это расширенная версия калькулятора, который на основе большего количество вводных данных позволит определить более точные прогнозы доходности
        </p>
    </div>
</template>

<script>
import CalculatorTitle from "../UI/CalculatorTitle.vue";
import CalculatorButton from "../UI/CalculatorButton.vue";

export default {
    name: "stats-calculator-view",
    components: {
        CalculatorButton,
        CalculatorTitle
    }
}
</script>

<style scoped lang="scss">
.calculator {
    &_title {
        max-width: 384px;
        margin-bottom: 24px;
    }
    &_text {
        color: rgba(255, 255, 255, 0.50);
        font-weight: 300;
        margin-bottom: 72px;
        max-width: 400px;
        line-height: 130%;
        &-md {
            color: rgba(255, 255, 255, 0.30);
            font-size: 14px;
            font-weight: 400;
            line-height: 150%;
            max-width: 472px;
        }
    }
    &_button {
        margin-bottom: 86px;
    }
}
</style>
