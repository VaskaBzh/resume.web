<template>
    <div class="row" @click.prevent="$refs.input.focus()">
        <input
            class="row_input"
            type="text"
            ref="input"
            :placeholder="inputPlaceholder"
            :name="inputName"
            :id="inputName"
            v-model="value"
        />
        <div
            class="row_unit"
            :class="{ 'row_unit-currency': hasCurrency }"
            v-show="inputUnit"
            @click="setValue(newCurrencyValue)"
        >
            <span v-if="hasCurrency">{{ baseValue }}</span>
            {{ inputUnit }}
        </div>
    </div>
</template>
<script>
import { mapGetters } from "vuex";

export default {
    name: "calculator-input",
    props: {
        inputName: String,
        inputValue: String,
        inputPlaceholder: String,
        inputUnit: String,
        hasCurrency: Boolean,
        watchValue: Number,
    },
    data() {
        return {
            value: this.inputValue,
            currencyArray: ["Р", "$"],
            baseValue: "",
            usd: 0,
        };
    },
    computed: {
        ...mapGetters(["currency"]),
        newCurrencyValue() {
            const firstIndex = 0;
            const currency = this.currencyArray.filter(
                (cur) => cur !== this.baseValue
            )[firstIndex];

            this.getCurrency(currency);
            return currency;
        },
    },
    watch: {
        value(newValue, oldValue) {
            const regex = /^[0-9]*\.?[0-9]*$/;

            if (regex.test(newValue)) {
                const numValue = parseFloat(newValue);

                if (numValue > this.watchValue) {
                    this.value = oldValue;
                }
            } else {
                this.value = oldValue;
            }

            this.$emit("getValue", newValue);
        },
        inputValue(newVal) {
            this.value = newVal;
        },
        baseValue(newValue) {
            this.getCurrency(newValue);
        },
    },
    methods: {
        setBase() {
            const firstIndex = 0;
            const secondIndex = 1;

            this.baseValue =
                this.$i18n?.locale === "ru"
                    ? this.currencyArray[firstIndex]
                    : this.currencyArray[secondIndex];
        },
        setValue(value) {
            this.baseValue = value;
        },
        getCurrency(currency) {
            const usdMultiplier = 1 / this.usd;

            switch (currency) {
                case "Р":
                    this.$emit("getCurrency", 1);
                    break;
                case "$":
                    this.$emit("getCurrency", usdMultiplier);
                    break;
            }
        },
        async currencyApi() {
            this.usd = this.currency.rates.USD;
        },
    },
    async mounted() {
        await this.currencyApi();
        this.setBase();
    },
};
</script>

<style scoped lang="scss">
.list-leave-active,
.list-enter-active {
    transition: all 0.3s ease 0s;
}
.list-leave-to,
.list-enter-from {
    opacity: 0;
    visibility: hidden;
}
.row {
    position: relative;
    width: 100%;
    border-radius: 8px;
    background: #fff;
    padding: 0 16px;
    border: 1px solid transparent;
    outline: none;
    display: flex;
    align-items: center;
    min-height: 64px;
    cursor: text;
    &__list {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        width: 100%;
        background: #fff;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        box-shadow: 0px 8px 24px 0px rgba(129, 135, 189, 0.3);
        align-items: center;
    }
    &_item {
        color: var(--light-theme-gray-3, #818c99);
        font-size: 18px;
        font-weight: 400;
        line-height: 135%;
        padding: 4px 0;
        width: 100%;
        text-align: center;
        &:not(:last-child) {
            border-bottom: 0.5px solid rgba(#818c99, 0.5);
        }
    }
    &_unit {
        color: var(--gray-160, rgba(245, 250, 255, 0.60));
        text-align: justify;
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%; /* 22px */
        position: relative;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        width: fit-content;
        flex-wrap: nowrap;
        white-space: nowrap;
        &-currency {
            padding-bottom: 1px;
            border-bottom: 0.5px solid rgba(#818c99, 0.5);
        }
    }
    &_input {
        font-size: 18px;
        font-weight: 300;
        line-height: 135%;
        background: transparent;
        border: none;
        outline: none;
        width: 100%;
        &:-webkit-autofill {
            border: none;
            background: transparent;
            transition: background 5000s ease 0s;
            &:hover,
            &:focus {
                border: none;
                background: transparent;
                transition: background 5000s ease 0s;
            }
        }
        &::placeholder {
            color: var(--light-theme-gray-3, #818c99);
        }
    }
}
</style>
