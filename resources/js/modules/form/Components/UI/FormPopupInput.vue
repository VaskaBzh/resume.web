<template>
	<div class="form__row">
		<div class="form__block" @click="$refs.input.focus()">
			<label class="form_label" v-show="inputLabel">{{ inputLabel }}</label>
			<input
				ref="input"
				:type="inputType"
				:placeholder="inputPlaceholder"
				:name="inputName"
				v-model="modelValue"
				:class="{
                    'form_input-error': errors[inputName],
                }"
				class="form_input"
			>
		</div>
		<validation-errors class="form__list-errors" :error_list="errors" :list_name="inputName" />
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import ValidationErrors from "@/modules/validate/Components/ValidationErrors.vue";

export default {
	name: "FormPopupInput",
	components: {
		ValidationErrors
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
	data() {
		return {
			modelValue: this.inputValue,
		};
	},
	emits: ["inputChange"],
	watch: {
		modelValue(newModelValue) {
			this.$emit("inputChange", newModelValue);
		},
	},
}
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
		background: var(--background-modal-input, #2C2F34);
		min-height: adaptive-value(48px, 56px);
		width: 100%;
		padding: 0 adaptive-value(12px, 16px);
		cursor: text;
	}
	&_input {
		color: var(--text-secondary, #C5C8CD);
		font-size: adaptive-value(14px, 16px);
		line-height: adaptive-value(20px, 24px);
		border: 1px solid transparent;
		outline: none;
		background: transparent;
		width: inherit;
		&::placeholder {
			color: var(--select-text-no-value, #43474E);
		}
		&-error {
			border-color: (--status-failed, #F1404A);
		}
	}
	&_label {
		color: var(--text-teritary, #6F7682);
		font-size: adaptive-value(10px, 12px);
		line-height: adaptive-value(12px, 16px);
		width: inherit;
		cursor: inherit;
	}
}
</style>
