<template>
    <div class="calculator__content">
        <transition name="slide">
            <calculator-title class="title-white title-h2 calculator_title">
                Калькулятор Pro
            </calculator-title>
        </transition>
        <form class="calculator__form">
            <transition-group name="slide">
                <calculator-input
                    v-for="(input, i) in ProService.inputs"
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
        <a href="#" @click.prevent="$emit('changePro')" class="calculator_link">
            Вернуться к Калькулятору Light
        </a>
    </div>
</template>

<script>
import CalculatorTitle from "../UI/CalculatorTitle.vue";
import CalculatorInput from "../UI/CalculatorInput.vue";

import { ProCalculatorService } from "../../services/ProCalculatorService";
import { mapGetters } from "vuex";

export default {
    name: "stats-calculator-view",
    components: {
        CalculatorTitle,
        CalculatorInput,
    },
    computed: {
        ...mapGetters(["btcInfo"]),
    },
    watch: {
        "btcInfo.btc"(newValue) {
            if (newValue) {
                this.ProService.setInputs(newValue);
            }
        },
    },
    methods: {
        setValue(name, value) {
            console.log(name, value);
        },
    },
    data() {
        return {
            ProService: new ProCalculatorService(),
        };
    },
    mounted() {
        if (this.btcInfo.btc) {
            this.ProService.setInputs(this.btcInfo.btc);
        }
    },
};
</script>

<style lang="scss">
.calculator {
    &_title {
        margin-bottom: 56px;
    }
    &__form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px 24px;
        width: 100%;
        margin-bottom: 56px;
    }
    &_link {
        color: rgba(255, 255, 255, 0.7);
        font-size: 18px;
        font-weight: 400;
        line-height: 28px;
        letter-spacing: 0.35px;
        position: relative;
        width: fit-content;
        &:after {
            content: "";
            width: 100%;
            position: absolute;
            height: 1px;
            background: rgba(255, 255, 255, 0.7);
            bottom: 0;
            left: 0;
        }
    }
}
</style>
