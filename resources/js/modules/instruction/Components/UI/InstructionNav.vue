<template>
	<div class="nav">
		<span class="nav_text">
			{{ $t('step') }}
			{{ step }} / {{ steps_count }}
		</span>
		<div class="nav__buttons">
			<button class="nav_button" v-show="step > 1" @click="prevSlide">
				<arrow-left-icon class="nav_icon" />
			</button>
			<button class="nav_button nav_button-next" v-show="step < steps_count" @click="nextSlide">
				<arrow-right-icon class="nav_icon" />
			</button>
			<button class="nav_button" @click="closeSlide">
				<close-icon class="nav_icon" />
			</button>
		</div>
	</div>
</template>

<script>
import ArrowRightIcon from "@/modules/instruction/icons/ArrowRightIcon.vue";
import ArrowLeftIcon from "@/modules/instruction/icons/ArrowLeftIcon.vue";
import CloseIcon from "@/modules/instruction/icons/CloseIcon.vue";
import { InstructionMessage } from "@/modules/instruction/lang/InstructionMessage";

export default {
	name: "instruction-nav",
	components: {
		ArrowLeftIcon,
		ArrowRightIcon,
		CloseIcon,
	},
	i18n: {
		sharedMessages: InstructionMessage,
	},
	props: {
		step: Number,
		steps_count: Number,
	},
	methods: {
		prevSlide() {
			if (this.step > 1) {
				this.$emit('prev');
			}
		},
		nextSlide() {
			this.$emit('next');
		},
		closeSlide() {
			this.$emit('close');
		},
		keyHandler(e) {
			if (e.keyCode === 27) {
				this.closeSlide();
			}
			if (e.keyCode === 13 || e.keyCode === 39 || e.keyCode === 9) {
				this.nextSlide();
			}
			if (e.keyCode === 37) {
				this.prevSlide();
			}
		}
	},
	created() {
		document.addEventListener("keydown", this.keyHandler);
	},
	beforeUnmount() {
		document.removeEventListener("keydown", this.keyHandler);
	}
}
</script>

<style scoped>
.nav {
	width: 100%;
	padding: 12px;
	border-radius: 16px;
	background: var(--background-modal, #212327);
	box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.05);
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.nav_text {
	color: var(--text-primary-80, rgba(241, 241, 242, 0.80));
	font-family: Unbounded, serif;
	font-size: 18px;
	font-weight: 400;
	line-height: 28px;
}
.nav__buttons {
	display: flex;
	gap: 8px;
	align-items: center;
}
.nav_button {
	outline: none;
	border: none;
	border-radius: 50%;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	min-height: 40px;
	min-width: 40px;
	background: var(--background-tooltip, rgba(44, 47, 52, 0.90));
	filter: drop-shadow(0px 3.809523582458496px 6.666666507720947px rgba(14, 14, 14, 0.05));
}
.nav_button .nav_icon {
	transition: all 0.5s ease 0s;
}
.nav_button-next {
	background: var(--background-island-inner-2, rgba(83, 177, 253, 0.15));
}
.nav_button-next .nav_icon {
	fill: #2E90FAFF;
}
.nav_button:hover .nav_icon {
	fill: #2E90FAFF;
}
</style>
