<template>
	<svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg" ref="icon_container">
		<polygon ref="polygon" points="" fill="#4282EC" id="polygon"></polygon>
	</svg>
</template>

<script>
export default {
	name: "preloader-container-icon",
	mounted() {
		this.$emit('getContainer', this.$refs.icon_container);
		this.$emit('getPolygon', this.$refs.polygon);
	}
}
</script>

<style scoped lang="scss">

</style>
