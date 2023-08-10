<template>
    <div class="calculator">
        <div class="calculator__container">
            <header-component-calculator
                :errors="errors"
                :is_auth="auth_user"
            />
            <div class="calculator__main">
                <first-calculator-view />
                <light-calculator-view />
            </div>
            <!--            <stats-calculator-view />-->
            <!--            <pro-calculator-view />-->
        </div>
    </div>
</template>

<script>
import calculatorLayoutView from "../Shared/CalculatorLayoutView.vue";
import FirstCalculatorView from "../modules/calculator/Components/views/FirstCalculatorView.vue";
import StatsCalculatorView from "../modules/calculator/Components/views/StatsCalculatorView.vue";
import LightCalculatorView from "../modules/calculator/Components/views/LightCalculatorView.vue";
import ProCalculatorView from "../modules/calculator/Components/views/ProCalculatorView.vue";
import HeaderComponentCalculator from "../modules/calculator/Components/HeaderComponentCalculator.vue";

export default {
    name: "calculator-page",
    layout: calculatorLayoutView,
    props: {
        user: Object,
        errors: Object,
        is_auth: Boolean,
    },
    components: {
        HeaderComponentCalculator,
        FirstCalculatorView,
        StatsCalculatorView,
        LightCalculatorView,
        ProCalculatorView,
    },
    methods: {
        swipePage() {},
    },
};
</script>

<style scoped lang="scss">
.calculator {
    width: 100%;
    &__container {
        max-width: 100%;
    }
    &__main {
        display: flex;
        gap: 20px;
        justify-content: space-between;
        width: 100%;
    }
}
</style>
