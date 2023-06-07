<template>
    <div aria-hidden="true" class="popup" ref="popup">
        <Teleport to="body">
            <div class="un-click" v-if="this.wait === true"></div>
        </Teleport>
        <div class="popup__wrapper">
            <div
                class="popup__content"
                :class="
                    this.typePopup === 'form'
                        ? ''
                        : `popup__content-${this.typePopup}`
                "
            >
                <img
                    class="popup__content_logo"
                    src="../../../assets/img/logo_high_quality.png"
                    alt="logo"
                />
                <div
                    class="popup__content_block"
                    :class="{ loading: this.wait }"
                >
                    <button data-close type="button" class="popup__close">
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
import "../../Scripts/popup";
export default {
    name: "main-popup",
    props: {
        typePopup: {
            type: String,
            default: "form",
        },
        wait: Boolean,
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
