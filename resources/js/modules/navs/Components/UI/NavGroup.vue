<template>
	<div
		class="group"
		:class="{
			'group-closed': !isOpen,
		}"
		ref="group"
	>
		<span
			class="group_name"
			v-show="group.group_name"
			@click="toggleDropdown"
		>
			{{ group.group_name }}
			<dropdown-icon class="group_icon" />
		</span>
		<transition-group name="tabs">
			<nav-tab
				v-for="(tab, i) in tabs"
				:tab="tab"
				:key="i"
			/>
		</transition-group>
	</div>
</template>

<script>
import NavTab from "@/modules/navs/Components/UI/NavTab.vue";
import DropdownIcon from "../../../common/icons/DropdownIcon.vue";

export default {
	name: "nav-group",
	props: {
		group: Object,
	},
	components: {
		DropdownIcon,
		NavTab,
	},
	data() {
		return {
			isOpen: true,
		};
	},
	methods: {
		toggleDropdown() {
			this.isOpen = !this.isOpen;
		},
		change_height(isOpen) {
			const height = isOpen ? this.$refs.group.scrollHeight : 32;

			this.$refs.group.style.maxHeight = `${height}px`;
		},
	},
	watch: {
		isOpen(newState) {
			setTimeout(() => {
				this.change_height(newState);
			}, 100);
		},
	},
	computed: {
		tabs() {
			return this.isOpen ? this.group.links : [];
		},
	},
	mounted() {
		this.change_height(this.isOpen);
	}
}
</script>

<style scoped lang="scss">
.tabs-enter-active,
.tabs-leave-active {
	transition: all 0.5s ease;
}
.tabs-enter-from,
.tabs-leave-to {
	opacity: 0;
	transform: translateX(-25px);
}
.group {
	display: flex;
	flex-direction: column;
	width: 100%;
	gap: 8px;
	transition: all 0.5s ease;
	overflow: hidden;
}
.group_name {
	min-height: 32px;
	display: inline-flex;
	gap: 8px;
	justify-content: space-between;
	align-items: center;
	color: var(--text-primary-80);
	font-family: NunitoSans, serif;
	font-size: 18px;
	font-weight: 700;
	line-height: 32px;
	cursor: pointer;
	width: 100%;
}
.group_icon {
	transition: all 0.5s ease 0s;
}
.group-closed .group_icon {
	transform: rotate(180deg);
}
</style>
