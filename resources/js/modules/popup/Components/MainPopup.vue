<template>
	<div class="popup" :class="{ 'popup-show': service.isOpened }">
		<un-click-view
			:wait="wait"
		/>
		<div class="popup__wrapper">
			<div
				class="popup__content"
                :class="{ 'popup__content_block-loading': wait }"
                ref="popup_block"
			>
                <div
                    class="popup__block-logo"
                    ref="popup_logo"
                >
                    <logo-light
                        class="popup_logo"
                    />
                </div>
                <!--					v-if="!getTheme"-->
                <!--				<logo-dark-->
                <!--					v-else-->
                <!--				/>-->
                <div
                    class="popup__block"
                    ref="popup_content"
                >
                    <button type="button" class="popup_close" @click="service.popupClose">
                        <popup-cross-icon />
                    </button>
                    <slot />
                </div>
			</div>
		</div>
	</div>
</template>
<script>
import { mapGetters } from "vuex";
import { PopupService } from "@/modules/popup/services/PopupService";
import LogoLight from "@/modules/popup/icons/LogoLight.vue";
import LogoDark from "@/modules/popup/icons/LogoDark.vue";
import UnClickView from "@/modules/popup/Components/UnClickView.vue";
import PopupCrossIcon from "@/modules/popup/icons/PopupCrossIcon.vue";

export default {
	name: "main-popup",
	components: {
		PopupCrossIcon,
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
			service: new PopupService(this.id, this.$emit),
		};
	},
	watch: {
		closed(newBool) {
			if (newBool) {
				this.service.popupClose();
			}
		},
		opened(newBool) {
			if (newBool) {
                console.log(this.id)
				this.service.popupOpen();
			}
		},
        '$refs.popup_content'(newPopupContentHtml) {
            this.service.setPopupContentHtml(newPopupContentHtml);
        },
        '$refs.popup_block'(newPopupBlockHtml) {
            this.service.setPopupBlockHtml(newPopupBlockHtml);
        },
        '$refs.popup_logo'(newPopupLogoHtml) {
            this.service.setPopupLogoHtml(newPopupLogoHtml);
        }
	},
	computed: {
		...mapGetters(["getTheme"]),
	},
	mounted() {
        this.service.setPopupContentHtml(this.$refs.popup_content);
        this.service.setPopupBlockHtml(this.$refs.popup_block);
        this.service.setPopupLogoHtml(this.$refs.popup_logo);
		this.service.initFunc();
	},
	beforeUnmount() {
		this.service.destroyFunc();
	},
};
</script>
<style scoped>
.popup {
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.15);
    position: fixed;
    z-index: -1;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: hidden;
    opacity: 0;
    transition: all 0.5s ease 0s, z-index 0s ease 0.5s;
}
.popup-show {
    transition: all 0.5s ease 0s, z-index 0s ease 0s;
    overflow: visible;
    opacity: 1;
    z-index: 1;
}
.popup__wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    overflow: scroll;
    justify-content: center;
}
.popup__content {
    border-radius: 24px;
    background: var(--background-modal-day, #F8FAFD);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    width: 280px;
    height: 122px;
    transform: translateY(220px);
    padding: 32px;
    transition: all 0.5s ease 0s;
    position: relative;
}
.popup__content
.popup__block-logo {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.popup__block {
    display: flex;
    flex-direction: column;
    position: relative;
    opacity: 0;
}
.popup_close {
    position: absolute;
    top: -8px;
    right: -8px;
    padding: 8px;
}
</style>
