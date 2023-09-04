<template>
	<svg ref="line_container" width="75" height="75" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path ref="line" class="preloader_line" id="line" d="M0 0C0 9.84914 1.93993 19.6018 5.70903 28.7013C9.47813 37.8007 15.0026 46.0686 21.967 53.033C28.9314 59.9974 37.1993 65.5219 46.2987 69.291C55.3982 73.0601 65.1509 75 75 75V71.25C65.6433 71.25 56.3783 69.4071 47.7338 65.8264C39.0894 62.2458 31.2348 56.9975 24.6186 50.3814C18.0025 43.7652 12.7542 35.9106 9.17358 27.2662C5.59294 18.6217 3.75 9.35668 3.75 0H0Z" stroke-width="16"/>
	</svg>
</template>

<script>
export default {
	name: "preloader-line-icon",
	mounted() {
		this.$emit('getElement', this.$refs.line);
		this.$emit('dropContainer', this.$refs.line_container);
	}
}
</script>

<style scoped lang="scss">

</style>
