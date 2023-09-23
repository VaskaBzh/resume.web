<template>
	<router-link
		:to="tab.name"
		class="tab"
		:class="{
            burger_link: viewportWidth < 991.98,
            'tab-active': $route.fullPath === tab.url,
        }"
	>
		<svg
			class="tab_icon"
			v-html="tab.icon"
			xmlns="http://www.w3.org/2000/svg"
			width="24"
			height="25"
			viewBox="0 0 24 25"
			fill="none"
		></svg>
		<span class="tab_text">
            {{ $t(`tabs.${tab.name}`) }}
        </span>
	</router-link>
</template>

<script>
import { mapGetters } from "vuex";

export default {
	name: "nav-tab",
	props: {
		tab: Object,
	},
	computed: {
		...mapGetters(["viewportWidth"])
	}
}
</script>

<style scoped>
.tab {
	width: 100%;
	display: inline-flex;
	align-items: center;
	padding: 0 16px;
	min-height: 48px;
	transition: all 0.5s ease 0s;
	border-radius: 12px;
	background: transparent;
	gap: 16px;
}
.tab:hover,
.tab-active {
	background: var(--primary-4007, rgba(83, 177, 253, 0.07));
}
.tab_text {
	color: var(--text-secondary, #475467);
	font-family: NunitoSans, serif;
	font-size: 18px;
	font-weight: 400;
	line-height: 32px;
	transition: all 0.5s ease 0s;
}
.tab_icon {
	width: 24px;
	height: 24px;
	stroke: var(--light-gray-400, #98A2B3);
}
.tab:hover .tab_text,
.tab-active .tab_text {
	color: var(--primary-500, #2E90FA);
}
.tab:hover .tab_icon,
.tab-active .tab_icon {
	stroke: var(--primary-500, #2E90FA);
}
</style>
