<template>
    <div class="calculator">
        <div class="calculator__container">
            <header-component-calculator
                :errors="errors"
                :is_auth="auth_user"
            />
            <div
                class="calculator__main"
                :class="{ 'calculator__main-pro': pro }"
            >
                <transition name="swipe">
                    <first-calculator-view
                        v-if="!pro"
                        @changePro="pro = true"
                    />
                    <stats-calculator-view v-else @changePro="pro = false" />
                </transition>
                <transition name="swipe">
                    <light-calculator-view v-if="!pro" />
                    <pro-calculator-view v-else />
                </transition>
            </div>
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
    data() {
        return {
            pro: false,
        };
    },
};
</script>

<style scoped lang="scss">
.swipe-enter-active {
    transition: all 0.8s ease 0.5s;
}
.swipe-leave-active {
    transition: all 0.3s ease 0s;
}
.swipe-enter-from,
.swipe-leave-to {
    opacity: 0;
    visibility: hidden;
}
.calculator {
    width: 100%;
    &__container {
        max-width: 100%;
    }
    &__content {
        z-index: 1;
        display: flex;
        flex-direction: column;
        max-width: 600px;
        width: 100%;
        margin: 0 auto;
        padding-top: 76px;
    }
    &__main {
        display: flex;
        gap: 20px;
        justify-content: space-between;
        width: 100%;
        &:after {
            content: "";
            background: linear-gradient(137deg, #0049be 15.98%, #3597f9 97.76%);
            box-shadow: -5px 4px 15px 10px rgba(9, 36, 68, 0.1);
            position: absolute;
            right: 0;
            top: 0;
            width: 50vw;
            height: 100vh;
            z-index: 0;
            transition: all 0.5s ease 0.3s;
        }
        &-pro {
            &:after {
                transform: translateX(-100%);
            }
        }
    }
}
</style>
