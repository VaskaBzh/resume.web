<template>
    <div class="calculator__content">
        <transition name="slide">
            <calculator-title class="title-white title-h2 calculator_title">
                Калькулятор Light
            </calculator-title>
        </transition>
        <form class="calculator__form">
            <transition-group name="slide">
                <calculator-input
                    v-for="(input, i) in inputs.inputs"
                    :key="i"
                    :inputName="input.inputName"
                    :inputLabel="input.inputLabel"
                    :inputPlaceholder="input.inputPlaceholder"
                    :inputValue="input.inputValue"
                    :inputUnit="input.inputUnit"
                    :disabled="input.disabled"
                    @getValue="setValue(input.inputName, $event)"
                />
            </transition-group>
        </form>
        <div class="calculator__graph">
            <calculator-tabs
                :tabs="graphTabs"
                :activeValue="graphValue"
                @getDate="getDate"
            ></calculator-tabs>
            <column-graph
                :graphData="inputs.graph"
                v-if="inputs.graph"
            ></column-graph>
        </div>
    </div>
</template>

<script>
import CalculatorTitle from "../UI/CalculatorTitle.vue";
import CalculatorInput from "../UI/CalculatorInput.vue";
import { mapGetters } from "vuex";
import { LightCalculatorService } from "../../services/LightCalculatorService.js";
import CalculatorTabs from "../UI/CalculatorTabs.vue";
import ColumnGraph from "../graphs/ColumnGraph.vue";

export default {
    name: "light-calculator-view",
    components: {
        CalculatorInput,
        CalculatorTitle,
        CalculatorTabs,
        ColumnGraph,
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    data() {
        return {
            inputs: new LightCalculatorService(),
            graphValue: 1,
            graphTabs: [
                {
                    name: "1 час",
                    value: 1,
                },
                {
                    name: "1 день",
                    value: 24,
                },
                {
                    name: "1 месяц",
                    value: 210,
                },
                {
                    name: "3 месяца",
                    value: 720,
                },
            ],
        };
    },
    methods: {
        getDate(tabValue) {
            this.graphValue = tabValue;

            this.inputs.getGraph(tabValue);
        },
        setValue(inputName, newValue) {
            this.inputs.setItem(inputName, newValue);

            this.inputs.getGraph(this.graphValue);
        },
    },
    watch: {
        "btcInfo.btc"(newValue) {
            if (newValue) {
                this.inputs.setInputs(newValue);

                this.inputs.getGraph(this.graphValue);
            }
        },
    },
    mounted() {
        if (this.btcInfo.btc) {
            this.inputs.setInputs(this.btcInfo.btc);

            this.inputs.getGraph(this.graphValue);
        }
    },
};
</script>

<style scoped lang="scss">
.slide-enter-active,
.slide-leave-active {
    transition: all 0.5s ease;
}
.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
.calculator {
    &_title {
        margin-bottom: 48px;
    }
    &__form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin-bottom: 40px;
    }
    &__graph {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 34px;
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 2px 4px 4px 0px rgba(24, 73, 169, 0.05);
        width: 100%;
    }
}
</style>
