<template>
	<div class="logo__block">
		<span class="logo_text logo_text-first">allbtc</span>
		<span class="logo_text logo_text-last">pool</span>
	</div>
</template>

<script>
export default {
	name: "logo-animate-view",
}
</script>

<style scoped>
.logo__block {
	display: flex;
	flex-direction: column;
}
.logo_text {
	font-feature-settings: 'clig' off, 'liga' off;
	text-shadow: 0 4.914285659790039px 8.600000381469727px rgba(14, 14, 14, 0.05);
	font-family: Unbounded, serif;
	font-size: 290px;
	font-weight: 600;
	line-height: 120%;
}
.logo_text-first {
	margin-right: auto;
}
.logo_text-last {
	margin-right: auto;
}
</style>
