<template>
    <div aria-hidden="true" class="popup">
        <div class="popup__wrapper">
            <div class="popup__content">
                <button data-close type="button" class="popup__close">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                        <path
                            d="M38 12.83L35.17 10L24 21.17L12.83 10L10 12.83L21.17 24L10 35.17L12.83 38L24 26.83L35.17 38L38 35.17L26.83 24L38 12.83Z"
                        />
                    </svg>
                </button>
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
import "../Scripts/popup";
export default {
    props: {
        data_attr: {
            type: String,
            default: "popup",
        },
    },
};
</script>

<style>
body::after {
    content: "";
    background-color: rgba(0, 0, 0, 0.5);
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.8s ease 0s;
    pointer-events: none;
    z-index: 149;
}
.popup {
    cursor: pointer;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    padding: 30px 10px;
    transition: visibility 0.8s ease 0s;
    visibility: hidden;
    pointer-events: none;
}
.popup-show body::after {
    opacity: 1;
}
.popup_show {
    z-index: 150;
    visibility: visible;
    overflow: auto;
    pointer-events: auto;
}
.popup_show .popup__content {
    visibility: visible;
    transform: scale(1);
}
.popup__wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100%;
    flex: 1 1 auto;
    width: 100%;
    justify-content: center;
}
.popup__content {
    cursor: default;
    visibility: hidden;
    transform: scale(0);
    transition: transform 0.3s ease 0s;
    background-color: #fff;
    padding: 40px;
    width: 100%;
    max-width: 412px;
    min-height: 257px;
    border-radius: 21px;
    position: relative;
}
@media (max-width: 479.98px) {
    .popup__content {
        padding: 20px;
        min-height: 185px;
    }
}
.lock .popup__content {
    visibility: visible;
}
.popup__close {
    width: 24px;
    height: 24px;
    position: absolute;
    top: 40px;
    right: 40px;
    fill: #000;
    outline: none;
}
@media (max-width: 479.98px) {
    .popup__close {
        top: 20px;
        right: 20px;
    }
}
.popup .title {
    color: #000;
    margin-bottom: 24px;
}
@media (max-width: 767.98px) {
    .popup .title {
        margin-bottom: 20px !important;
    }
    .popup .title:after {
        content: none;
    }
}
.popup__form {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 24px;
}
@media (max-width: 479.98px) {
    .popup__form {
        gap: 20px;
    }
}
.popup__input {
    width: 100%;
    padding: 11px 22px;
    background: #e9edf3;
    border-radius: 21px;
    font-weight: 400;
    font-size: 18px;
    line-height: 26px;
    color: #000034;
}
@media (max-width: 479.98px) {
    .popup__input {
        padding: 10px 22px;
        font-size: 14px;
        line-height: 20px;
    }
}
.popup__input::placeholder {
    color: rgba(0, 0, 0, 0.62);
}
.popup__buttons {
    width: 100%;
    display: flex;
    gap: 14px;
}
@media (max-width: 479.98px) {
    .popup__buttons {
        gap: 10px;
    }
}
.popup__button {
    width: 100%;
}
.popup__text {
    font-size: 18px;
    line-height: 26px;
    color: #595a5c;
}
.popup__text .main__link {
    color: #4182ec;
    transition: all 0.3s ease 0s;
}
.popup__text .main__link:hover {
    text-decoration: underline;
}
.popup .blue-button {
    width: 100% !important;
    border-radius: 13px !important;
}
@media (max-width: 479.98px) {
    .popup .blue-button {
        height: 40px;
    }
    .popup .blue-button .all-link {
        font-size: 14px;
        line-height: 20px;
    }
}
.popup .blue-button:before {
    border-radius: 13px !important;
}
.popup .blue-button.back {
    background: #c2d5f2 !important;
}
.popup .blue-button.back .all-link {
    border-radius: 13px !important;
}
.popup .blue-button.back:before {
    content: none;
}
.popup .blue-button.back:hover {
    transform: none;
}
.popup .blue-button.back:active {
    background: #4182ec !important;
    transform: translate(-4px, -4px);
}
.popup .blue-button.back:active:before {
    content: "";
    top: 4px;
    left: 4px;
}
</style>
