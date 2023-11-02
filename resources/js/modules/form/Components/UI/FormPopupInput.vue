<template>
	<div class="form__row">
		<div class="form__block">
			<label for="" class="form_label"></label>
			<input type="text" class="form_input">
		</div>
		<div class="form__list-errors">
			<span class="form_error"></span>
		</div>
	</div>
</template>

<script>
export default {
	name: "FormPopupInput",
}
</script>

<style scoped lang="scss">
.form {
	&__row {
		@include columnMixin($gap: 8);
	}
}
</style>
