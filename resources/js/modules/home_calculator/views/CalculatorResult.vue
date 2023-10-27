<template>
    <div class="result">
        <img src="../images/Calculator.png" class="result_img" />
        <div
            class="result__content"
            v-show="hasCalculate"
            v-scroll="'left delay--md'"
        >
            <div class="result__calc">
                <calculator-row :title-index="0" :bitcoinValue="income" />
                <calculator-row :title-index="1" :bitcoinValue="cost" />
            </div>
        </div>
        <div class="result_blur"></div>
    </div>
</template>

<script>
import CalculatorRow from "@/modules/home_calculator/Componets/UI/CalculatorRow.vue";

export default {
    name: "calculator-result",
    components: {
        CalculatorRow,
    },
    props: {
        hasCalculate: Boolean,
        income: Number,
        cost: Number,
    },
};
</script>

<style scoped lang="scss">
.result {
    position: relative;
    margin: 0 70px;
    @media (max-width: $pc) {
        width: 100%;
        margin: 0;
        &_blur,
        &_img {
            display: none;
        }
    }
    &_blur {
        position: absolute;
        bottom: -9px;
        width: 100%;
        left: 50%;
        transform: translateX(-50%);
        height: 68px;
        background: rgba(141, 141, 141, 0.5);
        filter: blur(50px);
    }
    &__calc {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
        @media (max-width: $pc) {
            flex-direction: row;
            justify-content: space-between;
            flex-wrap: wrap;
        }
    }
    &__content {
        max-width: 274px;
        width: 100%;
        @media (min-width: $pc) {
            position: absolute;
            bottom: 148px;
            left: 50%;
            transform: translateX(-50%);
        }
        @media (max-width: $pc) {
            border-radius: 16px;
            background: var(--dark-bg, #fff);
            box-shadow: 0px 4px 10px 0px rgba(85, 85, 85, 0.1);
            display: flex;
            justify-content: space-between;
            padding: 16px 24px;
            max-width: 100%;
        }
    }
}
</style>
