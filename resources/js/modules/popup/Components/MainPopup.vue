<template>
    <div class="popup" :id="id" :class="{ 'popup-show': service.isOpened }">
<!--        <un-click-view :wait="wait" />-->
        <div class="popup__wrapper">
            <div class="popup__content-fake">
                <div class="popup__block-fake">
                    <slot name="instruction" />
                </div>
            </div>
            <div
                class="popup__content onboarding_block"
                :class="[
                    wait ? 'popup__content_block-loading' : '',
                    className,
                ]"
                ref="popup_block"
            >
                <div class="popup__block-logo" ref="popup_logo">
                    <logo-light class="popup_logo" v-show="!isDark" />
                    <logo-dark class="popup_logo" v-show="isDark" />
                </div>
                <!--					v-if="!isDark"-->
                <!--				<logo-dark-->
                <!--					v-else-->
                <!--				/>-->
                <div class="popup__block" ref="popup_content">
                    <button
                        type="button"
                        class="popup_close"
                        @click="service.popupClose"
                    >
                        <popup-cross-icon />
                    </button>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import LogoLight from "@/modules/popup/icons/LogoLight.vue";
import LogoDark from "@/modules/popup/icons/LogoDark.vue";
import UnClickView from "@/modules/popup/Components/UnClickView.vue";
import PopupCrossIcon from "@/modules/popup/icons/PopupCrossIcon.vue";

import { mapGetters } from "vuex";
import { PopupService } from "@/modules/popup/services/PopupService";

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

        },
        closed: {
            type: Boolean,

        },
        makeResize: {
            type: Boolean,
            default: false,
        },
        instructionConfig: Object,
        className: String,
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
                this.service.popupOpen();
            }
        },
        makeResize(newResizeState) {
            // if (newResizeState) {
            //     setTimeout(() => {
            //         this.service.animateOnUpdate();
            //     }, 150);
            // }
        },
    },
    computed: {
        ...mapGetters(["getTheme", "isDark"]),
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
    background: rgba(0, 0, 0, 0.5);
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
    z-index: 112;
}
.popup__wrapper {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    overflow-x: hidden;
    overflow-y: scroll;
    justify-content: center;
}
.popup__wrapper::-webkit-scrollbar {
    width: 0;
    height: 0;
}
.popup__content {
    border-radius: 24px;
    background: var(--background-modal, #212327);
    box-shadow: 0px 2px 12px -5px rgba(16, 24, 40, 0.02);
    width: 280px;
    height: 122px;
    transform: translateY(220px);
    transition: all 0.5s ease 0s;
    padding: 40px;
    position: relative;
    overflow: hidden;
}
.popup__content-fake {
    position: absolute;
    width: 560px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.popup__block-fake {
    position: relative;
    width: 100%;
}
.popup__content .popup__block-logo {
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
    min-width: 480px;
}
.popup_close {
    position: absolute;
    top: -8px;
    right: -8px;
    padding: 10px;
    z-index: 2;
    height: 44px;
    width: 44px;
}
@media (max-width: 998px) {
    .popup__wrapper {
        padding: 16px;
    }
    .popup__content {
        padding: 16px;
    }
    .popup__block {
        min-width: auto;
    }
}
@media (max-width: 595.98px) {
    .popup__block {
        min-width: calc(100vw - 64px);
    }
}
</style>
