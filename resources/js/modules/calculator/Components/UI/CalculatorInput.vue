<template>
    <label :for="inputName" class="row" @mousedown="$refs.input.focus()">
        <input
            :id="inputName"
            ref="input"
            v-model="value"
            type="text"
            :disabled="disabled"
            :name="inputName"
            class="row__input"
            :placeholder="$t(inputLabel)"
        />
        <span v-show="inputUnit" class="row_unit">{{ inputUnit }}</span>
    </label>
</template>

<script>
export default {
    name: "CalculatorInput",
    props: {
        inputName: String,
        inputLabel: String,
        inputValue: String,
        inputPlaceholder: String,
        inputUnit: String,
        inputHint: String,
        disabled: Boolean,
    },
    data() {
        return {
            value: this.inputValue,
            throttle: null,
        };
    },
    watch: {
        value(newVal, oldVal) {
            clearTimeout(this.throttle);
            let regExp = /[a-zа-яё]|[!$()№";'@#&_%$*+,~`:=<>?[|\]/\-\\^{|}]/gi;
            if (newVal.length > 9 || regExp.test(newVal)) {
                this.value = oldVal;
                return;
            }

            this.throttle = setTimeout(() => {
                this.$emit("getValue", newVal);
            }, 500);
        },
        inputValue(newVal) {
            this.value = newVal;
        },
    },
};
</script>

<style scoped lang="scss">
.row {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    position: relative;
    width: 100%;
    border-radius: 16px;
    border: 0.5px solid var(--gray-240, rgba(228, 231, 236, 0.4));
    padding: 0 16px;
    min-height: 48px;
    gap: 12px;
    cursor: text;

    &_unit {
        color: rgba(255, 255, 255, 0.7);
        text-align: right;
        font-size: 16px;
        font-weight: 400;
        line-height: 28px;
        letter-spacing: 0.35px;
        white-space: nowrap;
        @media (max-width: 890px) {
            font-size: 18px;
        }
        @media (max-width: 450px) {
            font-size: 14px;
        }
    }

    &__input {
        color: var(--gray-3100, #d0d5dd);
        font-family: Unbounded;
        font-size: 18px;
        font-weight: 600;
        line-height: 120%;
        text-transform: uppercase;
        width: 100%;
        outline: none;
        border: none;
        background: transparent;
        cursor: text;
        &::placeholder {
            text-transform: none;
            color: var(--gray-160, rgba(245, 250, 255, 0.6));
            text-align: justify;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans;
            font-size: 20px;
            font-weight: 400;
            line-height: 110%;
            cursor: text;
            white-space: nowrap;
            @media (max-width: 890px) {
                font-size: 18px;
            }
            @media (max-width: 450px) {
                font-size: 14px;
            }
        }
        @media (max-width: 890px) {
            font-size: 16px;
        }
        @media (max-width: 450px) {
            font-size: 12px;
        }
    }
}
</style>
