<template>
	<teleport to="body">
		<div
			class="onboarding"
			v-if="isVisible && step_active === step"
			@click="$emit('next')"
		></div>
	</teleport>
	<div
		class="onboarding__card"
		:class="className"
		v-if="isVisible && step_active === step"
	>
		<instruction-title
			:title="$t(title)"
		/>
		<instruction-nav
			:step="step"
			:steps_count="steps_count"
			@next="$emit('next')"
			@prev="$emit('prev')"
			@close="$emit('close')"
		/>
		<instruction-text
			:text="$t(text)"
		/>
	</div>
</template>

<script>
import InstructionTitle from "@/modules/instruction/Components/UI/InstructionTitle.vue";
import InstructionNav from "@/modules/instruction/Components/UI/InstructionNav.vue";
import InstructionText from "@/modules/instruction/Components/UI/InstructionText.vue";
import { InstructionMessage } from "@/modules/instruction/lang/InstructionMessage";

export default {
	name: "instruction-step",
	components: {
		InstructionText,
		InstructionNav,
		InstructionTitle
	},
	i18n: {
		sharedMessages: InstructionMessage,
	},
	props: {
		className: String,
		title: String,
		text: String,
		step: Number,
		step_active: Number,
		steps_count: Number,
		isVisible: Boolean,
	},
	mounted() {
		if (this.isVisible) {
			this.$emit("start");
		}
	},
}
</script>

<style>
.onboarding {
	position: fixed;
	height: 100vh;
	width: 100vw;
	top: 0;
	left: 0;
	z-index: 99;
	background: rgba(0, 0, 0, 0.50);
	cursor: pointer;
}
.onboarding_block {
	transition: all 0.5s ease 0s;
	border-width: 2px;
	border-style: dashed;
	border-color: transparent;
}
.onboarding_block-target {
	border-radius: 24px;
	border-color: var(--text-focus, #2E90FA);
	z-index: 1001;
	position: relative;
}
.onboarding__card {
	border-radius: 16px;
	background: var(--background-datepicker, #2C2F34);
	box-shadow: 0 2px 12px -1px rgba(16, 24, 40, 0.08);
	padding: 8px;
	min-width: 436px;
	position: absolute;
	z-index: 1002;
	max-width: 420px;
}
.onboarding__card-left {
	top: 50%;
	transform: translateY(-50%);
	left: calc(100% + 12px);
}
.onboarding__card-top {
	top: calc(100% + 12px);
	transform: translateX(-50%);
	left: 50%;
}
.onboarding__card-right {
	top: 50%;
	transform: translateY(-50%);
	right: calc(100% + 12px);
}
.onboarding__card-bottom {
	bottom: calc(100% + 12px);
	transform: translateX(-50%);
	left: 50%;
}
</style>
