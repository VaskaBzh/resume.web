<template>
    <div ref="select" class="select_con" :class="{ open: select_is_open }">
        <div @click="this.toggleSelect" class="select_title main_select">
            <svg
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
                <g clip-path="url(#clip0_1021_16846)">
                    <path
                        d="M5.86231 21.2041H18.1377C19.7327 21.2041 20.5302 20.6833 20.5302 19.6416C20.5302 19.0036 20.3349 18.3233 19.9443 17.6006C19.5537 16.8779 18.989 16.196 18.25 15.5547C17.5111 14.9134 16.6159 14.391 15.5644 13.9873C14.513 13.5836 13.3265 13.3818 12.0049 13.3818C10.6768 13.3818 9.48698 13.5836 8.43555 13.9873C7.38411 14.391 6.48893 14.9134 5.75 15.5547C5.01107 16.196 4.44629 16.8779 4.05566 17.6006C3.66504 18.3233 3.46973 19.0036 3.46973 19.6416C3.46973 20.6833 4.26725 21.2041 5.86231 21.2041ZM5.40332 19.7295C5.27311 19.7295 5.18034 19.71 5.125 19.6709C5.06966 19.6318 5.042 19.5602 5.042 19.4561C5.042 19.059 5.19336 18.5983 5.4961 18.0742C5.79883 17.5501 6.24642 17.044 6.83887 16.5557C7.43131 16.0674 8.16048 15.6621 9.02637 15.3398C9.89225 15.0175 10.8851 14.8564 12.0049 14.8564C13.1246 14.8564 14.1159 15.0175 14.9785 15.3398C15.8411 15.6621 16.5687 16.0674 17.1611 16.5557C17.7536 17.044 18.2012 17.5501 18.5039 18.0742C18.8067 18.5983 18.958 19.059 18.958 19.4561C18.958 19.5602 18.9304 19.6318 18.875 19.6709C18.8197 19.71 18.7302 19.7295 18.6064 19.7295H5.40332ZM12.0049 12.1709C12.7796 12.1709 13.486 11.9626 14.124 11.5459C14.762 11.1292 15.2715 10.5742 15.6523 9.88086C16.0332 9.1875 16.2236 8.4209 16.2236 7.58106C16.2236 6.74772 16.0348 5.99414 15.6572 5.32031C15.2796 4.64648 14.7718 4.111 14.1338 3.71387C13.4958 3.31673 12.7861 3.11816 12.0049 3.11816C11.2301 3.11816 10.5238 3.31999 9.88575 3.72363C9.24772 4.12728 8.73828 4.66764 8.35743 5.34473C7.97657 6.02181 7.78614 6.77376 7.78614 7.60059C7.78614 8.43392 7.97657 9.19727 8.35743 9.89063C8.73828 10.584 9.24772 11.1374 9.88575 11.5508C10.5238 11.9642 11.2301 12.1709 12.0049 12.1709ZM12.0049 10.6963C11.5296 10.6963 11.0918 10.5579 10.6914 10.2812C10.291 10.0046 9.96875 9.63183 9.72461 9.16309C9.48047 8.69433 9.3584 8.1735 9.3584 7.60059C9.3584 7.03418 9.47884 6.52474 9.71973 6.07227C9.96061 5.61979 10.2812 5.26009 10.6816 4.99317C11.082 4.72624 11.5231 4.59278 12.0049 4.59278C12.4932 4.59278 12.9375 4.72298 13.3379 4.9834C13.7383 5.24381 14.0573 5.60026 14.2949 6.05274C14.5325 6.50521 14.6513 7.01465 14.6513 7.58106C14.6513 8.15397 14.5309 8.67643 14.29 9.14844C14.0492 9.62044 13.7285 9.99642 13.3281 10.2764C12.9277 10.5563 12.4867 10.6963 12.0049 10.6963Z"
                        fill="#417FE5"
                    />
                </g>
                <defs>
                    <clipPath id="clip0_1021_16846">
                        <rect
                            width="17.0605"
                            height="18.4082"
                            fill="white"
                            transform="translate(3.46973 2.7959)"
                        />
                    </clipPath>
                </defs>
            </svg>

            {{ $t("header.menu.accounts_title") }}
            <span>
                {{ this.optionsObject.length }}
            </span>
        </div>
        <div class="select_options" v-if="this.optionsObject.length > 0">
            <div
                v-for="(option, i) in this.optionsObject"
                :key="option.value"
                class="select_option"
                :class="{
                    active:
                        option.title ===
                            this.allAccounts[this.getActive]?.name &&
                        this.optionsObject.length > 1,
                }"
                ref="option"
                @mouseover="hoverInEffect(i)"
                @mouseleave="hoverOutEffect(i)"
            >
                <p
                    class="main_select"
                    @click="selectOptions(option.title, option.value)"
                >
                    {{ option.title }}
                    <transition name="fade">
                        <svg
                            v-if="option.title !== this.name"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g clip-path="url(#clip0_1021_16869)">
                                <path
                                    d="M9.96094 19.9658C11.3216 19.9658 12.6026 19.7054 13.8037 19.1846C15.0049 18.6637 16.0645 17.9443 16.9824 17.0264C17.9004 16.1084 18.6198 15.0488 19.1406 13.8477C19.6615 12.6465 19.9219 11.3655 19.9219 10.0049C19.9219 8.64421 19.6615 7.36328 19.1406 6.16211C18.6198 4.96094 17.9004 3.90137 16.9824 2.9834C16.0645 2.06543 15.0033 1.34603 13.7988 0.825196C12.5944 0.304362 11.3119 0.0439453 9.95117 0.0439453C8.5905 0.0439453 7.30957 0.304362 6.1084 0.825196C4.90723 1.34603 3.84928 2.06543 2.93457 2.9834C2.01986 3.90137 1.30208 4.96094 0.78125 6.16211C0.260417 7.36328 0 8.64421 0 10.0049C0 11.3655 0.260417 12.6465 0.78125 13.8477C1.30208 15.0488 2.02148 16.1084 2.93945 17.0264C3.85742 17.9443 4.91699 18.6637 6.11816 19.1846C7.31933 19.7054 8.60026 19.9658 9.96094 19.9658Z"
                                />
                                <path
                                    d="M4.95117 14.3506C4.81445 14.3506 4.6875 14.2903 4.57031 14.1699C4.45312 14.0495 4.39453 13.8721 4.39453 13.6377C4.39453 12.3031 4.58984 11.1507 4.98047 10.1807C5.3711 9.21062 5.97819 8.46354 6.80176 7.93945C7.62533 7.41536 8.6849 7.15332 9.98047 7.15332H10.1367V5.09277C10.1367 4.91699 10.1969 4.76399 10.3174 4.63379C10.4378 4.50358 10.5924 4.43848 10.7812 4.43848C10.9179 4.43848 11.0368 4.4694 11.1377 4.53125C11.2386 4.59309 11.3607 4.68912 11.5039 4.81934L15.7812 8.81348C15.8919 8.91113 15.9668 9.00879 16.0059 9.10645C16.045 9.2041 16.0645 9.30175 16.0645 9.39941C16.0645 9.49055 16.0433 9.58496 16.001 9.68262C15.9587 9.78027 15.8854 9.87793 15.7812 9.97559L11.5039 13.999C11.3802 14.1162 11.2614 14.2041 11.1475 14.2627C11.0336 14.3213 10.9082 14.3506 10.7715 14.3506C10.5892 14.3506 10.4378 14.2903 10.3174 14.1699C10.1969 14.0495 10.1367 13.9014 10.1367 13.7256V11.6553H9.98047C8.93229 11.6553 8.06152 11.818 7.36816 12.1436C6.6748 12.4691 6.09049 13.0713 5.61523 13.9502C5.5306 14.126 5.42806 14.2366 5.30762 14.2822C5.18717 14.3278 5.06836 14.3506 4.95117 14.3506Z"
                                    fill="white"
                                />
                            </g>
                            <defs>
                                <clipPath id="clip0_1021_16869">
                                    <rect
                                        width="19.9219"
                                        height="19.9316"
                                        fill="white"
                                        transform="translate(0 0.0341797)"
                                    />
                                </clipPath>
                            </defs>
                        </svg>
                    </transition>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import anime from "animejs/lib/anime.es.js";

export default {
    name: "auto-height-select",
    props: {
        options: Array,
        selectType: {
            type: String,
            default: "normal",
        },
        open: Boolean,
    },
    data() {
        return {
            select_is_open: false,
            height: 0,
        };
    },
    // updated() {
    //     if (this.open && this.select_is_open === false) {
    //         console.log(this.select_is_open);
    //         this.openSelect();
    //     }
    // },
    computed: {
        ...mapGetters(["allAccounts", "getActive"]),
        name() {
            let str = "";
            if (this.allAccounts && this.allAccounts[this.getActive]) {
                str = this.allAccounts[this.getActive].name;
            }
            return str;
        },
        optionsObject() {
            let obj = [];
            if (this.options[0]) {
                for (let i = 0; i < this.options.length; i++) {
                    obj.push(this.options[i]);
                }
            }
            return obj;
        },
    },
    emits: ["getAcc"],
    methods: {
        selectOptions(optionTitle, optionValue) {
            this.baseOption = optionTitle;
            this.$emit("getAcc", optionValue);
            this.hideSelect();
        },
        hideSelect(e) {
            if (!e?.target.closest(".select_con")) {
                this.select_is_open = false;
            }
        },
        openSelect() {
            if (this.select_is_open === false) {
                this.select_is_open = true;
            }
        },
        toggleSelect() {
            this.select_is_open = !this.select_is_open;
        },
        hoverInEffect(i) {
            let target = this.$refs.option[i];
            if (!this.$refs.option[i].classList.contains("active")) {
                anime({
                    targets: target,
                    easing: "linear",
                    translateX: 8,
                    duration: 200,
                });
            }
        },
        hoverOutEffect(i) {
            let target = this.$refs.option[i];
            anime({
                targets: target,
                easing: "linear",
                translateX: 0,
                duration: 200,
            });
        },
    },
    mounted() {
        this.$refs.select
            .querySelectorAll(".select_option")
            .forEach((option) => {
                this.height += option.offsetHeight;
            });
        document.addEventListener("click", this.hideSelect.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideSelect();
            }
        });
    },
    unmounted() {
        // document.removeEventListener("click", this.hideSelect.bind(this), true);
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideSelect();
            }
        });
    },
};
</script>
<style lang="scss" scoped>
//.fade {
//    &-enter {
//        &-active {
//            path:first-child {
//                fill: #417fe5 !important;
//            }
//        }
//    }
//    &-leave {
//        &-active {
//            path:first-child {
//                fill: #EAEEF4 !important;
//            }
//        }
//    }
//}
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.select {
    &_con {
        height: fit-content;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 36px;
        width: 100%;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        position: relative;
        &.open {
            .select {
                &_title {
                    background: rgba(234, 238, 244, 0.4);
                }
                &_options {
                    max-height: 20vh;
                    opacity: 1;
                    visibility: visible;
                }
                &_title {
                    svg {
                        &:first-child {
                            transform: rotate(90deg);
                        }
                    }
                }
            }
        }
    }
    &_title {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        position: relative;
        padding: 0 4px;
        transition: all 0.3s ease 0s;
        background: transparent;
        border-radius: 8px;
        width: 100%;
        height: 36px;
        font-weight: 400;
        font-size: 17px;
        line-height: 143.1%;
        color: #000034;
        &:hover {
            background: rgba(234, 238, 244, 0.4);
        }
        svg {
            width: 24px;
            height: 24px;
            &:first-child {
                width: 16px;
                height: 16px;
                margin-right: -6px;
                transition: all 0.3s ease 0s;
            }
        }
        span {
            position: absolute;
            width: 16px;
            height: 16px;
            top: 50%;
            right: 4px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            transform: translateY(-50%);
            font-weight: 500;
            font-size: 14px;
            line-height: 143.1%;
            color: #969797;
            border-radius: 50%;
            background: rgba(234, 238, 244, 0.4);
            text-align: center;
        }
    }
    &_options {
        display: flex;
        flex-direction: column;
        width: 100%;
        transition: all 1s ease 0s;
        border-width: 0 1px 1px 1px;
        border-style: solid;
        border-color: rgba(234, 238, 244, 0.4);
        border-radius: 0 0 8px 8px;
        max-height: 0;
        visibility: hidden;
        opacity: 0;
        svg path:first-child {
            fill: #eaeef4;
            transition: all 0.8s ease-in 0s;
        }
    }
    &_option {
        width: 100%;
        background: transparent;
        padding: 0 12px;
        height: 36px;
        min-height: 36px;
        transition: background 0.3s ease 0s, padding 0.8s ease 0s;
        &.active {
            padding: 0 10px;
            &:hover {
                background: transparent;
            }
            .main_select {
                background: rgba(234, 238, 244, 0.4);
                border-radius: 8px;
                padding: 0 10px;
            }
        }
        &:first-child {
            margin-top: 12px;
        }
        &:last-child {
            margin-bottom: 12px;
        }
        .main_select {
            width: 100%;
            height: 100%;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            font-weight: 400;
            font-size: 17px;
            transition: background 0.3s ease 0s, padding 0.8s ease 0s;
            line-height: 143.1%;
            color: #000034;
        }
        svg {
            width: 20px;
            height: 20px;
        }
        //&:hover {
        //    //    background: rgba(234, 238, 244, 0.4);
        //    //    transition: padding 0.8s ease 0s;
        //    transition: background 0.3s ease 0s, padding 0.3s ease 0s;
        //    padding: 0 10px;
        //    .main_select {
        //        padding: 0 10px;
        //        //transition: padding 0.8s ease 0s;
        //        transition: background 0.3s ease 0s, padding 0.3s ease 0s;
        //    }
        //}
    }
}
</style>
