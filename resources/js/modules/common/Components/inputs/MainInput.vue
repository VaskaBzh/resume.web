<template>
    <label
        :for="inputName"
        class="input_row"
        :class="{ 'input_row-error': error, 'input_row-focus': value }"
    >
        <span class="input_label" v-if="!editable">{{ inputLabel }}</span>
        <input
            :id="inputName"
            v-model="value"
            type="text"
            class="input"
            :readonly="!editable"
            :autocomplete="autocomplete"
            :placeholder="inputLabel"
        />
    </label>
</template>

<script>
export default {
    name: "MainInput",
    props: {
        inputName: String,
        inputLabel: String,
        inputValue: String,
        error: String,
        autocomplete: String,
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
    background: transparent !important;
    color: var(--text-secondary, #475467) !important;
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
    border-radius: var(--surface-border-radius-radius-s-md, 12px);
    background: var(--background-island-inner-3, #f8fafd);
    &_row {
        min-height: 56px;
        background: inherit;
        border: 1px solid transparent;
        position: relative;
        transition: all 0.5s ease 0s;
        border-radius: 8px;
        box-shadow: 0 2px 12px -5px rgba(16, 24, 40, 0.02);
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        padding: 4px 16px;
        cursor: text;
        &::placeholder {
            font-size: 24px;
            font-family: AmpleSoftPro, serif;
            line-height: 135%;
        }
        &-error {
            border-color: #ed1818;
        }
        //&-focus {
        //    border-color: #5389e1;
        //}
    }
    &_label {
        color: var(--text-teritary, #98a2b3);
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
