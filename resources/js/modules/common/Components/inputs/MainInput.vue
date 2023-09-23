<template>
    <div
        class="input_row"
        :class="{ 'input_row-error': error, 'input_row-focus': value }"
        @click="$refs.input.focus()"
    >
        <label class="input_label" :for="inputName">{{ inputLabel }}</label>
        <input
            type="text"
            :id="inputName"
            v-model="value"
            ref="input"
            class="input"
            :readonly="!editable"
        />
    </div>
</template>

<script>
export default {
    name: "main-input",
    props: {
        inputName: String,
        inputLabel: String,
        inputValue: String,
        error: String,
        editable: {
            type: Boolean,
            default: true,
        },
    },
    data() {
        return {
            value: this.inputValue,
        };
    },
    watch: {
        inputValue(newInputValue) {
            this.value = newInputValue;
        },
        value(newVal) {
            if (this.editable) this.$emit("getValue", newVal);
        },
    },
};
</script>

<style scoped lang="scss">
.input {
    background: transparent;
    color: var(--text-secondary-day, #475467);
    font-family: NunitoSans, serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    border: none;
    outline: none;
    transition: all 0.5s ease 0s;
    display: flex;
    flex-direction: column;
    justify-content: center;
    &_row {
        min-height: 56px;
        background: inherit;
        border: 1px solid transparent;
        position: relative;
        transition: all 0.5s ease 0s;
        border-radius: 8px;
        box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
        padding: 12px 16px 8px;
        cursor: text;
        &-error {
            border-color: #ed1818;
        }
        //&-focus {
        //    border-color: #5389e1;
        //}
    }
    &_label {
        color: var(--text-teritary-day, #98a2b3);
        font-family: NunitoSans, serif;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
        cursor: text;
        background: inherit;
        transition: all 0.5s ease 0s;
        z-index: 1;
    }
}
</style>
