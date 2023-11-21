<template>
    <div class="form__row">
        <label
            :for="inputName"
            class="form__block"
            :class="{
                'form__block-error': errors[inputName]?.length > 0,
            }"
            @click="$refs.input.focus()"
        >
            <span v-show="inputLabel" class="form_label">{{ inputLabel }}</span>
            <input
                :id="inputName"
                ref="input"
                v-model="modelValue"
                :type="inputType"
                :placeholder="inputPlaceholder"
                :name="inputName"
                class="form_input"
            />
        </label>
        <validation-errors
            class="form__list-errors"
            :error_list="errors"
            :list_name="inputName"
        />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import ValidationErrors from "@/modules/validate/Components/ValidationErrors.vue";

export default {
    name: "FormPopupInput",
    components: {
        ValidationErrors,
    },
    props: {
        inputValue: {
            type: String,
            default: "",
        },
        inputLabel: {
            type: String,
            default: "",
        },
        inputPlaceholder: {
            type: String,
            default: "",
        },
        inputType: {
            type: String,
            default: "text",
        },
        inputName: {
            type: String,
            default: "",
        },
    },
    computed: {
        ...mapGetters(["errors"]),
    },
    emits: ["inputChange"],
    data() {
        return {
            modelValue: this.inputValue,
        };
    },
    watch: {
        inputValue(newInputValue) {
            this.modelValue = newInputValue;
        },
        modelValue(newModelValue) {
            this.$emit("inputChange", newModelValue);
        },
    },
};
</script>

<style scoped lang="scss">
.form {
    &__row {
        @include columnMixin($gap: 8px);
        font-weight: 400;
        font-family: NunitoSans, serif;
        width: 100%;
    }
    &__block {
        @include columnMixin();
        justify-content: center;
        border-radius: var(--surface-border-radius-radius-s-md, 12px);
        background: var(--background-modal-input, #2c2f34);
        min-height: adaptive-value(48px, 56px);
        width: 100%;
        padding: 0 adaptive-value(12px, 16px);
        cursor: text;
        border: 1px solid transparent;
        &-error {
            border-color: var(--status-failed, #f1404a);
        }
    }
    &_input {
        color: var(--text-secondary, #c5c8cd);
        font-size: adaptive-value(14px, 16px);
        line-height: adaptive-value(20px, 24px);
        outline: none;
        background: transparent;
        width: inherit;
        &::placeholder {
            color: var(--text-no-value, #d0d5dd);
        }
    }
    &_label {
        color: var(--text-teritary, #6f7682);
        font-size: adaptive-value(10px, 12px);
        line-height: adaptive-value(12px, 16px);
        width: inherit;
        cursor: inherit;
    }
}
</style>
