<template>
	<div class="title">
		{{ title }}
	</div>
</template>

<script>
export default {
	name: "instruction-title",
	props: {
		title: String,
	},
}
</script>

<style scoped>
.title {
	border-radius: 16px;
	background: var(--background-gradient-2, linear-gradient(172deg, #024BC0 9.53%, #3597F9 293.99%));
	box-shadow: 0px 10px 10px -6px rgba(0, 0, 0, 0.10);
	min-height: 52px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	width: 100%;
	color: var(--text-logo-night, var(--main-gohan, #FFF));
	padding: 0 8pxz;
	font-family: Unbounded, serif;
	font-size: 18px;
	font-weight: 400;
	line-height: 28px;
}
</style>
