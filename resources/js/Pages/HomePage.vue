<template>
    <Head title="Главная Allbtc" />
    <div class="home">
        <div class="home__container">
            <div class="home__main">
                <div class="home__content">
                    <main-title
                        tag="h1"
                        class="home__title"
                        v-scroll="'left delay--lg'"
                    >
                        Зарабатывайте на майнинге вместе с allbtc pool
                    </main-title>

                    <div class="home__span" v-scroll="'left delay--md'">
                        Высокий доход. Надежность. Эффективность.
                    </div>
                    <a href="#" class="home__button" v-scroll="'left'">
                        Начать майнинг
                        <div class="home__button_propeller"></div
                    ></a>
                </div>

                <div v-if="viewportWidth >= 991.98" class="home__background">
                    <img
                        class="home__background_image home__background_1"
                        src="../../assets/img/main_an_img_1.png"
                        alt=""
                    />
                    <img
                        class="home__background_image home__background_2"
                        src="../../assets/img/main_an_img_2.png"
                        alt=""
                    />
                    <img
                        class="home__background_image home__background_3"
                        src="../../assets/img/main_an_img_3.png"
                        alt=""
                    />
                    <img
                        class="home__background_image home__background_4"
                        src="../../assets/img/main_an_img_4.png"
                        alt=""
                    />
                    <img
                        class="home__background_image home__background_5"
                        src="../../assets/img/main_an_img_5.png"
                        alt=""
                    />
                </div>
                <div v-else class="home__background">
                    <img
                        class="home__background_image"
                        src="../../assets/img/main_an_img_full.png"
                        alt=""
                    />
                </div>
            </div>
            <div class="home__info">
                <div class="home__info_main home-im bagr-t">
                    <div class="home-im__main" v-scroll="'left'">
                        <blue-button v-if="viewportWidth < 991.98">
                            <a href="#" class="all-link">Начать майнинг</a>
                        </blue-button>
                        <img
                            src="../../assets/img/graph.png"
                            alt=""
                            class="home-im__image"
                        />
                        <div class="home-im__content">
                            <h2 class="home-im__title">Bitcoin</h2>
                            <ul class="home-im__content_list">
                                <li class="home-im__content_item">
                                    <p class="item_span">Сложность сети</p>
                                    <div class="item_info bgb">
                                        32,136,448,326,378<span>+32.05 T</span>
                                    </div>
                                </li>
                                <li class="home-im__content_item">
                                    <p class="item_span">
                                        Ожидаемая следующая сложность
                                    </p>
                                    <div class="item_info bgb">
                                        32,136,448,326,378<span
                                            >+0.28% / 32.14 T</span
                                        >
                                    </div>
                                </li>
                            </ul>

                            <div class="home-im__content_date">
                                <p class="item_span">
                                    Дата следующей сложности
                                </p>
                                <div class="item_info">8 Дней 7 Часов</div>
                            </div>
                            <blue-button v-if="viewportWidth >= 991.98">
                                <a href="#" class="all-link">Начать майнинг</a>
                            </blue-button>
                        </div>
                    </div>
                    <div class="home-in__row">
                        <div
                            class="home-in__row_item home-inri"
                            v-scroll="'left important--delay'"
                        >
                            <div class="home-inri__image mon"></div>
                            <div class="home-inri__content">
                                <h4 class="home-inri__title">
                                    Ежедневные выплаты
                                </h4>
                                <div class="home-inri__text">
                                    Без минимальной суммы за исключением ETH и
                                    ETC
                                </div>
                                <a href="#" class="home-inri__link"
                                    >Начать получать выплаты<svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 14 14"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M4.83882 3.08785C5.06663 2.86004 5.43598 2.86004 5.66378 3.08785L9.16378 6.58785C9.39159 6.81565 9.39159 7.185 9.16378 7.4128L5.66378 10.9128C5.43598 11.1406 5.06663 11.1406 4.83882 10.9128C4.61102 10.685 4.61102 10.3157 4.83882 10.0878L7.92634 7.00033L4.83882 3.9128C4.61102 3.685 4.61102 3.31565 4.83882 3.08785Z"
                                            fill="white"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div
                            class="home-in__row_item home-inri asic__con"
                            v-scroll="'left important--delay--md'"
                        >
                            <div class="home-inri__image asic"></div>
                            <div class="home-inri__content">
                                <h4 class="home-inri__title">FPPS</h4>
                                <div class="home-inri__text">
                                    Метод вознаграждения за майнинг с наивысшей
                                    доходностью
                                </div>
                                <a href="#" class="home-inri__link"
                                    >Подробнее<svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 14 14"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M4.83882 3.08785C5.06663 2.86004 5.43598 2.86004 5.66378 3.08785L9.16378 6.58785C9.39159 6.81565 9.39159 7.185 9.16378 7.4128L5.66378 10.9128C5.43598 11.1406 5.06663 11.1406 4.83882 10.9128C4.61102 10.685 4.61102 10.3157 4.83882 10.0878L7.92634 7.00033L4.83882 3.9128C4.61102 3.685 4.61102 3.31565 4.83882 3.08785Z"
                                            fill="white"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <calculator-view />
    <pull-static-view />
    <collective-platform-view />
    <about-panel-view />
    <mining-info-view />
</template>
<script>
import { Head } from "@inertiajs/vue3";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import CalculatorView from "@/Components/technical/CalculatorView.vue";
import PullStaticView from "@/Components/technical/PullStaticView.vue";
import CollectivePlatformView from "@/Components/technical/CollectivePlatformView.vue";
import AboutPanelView from "@/Components/technical/AboutPanelView.vue";
import MiningInfoView from "@/Components/technical/MiningInfoView.vue";

export default {
    components: {
        MiningInfoView,
        AboutPanelView,
        CollectivePlatformView,
        PullStaticView,
        CalculatorView,
        BlueButton,
        MainTitle,
        Head,
    },
    data() {
        return {
            viewportWidth: 0,
        };
    },
    created() {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
};
</script>

<style lang="scss" scoped>
.bagr-t {
    @media (max-width: 479.98px) {
        margin: 0 -15px;
    }
}
.home {
    margin-bottom: 100px;
    @media (max-width: 1270px) {
        margin-bottom: 40px;
    }
    @media (max-width: 767.98px) {
        margin-bottom: 30px;
    }
    @media (max-width: 479.98px) {
        margin-bottom: 16px;
    }

    // .home__main
    &__main {
        display: flex;
        margin-bottom: 25.7em;
        @media (max-width: 1270px) {
            margin-bottom: 15em;
        }
        @media (max-width: 991.98px) {
            flex-direction: column;
            margin-bottom: -40px;
        }
    }
    // .home__content
    &__content {
        max-width: 670px;
        margin-top: 160px;
        @media (max-width: 991.98px) {
            margin-top: 48px;
            text-align: center;
            max-width: unset;
        }
        @media (max-width: 767.98px) {
            margin-top: 24px;
        }
    }
    // .home__title
    &__title {
        margin-bottom: 20px;
        @media (max-width: 1270px) {
            margin-bottom: 16px;
        }
        @media (max-width: 479.98px) {
            font-size: 35px;
            line-height: 107.6%;
        }
    }
    // .home__span
    &__span {
        font-style: normal;
        font-weight: 300;
        font-size: 21px;
        line-height: 143.1%;
        color: #000000;
        margin-bottom: 36px;
        @media (max-width: 1270px) {
            margin-bottom: 28px;
        }
    }
    // .home__button
    &__button {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 36px;
        width: 347px;
        height: 85px;
        align-items: center;
        font-style: normal;
        font-weight: 500;
        font-size: 22px;
        line-height: 107.6%;
        color: #ffffff;
        background: linear-gradient(84.14deg, #3f7bdd 8.75%, #4282ec 92.01%);

        border-radius: 10px;
        position: relative;
        z-index: 5;
        transition: all 0.3s ease 0s;
        @media (any-hover: hover) {
            &:hover {
                box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
                transform: translate(10px, 10px);
                &::before {
                    top: 0;
                    left: 0;
                }
            }
        }
        @media (max-width: 1270px) {
            height: 74px;
            width: 266px;
            gap: 26px;
            font-size: 20px;
            line-height: 22px;
        }
        @media (max-width: 991.98px) {
            margin: 0 auto;
        }
        @media (max-width: 767.98px) {
            height: 74px;
            width: 266px;
            gap: 32px;
            font-size: 16px;
            line-height: 107%;
        }
        @media (max-width: 479.98px) {
            height: 65px;
        }
        &::before {
            content: "";
            position: absolute;
            z-index: -1;
            background: linear-gradient(
                84.14deg,
                rgba(63, 123, 221, 0.27) 8.75%,
                rgba(66, 130, 236, 0.27) 92.01%
            );
            border-radius: 10px;
            width: 100%;
            height: 100%;
            top: 10px;
            left: 10px;
            transition: all 0.3s ease 0s;
        }
        // .home__button_propeller
        &_propeller {
            width: 51px;
            height: 51px;
            background: #366dc8;
            box-shadow: 0px 0px 35px rgba(255, 255, 255, 0.04),
                inset 0px 11px 6px rgba(0, 0, 0, 0.08);
            border-radius: 50%;
            position: relative;
            &::before {
                content: "";
                position: absolute;
                width: 36px;
                height: 36px;
                background-size: cover;
                background: url("../../assets/img/propeller.svg") no-repeat center;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                animation-name: ventilation;
                animation-duration: 1.5s;
                animation-iteration-count: infinite;
                animation-timing-function: linear;
            }
            @keyframes ventilation {
                0% {
                    transform: translate(-50%, -50%) rotate(0deg);
                }
                100% {
                    transform: translate(-50%, -50%) rotate(-720deg);
                }
            }
            @media (max-width: 1270px) {
                width: 45px;
                height: 45px;
                &::before {
                    width: 30px;
                    height: 30px;
                }
            }
            @media (max-width: 767.98px) {
                width: 39px;
                height: 39px;
                &::before {
                    width: 26px;
                    height: 26px;
                }
            }
        }
    }
    // .home__background
    &__background {
        position: relative;
        top: -3em;
        @media (max-width: 1270px) {
            top: -7em;
            left: -5em;
            transform: scale(0.7);
        }
        @media (max-width: 991.98px) {
            transform: scale(1);
            top: unset;
            left: unset;
        }
        // .home__background_image
        &_image {
            position: absolute;
            @media (max-width: 991.98px) {
                position: relative;
                max-width: 722px;
                object-fit: cover;
                object-position: center;
                left: 50%;
                transform: translate(-50%, 2%);
            }
        }
        // .home__background_1
        &_1 {
            @media (min-width: 1270px) {
                left: 0;
                top: 0;
                will-change: transform;
                animation-name: keyshow1;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1270px) {
                left: 0;
                top: 0;
            }
        }
        // .home__background_2
        &_2 {
            @media (min-width: 1270px) {
                top: 31em;
                right: -15em;
                will-change: transform;
                animation-name: keyshow2;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1270px) {
                top: 30em;
                right: -15em;
            }
        }
        // .home__background_3
        &_3 {
            @media (min-width: 1270px) {
                top: 42.6em;
                right: -31.4em;
                will-change: transform;
                animation-name: keyshow3;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1270px) {
                top: 43em;
                right: -33em;
            }
        }
        // .home__background_4
        &_4 {
            @media (min-width: 1270px) {
                top: 46.6em;
                right: -12.3em;
                will-change: transform;
                animation-name: keyshow4;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1270px) {
                top: 46em;
                right: -14em;
            }
        }
        // .home__background_5
        &_5 {
            top: 25.3em;
            right: -34.9em;
            will-change: transform;
            animation: keyshow5 1.7s ease forwards,
                imag5 12s 1.7s infinite linear;
        }
        @keyframes imag5 {
            0% {
                transform: translate(0, 0);
            }
            25% {
                transform: translate(-50%, 45%);
            }
            50% {
                transform: translate(0, 0);
            }
            75% {
                transform: translate(-50%, 45%);
            }
            100% {
                transform: translate(0, 0);
            }
        }
        @keyframes keyshow1 {
            0% {
                transform: translate(40vw, 100vh);
            }
            100% {
                transform: translate(0, 0);
            }
        }
        @keyframes keyshow2 {
            0% {
                transform: translate(80em, 100em);
            }
            100% {
                transform: translate(0, 0);
            }
        }
        @keyframes keyshow3 {
            0% {
                transform: translate(90em, 100em);
            }
            100% {
                transform: translate(0, 0);
            }
        }
        @keyframes keyshow4 {
            0% {
                transform: translate(70em, 100em);
            }
            100% {
                transform: translate(0, 0);
            }
        }
        @keyframes keyshow5 {
            0% {
                transform: translate(70em, 100em);
            }
            100% {
                transform: translate(0, 0);
            }
        }
    }
}
.home-im {
    background: rgba(255, 255, 255, 0.29);
    border-radius: 21px;
    padding: 17px;
    // .home-im__main
    &__main {
        position: relative;
        background: #ffffff;
        border-radius: 21px;
        padding: 70px;
        display: flex;
        align-items: end;
        gap: 100px;
        justify-content: space-between;
        margin-bottom: 17px;
        &::before {
            content: "";
            background-image: url("../../assets/img/bitcoin.png");
            position: absolute;
            width: 500px;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            height: 530px;
            bottom: 10em;
            left: 5em;
            animation-name: plane-soaring;
            animation-duration: 5s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }
        @media (max-width: 1270px) {
            gap: 36px;
            padding: 26px 16px;
            & .home-im__image {
                max-width: 500px;
            }
            &::before {
                width: 450px;
                height: 460px;
                bottom: 7em;
                left: 1em;
            }
        }
        @media (max-width: 991.98px) {
            flex-direction: column-reverse;
            align-items: center;
            & .home-im__content {
                width: 100%;
                padding: 0 18px;
            }
            &::before {
                display: none;
            }
        }
        @media (max-width: 479.98px) {
            gap: 26px;
        }

        @keyframes plane-soaring {
            0% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(0, 15px);
            }
            100% {
                transform: translate(0px, 0px);
            }
        }
    }
    // .home-im__image
    &__image {
        max-width: 550px;
        object-fit: contain;
        @media (max-width: 991.98px) {
            max-width: unset;
            width: 100%;
            object-fit: cover;
        }
    }
    // .home-im__content
    &__content {
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex: 0 1 50%;
        @media (max-width: 1270px) {
            //flex: 1 1 auto;
        }
        // .home-im__content_list
        &_list {
            @media (max-width: 991.98px) {
                display: flex;
                flex-wrap: wrap;
                column-gap: 48px;
                justify-content: space-between;
            }
        }
        // .home-im__content_item
        &_item {
            &:not(:last-child) {
                margin-bottom: 12px;
            }
            @media (max-width: 479.98px) {
                width: 100%;
            }
        }
        // .home-im__content_date
        &_date {
            flex: 1 1 auto;
        }
    }
    // .home-im__title
    &__title {
        font-family: AmpleSoftPro;
        font-style: normal;
        font-weight: 500;
        font-size: 64.4231px;
        line-height: 107.6%;
        color: #e9c058;
        position: relative;
        display: flex;
        &::before {
            content: "";
            position: absolute;
            width: 51px;
            height: 51px;
            background-image: url("../../assets/img/orange-propeller-icon.svg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            top: 50%;
            left: -1em;
            transform: translate(0, -45%);
            @media (max-width: 991.98px) {
                position: relative;
                top: 0;
                left: -10px;
                transform: translate(0, 20%);
            }
            @media (max-width: 767.98px) {
                width: 37px;
                height: 37px;
            }
        }
        &::after {
            content: "228.17 EH/s";
            position: relative;
            font-style: normal;
            font-weight: 300;
            font-size: 18px;
            line-height: 143.1%;
            color: #000000;
            right: -14px;
        }
        @media (max-width: 991.98px) {
            padding-left: 10px;
        }
        @media (max-width: 767.98px) {
            font-size: 45px;
            line-height: 107.6%;
            &::after {
                font-size: 13px;
                line-height: 143.1%;
                right: -6px;
            }
        }
    }
}
.item {
    // .item_span
    &_span {
        font-style: normal;
        font-weight: 300;
        font-size: 16px;
        line-height: 143.1%;
        color: rgba(0, 0, 0, 0.55);
        margin-bottom: 12px;
    }
    // .item_info
    &_info {
        font-family: AmpleSoftPro;
        font-style: normal;
        font-weight: 500;
        font-size: 22px;
        line-height: 143.1%;
        color: #000034;
        display: flex;
        column-gap: 18px;
        @media (max-width: 991.98px) {
            font-size: 18px;
            line-height: 143.1%;
            @media (max-width: 479.98px) {
                width: 100% !important;
                flex-direction: column;
                align-items: center;
            }
        }
        & span {
            color: #e9c058;
        }
        &.bgb {
            position: relative;
            width: fit-content;
            &::before {
                content: "";
                position: absolute;
                background: rgba(233, 192, 88, 0.09);
                border-radius: 53px;
                width: 112%;
                height: 110%;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }
    }
}
.home-in {
    // .home-in__row
    &__row {
        display: flex;
        gap: 17px;
        bottom: 100px;
        @media (max-width: 991.98px) {
            flex-direction: column;
        }
        // .home-in__row_item
        &_item {
            background: #ffffff;
            border-radius: 21px;
            transition: all 0.3s ease 0s;
            @media (any-hover: hover) {
                &:hover {
                    background: #3f65b3;
                    & .home-inri__title {
                        color: #ffffff;
                    }
                    & .home-inri__text {
                        color: rgba(255, 255, 255, 0.68);
                    }
                    & .home-inri__link {
                        color: #ffffff;
                        & svg path {
                            stroke: #fff;
                        }
                    }
                }
            }
            @media (max-width: 767.98px) {
                background: #3f65b3;
                & .home-inri__title {
                    color: #ffffff;
                }
                & .home-inri__text {
                    color: rgba(255, 255, 255, 0.68);
                }
                & .home-inri__link {
                    color: #ffffff;
                    & svg path {
                        stroke: #fff;
                    }
                }
                &.asic__con {
                    background: #ffffff;
                    & .home-inri__title {
                        color: #000034;
                    }
                    & .home-inri__text {
                        color: rgba(0, 0, 0, 0.62);
                    }
                    & .home-inri__link {
                        color: #4181ea;
                        & svg path {
                            stroke: #4181ea;
                        }
                    }
                }
            }
        }
    }
}
.home-inri {
    display: flex;
    align-items: end;
    flex: 0 1 50%;
    @media (max-width: 991.98px) {
        flex: 1 1 auto;
    }
    @media (max-width: 479.98px) {
        flex-direction: column;
        align-items: center;
    }
    // .home-inri__image
    &__image {
        position: relative;
        width: 200px;
        height: 100%;
        @media (max-width: 479.98px) {
            height: 150px;
        }
        &.mon {
            &::before {
                content: "";
                position: absolute;
                background-image: url("../../assets/img/coins.png");
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
                width: 213px;
                height: 275px;
                bottom: 0;
                left: 0;
                @media (max-width: 1270px) {
                    width: 165px;
                    height: 280px;
                }
                @media (max-width: 479.98px) {
                    left: 50%;
                    top: -55%;
                    transform: translate(-50%, 0);
                    width: 155px;
                    height: 260px;
                }
            }
        }
        &.asic {
            &::before {
                content: "";
                position: absolute;
                background-image: url("../../assets/img/asic.png");
                background-position: center;
                background-size: contain;
                background-repeat: no-repeat;
                width: 182px;
                height: 260px;
                bottom: 0;
                left: 42px;
                @media (max-width: 1270px) {
                    bottom: 6px;
                    left: 31px;
                }
                @media (max-width: 767.98px) {
                    width: 150px;
                }
                @media (max-width: 479.98px) {
                    bottom: -20px;
                    left: 25%;
                }
            }
        }
    }
    // .home-inri__content
    &__content {
        padding: 50px 30px;
        @media (max-width: 767.98px) {
            flex: 0 0 70%;
        }
        @media (max-width: 479.98px) {
            padding: 0px 30px 36px;
        }
    }

    // .home-inri__title
    &__title {
        font-family: "AmpleSoftPro";
        font-style: normal;
        font-weight: 500;
        font-size: 31px;
        line-height: 100%;
        color: #000034;
        margin-bottom: 4px;
        transition: all 0.5s ease 0s;
        @media (max-width: 479.98px) {
            font-size: 22px;
            line-height: 100%;
            margin-bottom: 10px;
        }
    }
    // .home-inri__text
    &__text {
        font-style: normal;
        font-weight: 300;
        font-size: 16px;
        line-height: 143.1%;
        color: rgba(0, 0, 0, 0.62);
        margin-bottom: 26px;
        transition: all 0.5s ease 0s;
        @media (max-width: 479.98px) {
            margin-bottom: 16px;
        }
    }
    // .home-inri__link
    &__link {
        font-style: normal;
        font-weight: 500;
        font-size: 15px;
        line-height: 107.6%;
        color: #4181ea;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.5s ease 0s;
        width: fit-content;
        & svg {
            position: relative;
            transition: all 0.3s ease 0s;
            & path {
                stroke: #4181ea;
            }
        }
        @media (any-hover: hover) {
            &:hover {
                text-decoration: underline;
                & svg {
                    transform: translate(4px, 0);
                }
            }
        }
    }
}
.asic__con {
    @media (max-width: 479.98px) {
        flex-direction: column-reverse;
        & .home-inri__content {
            padding: 36px 30px 0px;
        }
        & .asic {
            height: 170px;
        }
    }
}
.all-link {
    position: relative;
    z-index: 5;
}
.blue-button {
    margin-bottom: 10px;
}
</style>
