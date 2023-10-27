<template>
	<div
		class="button"
		:class="{ 'button-active': active === value }"
		@click="$emit('swipePage', value)"
	>
		{{ value }}
	</div>
</template>

<script>
export default {
	name: "slider-button",
	props: {
		value: Number,
		active: Number,
	}
}
</script>

<style scoped>
.button {
	cursor: pointer;
	height: 32px;
	width: 32px;
	border-radius: 8px;
	background: transparent;
	transition: all 0.5s ease 0s;
	display: inline-flex;
	align-items: center;
	justify-content: center;
}
.button:hover,
.button-active {
	background: var(--old-primary-4007, rgba(83, 177, 253, 0.07));
}
</style>
