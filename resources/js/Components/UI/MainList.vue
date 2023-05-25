<template>
    <div class="list" :class="{ open: this.list_is_open }">
        <div class="list_head" @click="this.toggleList">
            <svg
                class="arrow"
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M12.0863 7.78131C12.0863 7.6649 12.0633 7.55614 12.0174 7.45503C11.9714 7.35393 11.9056 7.26048 11.8198 7.1747L7.08998 2.592C6.92454 2.43268 6.72234 2.35303 6.48337 2.35303C6.33018 2.35303 6.18925 2.38979 6.06058 2.46332C5.9319 2.53685 5.8308 2.63642 5.75727 2.76203C5.68374 2.88765 5.64697 3.03011 5.64697 3.18942C5.64697 3.41614 5.72663 3.61528 5.88594 3.78685L10.0275 7.78131L5.88594 11.7758C5.72663 11.9474 5.64697 12.1465 5.64697 12.3733C5.64697 12.5326 5.68374 12.675 5.75727 12.8007C5.8308 12.9263 5.9319 13.0258 6.06058 13.0993C6.18925 13.1728 6.33018 13.2096 6.48337 13.2096C6.72234 13.2096 6.92455 13.1269 7.08999 12.9615L11.8198 8.38793C11.9056 8.30215 11.9714 8.20871 12.0174 8.1076C12.0633 8.0065 12.0863 7.89774 12.0863 7.78131Z"
                    fill="#969797"
                />
            </svg>

            <svg
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <g clip-path="url(#clip0_1021_16712)">
                    <path
                        d="M4.91016 16.9268H7.30273C7.58919 16.9268 7.82031 16.8389 7.99609 16.6631C8.17188 16.4873 8.25977 16.2627 8.25977 15.9893V14.1826C8.25977 13.9026 8.17188 13.6764 7.99609 13.5039C7.82031 13.3314 7.58919 13.2451 7.30273 13.2451H4.91016C4.6237 13.2451 4.39258 13.3314 4.2168 13.5039C4.04101 13.6764 3.95312 13.9026 3.95312 14.1826V15.9893C3.95312 16.2627 4.04101 16.4873 4.2168 16.6631C4.39258 16.8389 4.6237 16.9268 4.91016 16.9268ZM1.31641 9.76855H22.6934V7.55175H1.31641V9.76855ZM3.5918 20.3448H20.4082C21.4303 20.3448 22.1969 20.0925 22.708 19.5879C23.2191 19.0833 23.4746 18.3298 23.4746 17.3272V6.69238C23.4746 5.68978 23.2191 4.93457 22.708 4.42676C22.1969 3.91895 21.4303 3.66504 20.4082 3.66504H3.5918C2.56966 3.66504 1.80306 3.91732 1.29199 4.42188C0.780925 4.92643 0.525391 5.68327 0.525391 6.69238V17.3272C0.525391 18.3298 0.780925 19.0833 1.29199 19.5879C1.80306 20.0925 2.56966 20.3448 3.5918 20.3448ZM3.61133 18.7725C3.12305 18.7725 2.7487 18.6439 2.48828 18.3867C2.22787 18.1295 2.09766 17.7471 2.09766 17.2393V6.78027C2.09766 6.27246 2.22787 5.88835 2.48828 5.62793C2.7487 5.36751 3.12305 5.2373 3.61133 5.2373H20.3887C20.8704 5.2373 21.2431 5.36751 21.5068 5.62793C21.7705 5.88835 21.9024 6.27246 21.9024 6.78027V17.2393C21.9024 17.7471 21.7705 18.1295 21.5068 18.3867C21.2431 18.6439 20.8704 18.7725 20.3887 18.7725H3.61133Z"
                        fill="#417FE5"
                    />
                </g>
                <defs>
                    <clipPath id="clip0_1021_16712">
                        <rect
                            width="22.9492"
                            height="16.6895"
                            fill="white"
                            transform="translate(0.525391 3.65527)"
                        />
                    </clipPath>
                </defs>
            </svg>

            <slot name="head"></slot>
        </div>
        <div class="list_body">
            <slot class="list_body" name="body"></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "main-list",
    data() {
        return {
            list_is_open: false,
        };
    },
    methods: {
        toggleList() {
            this.list_is_open = !this.list_is_open;
        },
        hideList(e) {
            if (!e.target.closest(".open")) {
                this.list_is_open = false;
            }
        },
    },
    mounted() {
        document.addEventListener("click", this.hideList.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideList();
            }
        });
    },
    unmounted() {
        document.removeEventListener("click", this.hideList.bind(this));
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideList();
            }
        });
    },
};
</script>

<style lang="scss">
.list {
    position: relative;
    max-width: 320px;
    width: 100%;
    min-height: 36px;
    cursor: pointer;
    height: fit-content;
    overflow: hidden;
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    &_head {
        font-weight: 400;
        display: inline-flex;
        align-items: center;
        padding: 0 4px;
        gap: 10px;
        line-height: 24px;
        transition: all 0.3s ease 0s;
        font-size: 17px;
        height: 36px;
        background: transparent;
        &:hover {
            background: rgba(234, 238, 244, 0.4);
        }
        svg {
            width: 24px;
            height: 24px;
            &:first-child {
                margin-right: -6px;
                width: 16px;
                height: 16px;
                transition: all 0.3s ease 0s;
            }
        }
    }
    &_body {
        max-height: 0;
        display: flex;
        flex-direction: column;
        visibility: hidden;
        opacity: 0;
        gap: 12px;
        border-width: 0 1px 1px 1px;
        border-style: solid;
        border-color: rgba(234, 238, 244, 0.4);
        border-radius: 0 0 8px 8px;
        padding: 0 12px;
        transition: all 1s ease 0s;
    }
    &_row {
        display: inline-flex;
        flex-direction: column;
        font-weight: 400;
        font-size: 17px;
        color: #000034;
        line-height: 143.1%;
        &:first-child {
            padding: 12px 0 0;
        }
        &:last-child {
            padding: 0 0 12px;
        }
        span {
            &:first-child {
                color: #969797;
                font-size: 14px;
                line-height: 143.1%;
                font-weight: 500;
            }
        }
    }
    &_button {
        min-height: 36px !important;
        border-radius: 8px !important;
        width: 100% !important;
        border: 1.4px solid #417fe5 !important;
        color: #417fe5 !important;
        background: transparent !important;
        justify-content: center !important;
        display: flex !important;
        &:hover {
            transform: translate(0) !important;
        }
        &:before {
            content: none !important;
        }
        a {
            width: fit-content !important;
            border-radius: 0 !important;
            &:hover {
                background: transparent !important;
            }
        }
    }
    &.open {
        .list {
            &_head {
                background: rgba(234, 238, 244, 0.4);
                svg {
                    &:first-child {
                        transform: rotate(90deg);
                    }
                }
            }
            &_body {
                max-height: 300px;
                visibility: visible;
                opacity: 1;
            }
        }
    }
}
</style>
