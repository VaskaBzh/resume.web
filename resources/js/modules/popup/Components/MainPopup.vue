<template>
	<div class="popup" :class="{ popup_show: opened }">
		<un-click-view
			:wait="wait"
		/>
		<div class="popup__wrapper">
			<div
				class="popup__content"
				:class="{
                    opened: contentOpened,
                }"
			>
				<logo-light
					v-if="!getTheme"
				/>
				<logo-dark
					v-else
				/>
				<div class="popup__content_block" :class="{ loading: wait }">
					<button type="button" class="popup__close" @click="close">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 48 48"
						>
							<path
								d="M38 12.83L35.17 10L24 21.17L12.83 10L10 12.83L21.17 24L10 35.17L12.83 38L24 26.83L35.17 38L38 35.17L26.83 24L38 12.83Z"
							/>
						</svg>
					</button>
					<slot />
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import { mapGetters } from "vuex";
import LogoLight from "@/modules/popup/icons/LogoLight.vue";
import LogoDark from "@/modules/popup/icons/LogoDark.vue";
import UnClickView from "@/modules/popup/Components/UnClickView.vue";

export default {
	name: "main-popup",
	components: {
		UnClickView,
		LogoLight,
		LogoDark,
	},
	props: {
		wait: Boolean,
		id: String,
		opened: {
			type: Boolean,
			default: false,
		},
		closed: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			opened: false,
			contentOpened: false,
		};
	},
	watch: {
		closed(newBool) {
			if (newBool) {
				this.close();
			}
		},
		opened(newBool) {
			if (newBool) {
				this.open();
			}
		},
	},
	computed: {
		...mapGetters(["getTheme"]),
	},
	methods: {
		async close() {
			this.$emit("closed");
			this.opened = false;
			openedPopups -= 1;
			this.contentOpened = false;
			document.body.classList.remove("popup-show");
			setTimeout(() => {
				document.body.classList.remove("lock");
				this.$emit("closed");
			}, 500);
		},
		async open() {
			this.opened = true;
			openedPopups += 1;
			setTimeout(() => {
				this.contentOpened = true;
			}, 300);
			document.body.classList.add("popup-show");
			document.body.classList.add("lock");
			this.animationEnd
				? setTimeout(() => this.$emit("opened"), this.animationEnd)
				: this.$emit("opened");
		},
		clickClosed(e) {
			if (!this.opened) {
				if (e.target.closest(`[data-popup="#${this.id}"]`)) {
					e.preventDefault();
					this.open();
				}
			} else if (
				!e.target.closest(".popup__content") &&
				!e.target.closest(".un-click")
			) {
				this.close();
			}
		},
		keyClosed(e) {
			if (e.keyCode === 27) this.close(e);
		},
		initFunc() {
			document.addEventListener("mousedown", this.clickClosed, true);
			document.addEventListener("keydown", this.keyClosed);
		},
		destroyFunc() {
			document.removeEventListener("mousedown", this.clickClosed, true);
			document.removeEventListener("keydown", this.keyClosed);

			this.close();
		},
	},
	mounted() {
		this.initFunc();
		// Inertia.on("before", async (event) => {
		//     await this.close();
		// });
	},
	beforeUnmount() {
		this.destroyFunc();
	},
};
</script>
<style lang="scss">
.un-click {
	position: fixed;
	z-index: 9999;
	left: 0;
	top: 0;
	width: 100vw;
	height: 100vh;
}
</style>
