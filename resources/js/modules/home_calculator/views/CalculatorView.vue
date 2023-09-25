<template>
    <div v-scroll="'left delay--md'" class="calculator section">
        <div class="calculator__container">
            <div class="calculator__content">
                <div class="calculator__main">
                    <main-title
                        tag="h2"
                        class="calculator_title title-blue"
                        v-scroll="'left delay--md'"
                    >
                        {{ $t("home.calculator.title") }}
                    </main-title>
                    <div class="calculator__block">
                        <div
                            class="description description-sm calculator_description"
                        >
                            {{ $t("home.calculator.text") }}
                        </div>
                        <form class="calculator__form">
                            <calculator-input
                                v-for="(input, i) in calculatorService.inputs"
                                :key="i"
                                :inputName="input.inputName"
                                :inputValue="input.inputValue"
                                :inputPlaceholder="input.inputPlaceholder"
                                :inputUnit="input.inputUnit"
                                :hasCurrency="input.currency"
                                :watchValue="input.watchValue"
                                @getValue="setValue(input.inputName, $event)"
                                @getCurrency="setMultiplier($event)"
                            />
                            <button
                                class="calculator_button"
                                @click.prevent="calculate"
                            >
                                {{ $t("home.calculator.button") }}
                            </button>
                        </form>
                    </div>
                </div>
                <calculator-result
                    :hasCalculate="hasCalculate"
                    :income="incomeValue"
                    :cost="calculatorService.cost"
                />
            </div>
        </div>
    </div>
</template>
<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import CalculatorInput from "../Componets/UI/CalculatorInput.vue";
import CalculatorResult from "@/modules/home_calculator/views/CalculatorResult.vue";

import { CalculatorService } from "../services/CalculatorService";

import { mapGetters } from "vuex";

export default {
    name: "calculator-view",
    components: {
        MainTitle,
        CalculatorInput,
        CalculatorResult,
    },
    data() {
        return {
            calculatorService: new CalculatorService(this.$t),
            hasCalculate: false,
            incomeValue: null,
        };
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    watch: {
        "btcInfo.btc"(newValue) {
            if (newValue) {
                this.calculatorService.setInputs(newValue);
            }
        },
    },
    mounted() {
        if (this.btcInfo?.btc) {
            this.calculatorService.setInputs(this.btcInfo.btc);

        }
    },
    methods: {
        calculate() {
            this.hasCalculate = true;
        },
        setValue(inputName, newValue) {
            this.calculatorService.setItem(inputName, newValue);

            this.calculatorProcess(720);
        },
        setMultiplier(multiplier) {
            this.calculatorService.setMultiplier(multiplier);

            this.calculatorProcess(720);
        },
        async calculatorProcess(num) {
            this.incomeValue = await this.calculatorService.getProfit(num);
            await this.calculatorService.getCost(num);
        },
    },
};
</script>
<style lang="scss" scoped>
.calculator {

    &__container {
        margin: 0 auto;
    }

    &_title {
   margin-bottom: 24px;
   font-family: AmpleSoft Pro;

    }
    &_description {
        margin-bottom: 48px;
    }
    &__block {
        max-width: 630px;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-end;
        gap: 8px;
        @media (max-width: $pc) {
            max-width: 100%;
            margin-bottom: 8px;
        }
    }
    &__form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        margin-bottom: 0;
        width: 100%;
        @media (max-width: $mobile) {
            display: flex;
            flex-direction: column;
        }
    }
    &_button {
        grid-column: 1/3;
        min-height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        border-radius: 8px;
        background: linear-gradient(30deg, #3f7bdd 0%, #4282ec 100%);
        box-shadow: 0px 10px 50px 0px rgba(112, 165, 236, 0.15);
        color: var(--dark-bg, #fff);
        text-align: center;
        font-size: 18px;
        font-weight: 500;
        line-height: 135%;
    }
    &__content {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        @media (max-width: $pc) {
            flex-direction: column;
        }
    }
}
</style>
