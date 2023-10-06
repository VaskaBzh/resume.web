<template>
	<div
		class="sub cabinet__block cabinet__block-card cabinet__block-light"
		data-popup="#addAcc"
	>
		<add-sub-icon class="sub_icon" />
	</div>
</template>

<script>
import AddSubIcon from "@/modules/subs/icons/AddSubIcon.vue";

export default {
	name: "add-block",
	components: {
		AddSubIcon
	},
}
</script>

<style scoped>
.sub {
	display: flex;
	justify-content: center;
	align-items: center;
	width: 100%;
}
.sub_icon {
	width: 72px;
	height: 72px;
}
</style>
