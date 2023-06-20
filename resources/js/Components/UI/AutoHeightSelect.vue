<template>
    <div ref="select" class="select_con" :class="{ open: select_is_open }">
        <div @click="this.toggleSelect" class="select_title main_select">
            <svg
                width="16"
                height="17"
                viewBox="0 0 16 17"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M8.00033 8.4834C7.26699 8.4834 6.66699 8.25007 6.20033 7.7834C5.73366 7.31673 5.50033 6.71673 5.50033 5.9834C5.50033 5.25007 5.73366 4.65007 6.20033 4.1834C6.66699 3.71673 7.26699 3.4834 8.00033 3.4834C8.73366 3.4834 9.33366 3.71673 9.80033 4.1834C10.267 4.65007 10.5003 5.25007 10.5003 5.9834C10.5003 6.71673 10.267 7.31673 9.80033 7.7834C9.33366 8.25007 8.73366 8.4834 8.00033 8.4834ZM2.66699 13.8334V12.2667C2.66699 11.8445 2.77255 11.4834 2.98366 11.1834C3.19477 10.8834 3.46699 10.6556 3.80033 10.5001C4.54477 10.1667 5.25866 9.91673 5.94199 9.75007C6.62533 9.5834 7.31144 9.50007 8.00033 9.50007C8.68921 9.50007 9.37255 9.58618 10.0503 9.7584C10.7281 9.93062 11.4388 10.1789 12.1823 10.5033C12.5301 10.6603 12.809 10.8878 13.0188 11.1861C13.2287 11.4843 13.3337 11.8445 13.3337 12.2667V13.8334H2.66699ZM3.66699 12.8334H12.3337V12.2667C12.3337 12.089 12.2809 11.9195 12.1753 11.7584C12.0698 11.5973 11.9392 11.4778 11.7837 11.4001C11.0725 11.0556 10.4225 10.8195 9.83366 10.6917C9.24477 10.564 8.63366 10.5001 8.00033 10.5001C7.36699 10.5001 6.75033 10.564 6.15033 10.6917C5.55033 10.8195 4.90033 11.0556 4.20033 11.4001C4.04477 11.4778 3.91699 11.5973 3.81699 11.7584C3.71699 11.9195 3.66699 12.089 3.66699 12.2667V12.8334ZM8.00033 7.4834C8.43366 7.4834 8.79199 7.34173 9.07533 7.0584C9.35866 6.77507 9.50033 6.41673 9.50033 5.9834C9.50033 5.55007 9.35866 5.19173 9.07533 4.9084C8.79199 4.62507 8.43366 4.4834 8.00033 4.4834C7.56699 4.4834 7.20866 4.62507 6.92533 4.9084C6.64199 5.19173 6.50033 5.55007 6.50033 5.9834C6.50033 6.41673 6.64199 6.77507 6.92533 7.0584C7.20866 7.34173 7.56699 7.4834 8.00033 7.4834Z"
                    fill="#3F7BDD"
                />
            </svg>

            <span class="name"
                >{{ $t("header.menu.accounts_title") }}
                <span>{{ this.optionsObject.length }}</span></span
            >

            <svg
                width="16"
                height="16"
                viewBox="0 0 16 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M1.36686 5.06712L2.31686 4.13379L8.03353 9.85046L13.7502 4.13379L14.7002 5.06712L8.03353 11.7338L1.36686 5.06712Z"
                />
            </svg>
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
            >
                <p
                    class="main_select"
                    @click="selectOptions(option.title, option.value)"
                >
                    {{ option.title }}
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
    },
    mounted() {
        document.addEventListener("click", this.hideSelect.bind(this), true);
        document.addEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideSelect();
            }
        });
    },
    unmounted() {
        document.removeEventListener("click", this.hideSelect.bind(this));
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideSelect();
            }
        });
    },
};
</script>
<style lang="scss" scoped>
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
        display: flex;
        flex-direction: column;
        width: 100%;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        position: relative;
        min-height: 25px;
        &.open {
            .select {
                &_options {
                    max-height: 20vh;
                    opacity: 1;
                    visibility: visible;
                }
                &_title {
                    svg {
                        &:last-child {
                            transform: rotate(180deg);
                        }
                    }
                }
            }
        }
    }
    &_title {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease 0s;
        width: 100%;
        font-weight: 400;
        font-size: 16px;
        line-height: 120%;
        color: #343434;
        .name {
            position: relative;
            span {
                position: absolute;
                width: 16px;
                height: 16px;
                border-radius: 50%;
                background: #ecf0f8;
                color: #818c99;
                font-weight: 400;
                font-size: 11.2px;
                line-height: 110%;
                bottom: calc(19px / 2);
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        }
        svg {
            width: 16px;
            height: 16px;
            &:last-child {
                margin-left: auto;
                transition: all 0.3s ease 0s;
                fill: #343434;
            }
        }
    }
    &_options {
        display: flex;
        flex-direction: column;
        width: 100%;
        transition: all 1s ease 0s;
        max-height: 0;
        visibility: hidden;
        opacity: 0;
        gap: 8px;
        padding: 0 20px 0;
    }
    &_option {
        width: 100%;
        &.active {
            .main_select {
                color: #3f7bdd;
            }
        }
        &:first-child {
            margin-top: 16px;
        }
        &:last-child {
            margin-bottom: 16px;
        }
        .main_select {
            width: 100%;
            height: 100%;
            display: inline-flex;
            align-items: center;
            font-weight: 400;
            font-size: 14px;
            line-height: 120%;
            color: #818c99;
            transition: all 0.3s ease 0s;
        }
    }
}
</style>
