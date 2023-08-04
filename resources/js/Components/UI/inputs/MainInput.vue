<template>
    <div
        class="input_row"
        :class="{ 'input_row-error': error, 'input_row-focus': value }"
    >
        <input type="text" :id="inputName" v-model="value" class="input" />
        <label class="input_label" :for="inputName">{{ inputLabel }}</label>
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
    },
    data() {
        return {
            value: this.inputValue,
        };
    },
    watch: {
        value(newVal) {
            this.$emit("getValue", newVal);
        },
    },
};
</script>

<style scoped lang="scss">
.input {
    background: transparent;
    color: #343434;
    transition: all 0.5s ease 0s;
    &:focus {
        + .input {
            &_label {
                color: #5389e1;
                font-size: 12px;
                top: 0;
            }
        }
    }
    &_row {
        background: inherit;
        border: 1px solid #c5c5c5;
        borderstep push + -radius: 4px;
        position: relative;
        transition: all 0.5s ease 0s;
        &-error {
            border-color: #ed1818;
        }
        &-focus {
            border-color: #5389e1;
        }
    }
    &_label {
        color: #c5c5c5;
        font-size: 16px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        left: 16px;
        cursor: text;
        background: inherit;
        transition: all 0.5s ease 0s;
        z-index: 1;
    }
}
</style>
