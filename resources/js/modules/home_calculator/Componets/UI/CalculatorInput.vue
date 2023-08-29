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
            @click="toggleList"
        >
            <span v-if="hasCurrency">{{ baseValue }}</span>
            {{ inputUnit }}
            <transition name="list">
                <div v-if="hasCurrency" class="row__list" v-show="opened">
                    <span
                        @click="setValue(cur)"
                        class="row_item"
                        :key="i"
                        v-for="(cur, i) in currency"
                        >{{ cur }}</span
                    >
                </div>
            </transition>
        </div>
    </div>
</template>
<script>
import currency from "@/api/currency";

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
            currency: ["Р", "$"],
            opened: false,
            baseValue: "",
            usd: 0,
        };
    },
    watch: {
        value(newValue, oldValue) {
            const regex = /^[0-9]*\.?[0-9]*$/;

            if (regex.test(newValue)) {
                const numValue = parseFloat(newValue);

                if (!isNaN(numValue) || numValue > this.watchValue) {
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
        toggleList() {
            this.opened = !this.opened;
        },
        closeList() {
            this.opened = false;
        },
        setBase() {
            const firstIndex = 0;
            const secondIndex = 1;

            this.baseValue =
                this.$i18n.locale === "ru"
                    ? this.currency[firstIndex]
                    : this.currency[secondIndex];
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
            this.usd = (await currency()).data.rates.USD;
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
        color: var(--light-theme-gray-3, #818c99);
        font-size: 18px;
        font-weight: 400;
        line-height: 135%;
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
        &::placeholder {
            color: var(--light-theme-gray-3, #818c99);
        }
    }
}
</style>
