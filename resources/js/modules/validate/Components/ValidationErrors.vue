<template>
	<div
		class="errors"
		v-show="error_list[list_name] || errors[list_name]"
	>
		<div
			class="errors_elem"
			v-for="(error, i) in error_list[list_name] ?? errors[list_name]"
			:key="i"
			v-t="error"
		></div>
	</div>
</template>

<script>
import { mapGetters } from "vuex";
import { ValidationErrorMessages } from "@/modules/validate/lang/ValidationErrorMessages";

export default {
	name: "ValidationErrors",
	props: {
		error_list: {
			type: Array,
			default: [],
		},
		list_name: {
			type: String,
			default: "",
		}
	},
	i18n: {
		sharedMessages: ValidationErrorMessages,
	},
	computed: {
		...mapGetters(["errors"])
	}
}
</script>

<style scoped lang="scss">
.errors {
	@include columnMixin($gap: 8);
	padding: 0 adaptive-value(12px, 16px);
	&_elem {
		color: var(--status-failed, #F1404A);
		font-size: 12px;
		line-height: 16px;
	}
}
</style>
