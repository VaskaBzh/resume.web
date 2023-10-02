<template>
	<div class="sub cabinet__block cabinet__block-card cabinet__block-light">
		<div class="sub__head">
			<span class="sub_name">
				{{ subData.name }}
			</span>
		</div>
		<div class="sub__content">
			<info-block v-for="(sub, i) in subData.data" :key="i" :label="sub.label">
				<template v-slot:value>
					{{ sub.value }}
				</template>
			</info-block>
		</div>
	</div>
</template>

<script>
import InfoBlock from "@/modules/subs/Components/UI/InfoBlock.vue";

export default {
	name: "sub-block",
	props: {
		subData: Object,
	},
	components: {
		InfoBlock,
	}
}
</script>

<style scoped>
.sub {
	position: relative;
	width: 100%;
	display: flex;
	flex-direction: column;
	gap: 12px;
}
.sub::before {
	border-radius: 0 4px 4px 0;
	background: var(--primary-500, #2E90FA);
	top: 50%;
	left: 0;
	transform: translateY(-50%);
	min-height: 88px;
	width: 3px;
}
.sub__head {
	display: flex;
	justify-content: space-between;
}
.sub_name {
	color: var(--text-focus, var(--primary-500, #2E90FA));
	font-family: Unbounded, serif;
	font-size: 16px;
	font-weight: 400;
	line-height: 24px;
}
.sub__content {
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	grid-template-rows: repeat(2, 1fr);
	gap: 16px 0;
}
</style>
