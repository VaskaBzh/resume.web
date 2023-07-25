<template>
    <div ref="select" class="select_con" :class="{ open: select_is_open }">
        <div @click="this.openSelect" class="select_title main_select">
            <img :src="this.baseImg" v-if="this.options[0].img" />
            <svg
                v-if="selectType === 'large'"
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
                v-for="(option, i) in this.options"
                :key="option.value"
                class="select_option"
            >
                <p
                    v-if="this.options[0].img"
                    class="main_select"
                    @click="
                        selectOptions(option.title, option.img, option.value)
                    "
                >
                    <!--                    <img :src="this.optionsImgs[i]" />-->
                    {{ option.title }}
                </p>
                <p
                    v-else
                    class="main_select"
                    @click="selectOptions(option.title, '', option.value)"
                >
                    {{ option.title }}
                </p>
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
            height: 0,
        };
    },
    computed: {
        optionsImgs() {
            let obj = [];
            for (let i = 0; i < this.options.length; i++) {
                obj.push(
                    new URL(
                        `/resources/assets/img/${this.options[i].img}`,
                        import.meta.url
                    )
                );
            }
            return obj;
        },
    },
    methods: {
        selectOptions(optionTitle, optionImg, optionValue) {
            this.baseOption = optionTitle;
            this.baseImg = new URL(
                `/resources/assets/img/${optionImg}`,
                import.meta.url
            );
            this.$emit("getCoin", optionValue);
        },
        hideSelect() {
            if (this.select_is_open === true) {
                this.select_is_open = false;
                this.$refs.select
                    .querySelector(".select_options")
                    .removeAttribute("style");
                this.$refs.select
                    .querySelector(".select_title")
                    .removeAttribute("style");
                setTimeout(() => {
                    this.handleScroll();
                }, 150);
                if (document.querySelector(".select_con.mini.autoheight")) {
                    this.$refs.select.removeAttribute("style");
                    document
                        .querySelector(".select_title")
                        .removeAttribute("style");
                    document
                        .querySelector(".select_options")
                        .removeAttribute("style");
                }
            }
        },
        openSelect() {
            this.select_is_open = true;
            this.$refs.select.querySelector(
                ".select_options"
            ).style.zIndex = 10;
            this.$refs.select.querySelector(".select_title").style.zIndex = 11;
            this.locker(true);
        },
        handleScroll() {
            setTimeout(() => {
                if (
                    this.$refs.select.getBoundingClientRect().bottom >
                        window.innerHeight - this.height &&
                    this.select_is_open === false
                ) {
                    this.$refs.select
                        .querySelector(".select_options")
                        .classList.add("select_options-reverse");
                } else if (this.select_is_open === false) {
                    this.$refs.select
                        .querySelector(".select_options")
                        .classList.remove("select_options-reverse");
                }
            }, 150);
            setTimeout(() => {
                this.locker(false);
            }, 300);
        },
        locker(bool) {
            if (bool === true) {
                document.querySelector("body").classList.add("lock-select");
            } else {
                document.querySelector("body").classList.remove("lock-select");
            }
        },
        initBase() {
            this.baseOption = this.options[0].title;
            if (this.options[0].img) {
                this.baseImg = new URL(
                    `/resources/assets/img/${this.options[0].img}`,
                    import.meta.url
                );
            }
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
        this.initBase();
        this.handleScroll();
        document.addEventListener("wheel", this.handleScroll);
    },
    unmounted() {
        document.removeEventListener("click", this.hideSelect.bind(this));
        document.removeEventListener("keydown", (e) => {
            if (e.keyCode === 27) {
                this.hideSelect();
            }
        });
        document.removeEventListener("wheel", this.handleScroll);
    },
};
</script>
<style lang="scss" scoped>
$miniHeight: 40px;
$largeHeight: 61px;
$height: 48px;
$adaptMiniHeight: 38px;
$adaptLargeHeight: 61px;
$adaptHeight: 34px;

@keyframes rotate {
    0% {
        transform: rotate(0);
    }
    100% {
        transform: rotate(-360deg);
    }
}
@keyframes arrowOpen {
    0% {
        transform: rotate(0);
    }
    50% {
        transform: rotate(30deg);
    }
    100% {
        transform: rotate(-180deg);
    }
}
@keyframes arrowClose {
    0% {
        transform: rotate(-180deg);
    }
    100% {
        transform: rotate(0);
    }
}

.lock-select {
    .select {
        &_title,
        &_options {
            transition-delay: 0s;
        }
    }
}

.select {
    // .select_con
    &_con {
        position: relative;
        max-width: 320px;
        width: 100%;
        cursor: pointer;
        height: 48px;
        transition: all 0.3s ease 0s;
        @media (max-width: 991.98px) {
            max-width: 100%;
        }
        @media (max-width: 767.98px) {
            height: $adaptHeight;
        }
        img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin: auto 8px auto 0;
        }
        &.open {
            & .select {
                &_title {
                    pointer-events: none;
                    position: absolute;
                    top: 0;
                    left: 0;
                    border: 1px solid #4182ec;
                    @media (min-width: 991.98px) {
                        transform: scale(1.05);
                    }
                    &::after {
                        animation: arrowOpen 0.8s ease forwards 0s;
                        //transform: rotate(-180deg);
                    }
                }
                &_options {
                    pointer-events: all;
                    opacity: 1;
                    visibility: visible;
                    transform: translateY(0);
                    padding-top: calc($height / 3);
                    margin-top: calc($height / -4);
                    max-height: calc($height * 5 + $height / 3 + 10px);
                    @media (max-width: 479.98px) {
                        padding-top: calc($adaptHeight / 3);
                        margin-top: calc($adaptHeight / -4);
                        max-height: calc(
                            $adaptHeight * 5 + $adaptHeight / 3 + 10px
                        );
                    }
                    &-reverse {
                        padding-top: 0 !important;
                        margin-top: 0 !important;
                        padding-bottom: calc($height / 3) !important;
                        margin-bottom: calc($height / -4) !important;
                        bottom: 100% !important;
                        top: auto !important;
                        @media (max-width: 479.98px) {
                            bottom: 100% !important;
                            top: auto !important;
                            padding-top: 0 !important;
                            margin-top: 0 !important;
                            padding-bottom: calc($adaptHeight / 3) !important;
                            margin-bottom: calc($adaptHeight / -4) !important;
                        }
                    }
                    &_option {
                        height: $height !important;
                        p {
                            height: $height !important;
                        }
                        @media (max-width: 479.98px) {
                            height: $adaptHeight !important;
                            p {
                                height: $adaptHeight !important;
                            }
                        }
                    }
                    @media (min-width: 991.98px) {
                        transform: scale(1.05) translateY(0);
                    }
                }
            }
        }
        &.mini {
            .select_option {
                height: $miniHeight !important;
                p {
                    height: $miniHeight !important;
                }
                @media (max-width: 479.98px) {
                    height: $adaptMiniHeight !important;
                    p {
                        height: $adaptMiniHeight !important;
                    }
                }
            }
            &.open {
                .select {
                    &_options {
                        padding-top: calc($miniHeight / 3);
                        margin-top: calc($miniHeight / -4);
                        max-height: calc(
                            $miniHeight * 5 + $miniHeight / 3 + 10px
                        );
                        @media (max-width: 479.98px) {
                            padding-top: calc($adaptMiniHeight / 3);
                            margin-top: calc($adaptMiniHeight / -4);
                            max-height: calc(
                                $adaptMiniHeight * 5 + $adaptMiniHeight / 3 +
                                    10px
                            );
                        }
                        &-reverse {
                            padding-top: 0 !important;
                            margin-top: 0 !important;
                            padding-bottom: calc($miniHeight / 3) !important;
                            margin-bottom: calc($miniHeight / -4) !important;
                            bottom: 100% !important;
                            top: auto !important;
                            @media (max-width: 479.98px) {
                                bottom: 100% !important;
                                top: auto !important;
                                padding-top: 0 !important;
                                margin-top: 0 !important;
                                padding-bottom: calc(
                                    $adaptMiniHeight / 3
                                ) !important;
                                margin-bottom: calc(
                                    $adaptMiniHeight / -4
                                ) !important;
                            }
                        }
                    }
                }
            }
        }
        &.large {
            height: $largeHeight;
            .select {
                &_title {
                    @media (max-width: 479.98px) {
                        height: $adaptLargeHeight;
                    }
                    img {
                        width: 33px;
                        height: 33px;
                    }
                }
                &_option {
                    height: $largeHeight !important;
                    p {
                        height: $largeHeight !important;
                    }
                    @media (max-width: 479.98px) {
                        height: $adaptLargeHeight !important;
                        p {
                            height: $adaptLargeHeight !important;
                        }
                    }
                }
            }
            &.open {
                .select {
                    &_options {
                        padding-top: calc($largeHeight / 3);
                        margin-top: calc($largeHeight / -4);
                        max-height: calc(
                            $largeHeight * 5 + $largeHeight / 3 + 10px
                        );
                        @media (max-width: 479.98px) {
                            padding-top: calc($adaptLargeHeight / 3);
                            margin-top: calc($adaptLargeHeight / -4);
                            max-height: calc(
                                $adaptLargeHeight * 5 + $adaptLargeHeight / 3 +
                                    10px
                            );
                        }
                        &-reverse {
                            padding-top: 0 !important;
                            margin-top: 0 !important;
                            padding-bottom: calc($largeHeight / 3) !important;
                            margin-bottom: calc($largeHeight / -4) !important;
                            bottom: 100% !important;
                            top: auto !important;
                            @media (max-width: 479.98px) {
                                bottom: 100% !important;
                                top: auto !important;
                                padding-top: 0 !important;
                                margin-top: 0 !important;
                                padding-bottom: calc(
                                    $adaptLargeHeight / 3
                                ) !important;
                                margin-bottom: calc(
                                    $adaptLargeHeight / -4
                                ) !important;
                            }
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
        gap: 6px;
        cursor: pointer;
        background: #ffffff;
        border: 1px solid #d6d6d6;
        border-radius: 12px;
        font-style: normal;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 20px;
        position: relative;
        transition: all 0.5s ease 0s, pointer-events 0s;
        z-index: 3;
        &:hover {
            border-color: #c2d5f2;
        }
        &:active,
        &:focus {
            border-color: #4182ec;
        }
        @media (max-width: 991.98px) {
            padding: 0 20px;
            width: 100%;
        }
        @media (max-width: 479.98px) {
            height: $adaptHeight;
            border: 0.5px solid rgba(0, 0, 0, 0.08);
        }
        &::after {
            content: "";
            background-image: url("../../../assets/img/arrow-down-icon-blue.svg");
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            width: 18px;
            height: 18px;
            transition: all 0.5s ease 0s;
            margin-left: auto;
            animation: arrowClose 0.5s ease forwards 0s;
        }
    }
    // .select_options
    &_options {
        top: 100%;
        bottom: auto;
        border-radius: 0 0 12px 12px;
        overflow-y: scroll;
        overflow-x: hidden;
        pointer-events: none;
        position: absolute;
        z-index: 2;
        background: #ffffff;
        max-height: 0;
        border: 1px solid rgba(0, 0, 0, 0.16);
        width: 100%;
        opacity: 0;
        visibility: hidden;
        transition: all 0.5s ease 0s;
        padding-top: calc($height / 3);
        margin-top: calc($height / -2);
        transform: translateY(calc($height / -3));
        &-reverse {
            top: auto;
            bottom: 100%;
            border-radius: 12px 12px 0 0;
            transform: translateY(calc($height / 3));
        }
        &::-webkit-scrollbar {
            width: 0;
        }
    }
    // .select_option
    &_option {
        cursor: pointer;
        font-style: normal;
        display: flex;
        flex-direction: column;
        padding: 0 20px;
        height: $height;
        @media (max-width: 479.98px) {
            height: $adaptHeight;
        }
        & p {
            height: $height;
            display: inline-flex;
            justify-content: flex-start;
            align-items: center;
            transition: all 0.3s ease 0s;
            @media (max-width: 479.98px) {
                height: $adaptHeight;
            }
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
            background: #3f7bdd;
            p {
                color: #fff !important;
            }
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
        @media (max-width: 479.98px) {
            padding: 0 10px;
            white-space: nowrap;
        }
    }
    @media (max-width: 479.98px) {
        .select_title,
        .select_options {
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
