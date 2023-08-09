<template>
    <div class="calculator calculator-low">
        <div class="calculator__container">
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
                <calculator-button class="calculator_button">
                    Калькулятор Pro
                </calculator-button>
                <p class="calculator_text calculator_text-md">
                    *Калькулятор Pro - это расширенная версия калькулятора, который на основе большего количество вводных данных позволит определить более точные прогнозы доходности
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import calculatorLayoutView from "../Shared/CalculatorLayoutView.vue";
import CalculatorTitle from "../modules/calculator/Components/UI/CalculatorTitle.vue";
import CalculatorButton from "../modules/calculator/Components/UI/CalculatorButton.vue";

export default {
    name: "calculator-page",
    layout: calculatorLayoutView,
    components: {
        CalculatorTitle,
        CalculatorButton,
    }
}
</script>

<style scoped lang="scss">
.calculator {
    margin-top: 27px;
    &-low {
        padding-top: 76px;
    }
    &__main {
        display: flex;
        flex-direction: column;
    }
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
