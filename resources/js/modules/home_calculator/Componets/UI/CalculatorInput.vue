<template>
    <div class="row">
        <input
            class="row_input"
            type="text"
            :placeholder="inputPlaceholder"
            :name="inputName"
            :id="inputName"
            v-model="value"
        />
        <div class="row_unit" v-show="inputUnit" @click="toggleList">
            <svg
                v-if="hasCurrency"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M18 10L12 16L6 10"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
            {{ inputUnit }}
            <div v-if="hasCurrency" class="row__list" v-show="opened">
                <span class="row_item" :key="i" v-for="(cur, i) in currency">{{
                    cur
                }}</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "calculator-input",
    props: {
        inputName: String,
        inputValue: String,
        inputPlaceholder: String,
        inputUnit: String,
        hasCurrency: Boolean,
    },
    data() {
        return {
            value: this.inputValue,
            currency: ["Р", "$"],
            opened: false,
        };
    },
    watch: {
        value(newValue) {
            this.$emit("getValue", newValue);
        },
        inputValue(newVal) {
            this.value = newVal;
        },
    },
    methods: {
        toggleList() {
            this.opened = !this.opened;
        },
        closeList() {
            this.opened = false;
        },
    },
};
</script>
<style scoped lang="scss">
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
    &_unit {
        stroke: #818c99;=
        color: var(--light-theme-gray-3, #818c99);
        font-size: 18px;
        font-weight: 400;
        line-height: 135%;
    }
    &_input {
        font-size: 18px;
        font-weight: 300;
        line-height: 135%;
        background: transparent;
        border: none;
        outline: none;
        &::placeholder {
            color: var(--light-theme-gray-3, #818C99);
        }
    }
}
</style>
