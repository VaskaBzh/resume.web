<template>
    <div
        v-if="selectType == 'mini'"
        class="select_con select_con-mini"
        :class="{ open: select_is_open }"
    >
        <div
            @click="this.select_is_open = !this.select_is_open"
            class="select_title"
        >
            <img :src="this.baseImg" />
            {{ this.baseOption }}
        </div>
        <div class="select_options">
            <div
                v-for="(option, i) in this.options"
                :key="option.value"
                class="select_option"
            >
                <p @click="selectOptions(option.title, option.img)">
                    <img :src="this.optionsImgs[i]" />
                    {{ option.title }}
                </p>
            </div>
        </div>
    </div>
    <div
        v-else-if="selectType == 'large'"
        class="select_con select_con-large"
        :class="{ open: select_is_open }"
    >
        <div
            @click="this.select_is_open = !this.select_is_open"
            class="select_title"
        >
            <!--            <img :src="this.baseImg" />-->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="33"
                height="33"
                viewBox="0 0 33 33"
                fill="none"
            >
                <circle
                    cx="16.5"
                    cy="16.5"
                    r="16.5"
                    fill="#FFDA7A"
                    fill-opacity="0.19"
                />
                <path
                    d="M7 15.6C7 14.75 7.2413 14.1043 7.7239 13.663C8.20713 13.221 8.7575 13 9.375 13C9.78667 13 10.1863 13.096 10.5739 13.288C10.9621 13.4793 11.2829 13.775 11.5362 14.175C11.7579 14.5417 12.0429 14.8373 12.3912 15.062C12.7396 15.2873 13.1117 15.4417 13.5075 15.525L13.65 15.225C13.6975 15.125 13.7529 15.0333 13.8163 14.95L13.0325 12.65C12.9375 12.3667 12.8583 12.0917 12.795 11.825C12.7317 11.5583 12.7 11.2833 12.7 11C12.7 9.95 13.1354 9.02067 14.0063 8.212C14.8771 7.404 16.1517 7 17.83 7C18.6375 7 19.2512 7.25433 19.6711 7.763C20.0904 8.271 20.3 8.84167 20.3 9.475C20.3 9.90833 20.2091 10.3333 20.0274 10.75C19.845 11.1667 19.5637 11.5083 19.1837 11.775C18.8354 12.0083 18.5545 12.3083 18.3411 12.675C18.127 13.0417 17.9804 13.4333 17.9013 13.85L18.1862 14C18.2812 14.05 18.3683 14.1083 18.4475 14.175L20.6325 13.35C20.9017 13.25 21.1629 13.1667 21.4162 13.1C21.6696 13.0333 21.9229 13 22.1762 13C23.1896 13 24.0804 13.4583 24.8486 14.375C25.6162 15.2917 26 16.6333 26 18.4C26 19.25 25.7587 19.896 25.2761 20.338C24.7929 20.7793 24.2504 21 23.6487 21C23.2371 21 22.8333 20.9043 22.4375 20.713C22.0417 20.521 21.7171 20.225 21.4637 19.825C21.2421 19.4583 20.9571 19.1627 20.6087 18.938C20.2604 18.7127 19.8883 18.5583 19.4925 18.475L19.35 18.775C19.3025 18.875 19.2471 18.9667 19.1837 19.05L19.9912 21.35C20.0862 21.6333 20.1616 21.9043 20.2173 22.163C20.2724 22.421 20.3 22.6917 20.3 22.975C20.3 24.325 19.7696 25.3333 18.7087 26C17.6479 26.6667 16.4683 27 15.17 27C14.3625 27 13.7491 26.7333 13.3298 26.2C12.9099 25.6667 12.7 25.075 12.7 24.425C12.7 24.0083 12.7912 23.604 12.9736 23.212C13.1554 22.8207 13.4363 22.4917 13.8163 22.225C14.1646 21.9917 14.4455 21.6917 14.6589 21.325C14.873 20.9583 15.0196 20.5667 15.0987 20.15L14.8137 20C14.7188 19.95 14.6317 19.8917 14.5525 19.825L12.3675 20.65C12.1142 20.75 11.8725 20.8333 11.6426 20.9C11.4134 20.9667 11.1721 21 10.9187 21C9.88958 21.0167 8.97917 20.5667 8.1875 19.65C7.39583 18.7333 7 17.3833 7 15.6ZM15.075 17C15.075 17.4167 15.2137 17.7707 15.4911 18.062C15.7679 18.354 16.1042 18.5 16.5 18.5C16.8958 18.5 17.2321 18.354 17.5089 18.062C17.7863 17.7707 17.925 17.4167 17.925 17C17.925 16.5833 17.7863 16.2293 17.5089 15.938C17.2321 15.646 16.8958 15.5 16.5 15.5C16.1042 15.5 15.7679 15.646 15.4911 15.938C15.2137 16.2293 15.075 16.5833 15.075 17Z"
                    fill="#E9C058"
                />
            </svg>
            {{ this.baseOption }}
        </div>
        <div class="select_options">
            <div
                v-for="option in this.options"
                :key="option.value"
                class="select_option"
            >
                <p @click="selectOptions(option.title, option.img)">
                    <!--                    <img :src="this.optionsImgs[i]" />-->
                    {{ option.title }}
                </p>
            </div>
        </div>
    </div>
    <div v-else class="select_con" :class="{ open: select_is_open }">
        <div
            @click="this.select_is_open = !this.select_is_open"
            class="select_title"
        >
            {{ this.baseOption }}
        </div>
        <div class="select_options">
            <div
                v-for="option in this.options"
                :key="option.value"
                class="select_option"
            >
                <p @click="selectOption(option.title)">{{ option.title }}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "main-select",
    props: {
        options: Array,
        selectType: {
            type: String,
            default: "normal",
        },
    },
    data() {
        return {
            select_is_open: false,
            baseOption: "",
            baseImg: "",
        };
    },
    computed: {
        optionsImgs() {
            let obj = [];
            for (let i = 0; i < this.options.length; i++) {
                // obj.push(require(`@/assets/img/${this.options[i].img}`));
            }
            return obj;
        },
    },
    methods: {
        selectOption(option) {
            this.baseOption = option;
        },
        selectOptions(optionTitle) {
            this.baseOption = optionTitle;
            // this.baseImg = require(`@/assets/img/${optionImg}`);
        },
        hideSelect() {
            this.select_is_open = false;
        },
    },
    mounted() {
        document.addEventListener("click", this.hideSelect.bind(this), true);
        this.baseOption = this.options[0].title;
        if (this.options[0].img) {
            // this.baseImg = require(`@/assets/img/${this.options[0].img}`);
        }
    },
};
</script>
<style lang="scss" scoped>
$miniHeight: 40px;
$largeHeight: 61px;
$height: 48px;

.select {
    // .select_con
    &_con {
        position: relative;
        max-width: 320px;
        width: 100%;
        cursor: pointer;
        height: $height;
        img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin: auto 8px auto 0;
        }
        &.open {
            & .select_title {
                pointer-events: none;
                //border-radius: 10px 10px 0 0;
                position: absolute;
                top: 0;
                left: 0;
                @media (min-width: 991.98px) {
                    transform: scale(1.05);
                }
                &::after {
                    transform: rotate(-180deg);
                }
            }
            & .select_options {
                top: 100%;
                pointer-events: all;
                opacity: 1;
                visibility: visible;
                @media (min-width: 991.98px) {
                    transform: scale(1.05) translateY(2.5%);
                }
            }
        }
        &-mini {
            .select {
                &_title {
                    border-radius: 21px;
                    font-weight: 500;
                    color: #000034;
                    height: 40px;
                    padding: 0 10px;
                    &::after {
                        background-image: url("../../../assets/img/arrow-down-icon-dark.svg");
                        height: 15px;
                        width: 15px;
                    }
                    @media (max-width: 767.98px) {
                        border: 0.5px solid rgba(0, 0, 0, 0.08);
                        border-radius: 8px;
                        height: 28px;
                    }
                    @media (max-width: 479.98px) {
                        font-size: 10px;
                        line-height: 11px;
                    }
                }
                &_options {
                    border-radius: 0 0 21px 21px;
                    padding-top: calc($miniHeight / 3);
                    margin-top: calc($miniHeight / -3);
                    max-height: calc($miniHeight * 5 - $miniHeight / 3);
                    @media (max-width: 767.98px) {
                        border: 0.5px solid rgba(0, 0, 0, 0.08);
                        border-radius: 8px;
                        padding-top: calc(28px / 3);
                        margin-top: calc(28px / -3);
                        max-height: calc(28px * 5 - 28px / 3);
                    }
                }

                &_option {
                    color: #000034;
                    font-weight: 500;
                    height: $miniHeight;
                    padding: 0 10px;
                    p {
                        height: $miniHeight;
                    }
                    @media (max-width: 767.98px) {
                        height: 28px;
                    }
                    @media (max-width: 479.98px) {
                        font-size: 10px;
                        line-height: 11px;
                    }
                }
            }
            //&.open {
            //  .select {
            //    &_options {
            //    }
            //  }
            //}
        }
        &-large {
            height: 61px;
            .select {
                &_title {
                    img {
                        width: 33px;
                        height: 33px;
                    }
                }
            }
            &.open {
                .select {
                    &_options {
                        padding-top: calc($largeHeight / 3);
                        margin-top: calc($largeHeight / -3);
                        max-height: calc($largeHeight * 5 - $largeHeight / 3);
                    }
                    &_option {
                        height: $largeHeight;
                        p {
                            height: $largeHeight;
                        }
                    }
                }
            }
        }
    }
    // .select_title
    &_title {
        svg {
            width: 33px;
            height: 33px;
            border-radius: 50%;
            animation: rotate 1.5s infinite linear;
            margin: auto 8px auto 0;
        }
        cursor: pointer;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.16);
        border-radius: 10px;
        font-style: normal;
        font-weight: 400;
        font-size: 18px;
        line-height: 181.1%;
        color: #000000;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 20px;
        position: relative;
        transition: all 0.3s ease 0s, pointer-events 0s;
        z-index: 3;
        &:hover {
            border: 1px solid rgba(0, 0, 0, 0.32);
        }
        @media (max-width: 991.98px) {
            padding: 14px 20px;
            width: 100%;
        }
        &::after {
            content: "";
            background-image: url("../../../assets/img/arrow-down-icon-blue.svg");
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            width: 18px;
            height: 18px;
            transition: all 0.3s ease 0s;
            margin-left: auto;
        }
    }
    // .select_options
    &_options {
        border-radius: 0 0 10px 10px;
        overflow-y: scroll;
        overflow-x: hidden;
        pointer-events: none;
        position: absolute;
        z-index: 2;
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.16);
        width: 100%;
        opacity: 0;
        visibility: hidden;
        top: 0;
        transition: all 0.3s ease 0s, pointer-events 0s 0.3s;
        padding-top: calc($height / 3);
        margin-top: calc($height / -3);
        max-height: calc($height * 5 - $height / 3);
        &::-webkit-scrollbar {
            width: 0;
        }
    }
    // .select_option
    &_option {
        cursor: pointer;
        font-style: normal;
        font-weight: 400;
        font-size: 18px;
        line-height: 181.1%;
        color: #000000;
        display: flex;
        flex-direction: column;
        padding: 0 20px;
        height: 48px;
        & p {
            height: 48px;
            display: inline-flex;
            justify-content: flex-start;
            align-items: center;
            line-height: 25.76px;
        }
        &:not(:last-child) {
            &::after {
                content: "";
                width: 100%;
                height: 1px;
                background: rgba(0, 0, 0, 0.09);
            }
        }
        transition: all 0.3s ease 0s;
        &:hover,
        &:active {
            color: #fff !important;
            background: #3f7bdd;
        }
    }
}
.connecting__select {
    &-priority {
        .select {
            &_title {
                z-index: 5;
            }
            &_options {
                z-index: 4;
            }
        }
    }
}
.workers__select,
.accruals__select,
.history__filter_select {
    .select_title,
    .select_option {
        font-weight: 500;
        font-size: 18px;
        color: #000034;
        @media (max-width: 479.98px) {
            font-size: 12px;
            line-height: 17px;
            padding: 5px 10px;
            white-space: nowrap;
            height: 28px;
        }
    }
    @media (max-width: 479.98px) {
        .select_title,
        .select_options {
            border: 0.5px solid rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            &::after {
                width: 24px;
                height: 24px;
                background-image: url("../../../assets/img/arrow-down-icon-black.svg");
            }
        }
    }
}
@keyframes rotate {
    0% {
        transform: rotate(0);
    }
    100% {
        transform: rotate(-360deg);
    }
}
</style>
