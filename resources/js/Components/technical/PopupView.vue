<template>
    <div aria-hidden="true" class="popup">
        <div class="popup__wrapper">
            <div
                :class="
                    this.typePopup === 'form'
                        ? 'popup__content'
                        : `popup__content popup__content-${this.typePopup}`
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
.loading {
    form {
        .blue-button {
            background: rgba(#4282ec, 0.8) !important;
            .all-link {
                svg {
                    max-width: 100%;
                    max-height: 100%;
                    overflow: visible;
                    visibility: visible;
                    opacity: 1;
                    path {
                        transform-origin: center;
                        fill: #ffffff;
                        &:first-child {
                            animation: rotate 2s linear 0s infinite;;
                        }
                        &:nth-child(2) {
                            animation: reRotate 2s linear 0s infinite;;
                        }
                        &:last-child {
                            animation: rotate 2s linear 0s infinite;;
                        }
                    }
                }
            }
        }
    }
}
@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
@keyframes reRotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(-360deg);
    }
}
</style>
