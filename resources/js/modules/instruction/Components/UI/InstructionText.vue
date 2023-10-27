<template>
	<div class="text">
		{{ text }}
	</div>
</template>

<script>
export default {
	name: "instruction-text",
	props: {
        text: String,
	},
}
</script>

<style scoped>
.text {
    color: var(--text-teritary, #98A2B3);
    font-family: NunitoSans,serif;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
    padding: 8px 12px;
}
</style>
