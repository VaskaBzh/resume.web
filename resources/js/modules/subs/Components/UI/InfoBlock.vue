<template>
	<div class="info">
		<span class="info_label">{{ label }}</span>
		<span class="info_value">
			<slot name="value" />
		</span>
	</div>
</template>

<script>
export default {
	name: "info-block",
	props: {
		label: String,
	}
}
</script>

<style scoped>
.info {
	display: flex;
	flex-direction: column;
	gap: 4px;
}
.info_label {
	color: var(--text-teritary, #98A2B3);
	font-family: NunitoSans, serif;
	font-size: 12px;
	font-weight: 400;
	line-height: 16px;
}
.info_value {
	color: var(--text-secondary, #475467);
	font-family: NunitoSans, serif;
	font-size: 14px;
	font-weight: 400;
	line-height: 20px;
}
</style>
