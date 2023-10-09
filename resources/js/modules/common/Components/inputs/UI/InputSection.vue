<template>
	<input type="text" class="input_section">
</template>

<script>
export default {
	name: "input-section"
}
</script>

<style scoped lang="scss">
.input_section {
	width: 56px;
	height: 56px;
	border-radius: 8px;

	font-family: NunitoSans, serif;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
	transition: all 0.5s ease 0s;
	border-color: transparent;
	background: var(--background-odal-input, #FFF);
	padding: 4px 16px;
	min-height: 56px;

	&::placeholder {
		color: var(--select-text-no-value, #D0D5DD);
	}

	&:active,
	&:focus {
		border-color: var(--select-border-focus, #2E90FA);
		box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
	}
}
</style>
