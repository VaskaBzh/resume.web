<template>
    <div class="calculator__content">
        <transition name="slide">
            <calculator-title
                v-show="lightService.inputs.length > 0"
                class="title-white title-h2 calculator_title"
            >
                Калькулятор Light
            </calculator-title>
        </transition>
        <form class="calculator__form">
            <transition-group name="slide">
                <calculator-input
                    v-for="(input, i) in lightService.inputs"
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
        <transition name="slide">
            <div
                class="calculator__graph"
                v-if="lightService.inputs.length > 0"
            >
                <calculator-tabs
                    :tabs="graphTabs"
                    :activeValue="graphValue"
                    @getDate="getDate"
                ></calculator-tabs>
                <!--            <column-graph-->
                <!--                :graphData="inputs.graph"-->
                <!--                v-if="inputs.graph"-->
                <!--            ></column-graph>-->
                <div class="calculator__result">
                    <converted-result :bitcoinValue="lightService.profit" />
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import CalculatorTitle from "../UI/CalculatorTitle.vue";
import CalculatorInput from "../UI/CalculatorInput.vue";
import { mapGetters } from "vuex";
import { LightCalculatorService } from "../../services/LightCalculatorService.js";
import CalculatorTabs from "../UI/CalculatorTabs.vue";
import ConvertedResult from "../UI/ConvertedResult.vue";
// import ColumnGraph from "../graphs/ColumnGraph.vue";

export default {
    name: "light-calculator-view",
    components: {
        CalculatorInput,
        CalculatorTitle,
        CalculatorTabs,
        // ColumnGraph,
        ConvertedResult,
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    data() {
        return {
            lightService: new LightCalculatorService(),
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

            this.lightService.getGraph(tabValue);
        },
        setValue(inputName, newValue) {
            this.lightService.setItem(inputName, newValue);

            this.lightService.getGraph(this.graphValue);
        },
    },
    watch: {
        "btcInfo.btc"(newValue) {
            if (newValue) {
                this.lightService.setInputs(newValue);

                this.lightService.getGraph(this.graphValue);
            }
        },
    },
    mounted() {
        if (this.btcInfo.btc) {
            this.lightService.setInputs(this.btcInfo.btc);

            this.lightService.getGraph(this.graphValue);
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
        .row {
            transition-delay: 0.25s;
            &:nth-child(2) {
                transition-delay: 0.5s;
            }
            &:nth-child(3) {
                transition-delay: 0.75s;
            }
        }
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
        transition-delay: 1s;
    }
}
</style>
