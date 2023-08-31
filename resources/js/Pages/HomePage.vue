<template>
    <Head title="Главная Allbtc" />
    <div class="home">
        <div class="home__container">
            <div class="home__main page__main section">
                <div class="home__content page__content">
                    <main-title
                        tag="h1"
                        class="home__title page__title title-blue"
                        v-scroll="'left delay--md'"
                    >
                        {{ $t("home.title") }}
                    </main-title>
                    <!--                    <ul-->
                    <!--                        class="description description-list"-->
                    <!--                        v-if="viewportWidth > 479.98"-->
                    <!--                        v-scroll="'left'"-->
                    <!--                    >-->
                    <!--                        <li>-->
                    <!--                            {{ $t("home.text[0]") }}-->
                    <!--                        </li>-->
                    <!--                        <li>-->
                    <!--                            {{ $t("home.text[1]") }}-->
                    <!--                        </li>-->
                    <!--                        <li>-->
                    <!--                            {{ $t("home.text[2]") }}-->
                    <!--                        </li>-->
                    <!--                    </ul>-->
                    <!--                    <div class="description" v-else v-scroll="'left'">-->
                    <!--                        {{ $t("home.text[0]") }}{{ $t("home.text[1]")-->
                    <!--                        }}{{ $t("home.text[2]") }}-->
                    <!--                    </div>-->
                    <blue-button
                        class="button-lg button-with-propeller"
                        v-if="this.auth_user"
                        v-scroll="'left'"
                    >
                        <Link href="/profile/accounts" class="all-link">
                            {{ $t("home.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                    <blue-button
                        class="button-lg button-with-propeller"
                        v-else
                        v-scroll="'left'"
                    >
                        <Link href="/registration" class="all-link">
                            {{ $t("home.button") }}
                            <div class="button_propeller"></div
                        ></Link>
                    </blue-button>
                </div>

                <div v-if="viewportWidth >= 991.98" class="home__background">
                    <img
                        v-if="!getTheme"
                        class="home__background_image home__background_1"
                        src="../../assets/img/main_an_img_1.svg"
                        alt=""
                    />
                    <img
                        v-else
                        class="home__background_image home__background_1"
                        src="../../assets/img/main_an_img_1-dark.svg"
                        alt=""
                    />
                    <img
                        v-if="!getTheme"
                        class="home__background_image home__background_2"
                        src="../../assets/img/main_an_img_2.svg"
                        alt=""
                    />
                    <img
                        v-else
                        class="home__background_image home__background_2"
                        src="../../assets/img/main_an_img_2-dark.svg"
                        alt=""
                    />
                    <img
                        v-if="!getTheme"
                        class="home__background_image home__background_3"
                        src="../../assets/img/main_an_img_3.svg"
                        alt=""
                    />
                    <img
                        v-else
                        class="home__background_image home__background_3"
                        src="../../assets/img/main_an_img_3-dark.svg"
                        alt=""
                    />
                    <img
                        v-if="!getTheme"
                        class="home__background_image home__background_4"
                        src="../../assets/img/main_an_img_4.svg"
                        alt=""
                    />
                    <img
                        v-else
                        class="home__background_image home__background_4"
                        src="../../assets/img/main_an_img_4-dark.svg"
                        alt=""
                    />
                    <img
                        v-if="!getTheme"
                        class="home__background_image home__background_5"
                        src="../../assets/img/main_an_img_5.svg"
                        alt=""
                    />
                    <img
                        v-else
                        class="home__background_image home__background_5"
                        src="../../assets/img/main_an_img_5-dark.svg"
                        alt=""
                    />
                </div>
                <div v-else class="home__background">
                    <img
                        v-if="!getTheme"
                        class="home__background_image"
                        src="../../assets/img/main_an_img_full.webp"
                        alt=""
                    />
                    <img
                        v-else
                        class="home__background_image"
                        src="../../assets/img/main_an_img_full-dark.webp"
                        alt=""
                    />
                </div>
            </div>
            <div class="home__info section">
                <div class="home__info_main home-im">
                    <div
                        class="home-im__main section__block section__block-light"
                        v-scroll="'left'"
                    >
                        <blue-button
                            class="big"
                            v-if="viewportWidth < 991.98 && this.auth_user"
                        >
                            <Link href="/profile/accounts" class="all-link">
                                {{ $t("home.button") }}</Link
                            >
                        </blue-button>
                        <blue-button
                            class="big"
                            v-else-if="viewportWidth < 991.98"
                        >
                            <a href="#" data-popup="#auth" class="all-link">
                                {{ $t("home.button") }}</a
                            >
                        </blue-button>
                        <!--                        class="home-im__image"-->
                        <div class="home-im__image" ref="image">
                            <line-graph-statistic
                                v-if="Object.values(btcHistory).length > 0"
                                :graphData="graph"
                                :height="height"
                                :viewportWidth="viewportWidth"
                                lineColor="#FDC433"
                                :lineWidth="7"
                                bandColor="rgba(230, 234, 240, 1)"
                                mouseLineColor="#FFE5A1"
                                circleColor="#FDC433"
                                circleBorder="#FCF5E2"
                                graphType="complexity"
                            ></line-graph-statistic>
                        </div>
                        <div class="home-im__content">
                            <p class="home-im__title">Bitcoin</p>
                            <ul class="home-im__content_list">
                                <li class="home-im__content_item">
                                    <p class="text">
                                        {{ $t("home.bitcoin_block.network") }}
                                    </p>
                                    <div class="subtitle subtitle-value">
                                        <span
                                            v-value-scroll
                                            v-if="this.btcInfo.btc"
                                            >{{
                                                this.btcInfo.btc.network.toFixed(
                                                    2
                                                )
                                            }}
                                            {{
                                                this.btcInfo.btc.networkUnit
                                            }}H/s</span
                                        >
                                        <span v-else> ...</span>
                                        <span></span>
                                    </div>
                                </li>
                                <li class="home-im__content_item">
                                    <p class="text">
                                        {{ $t("home.bitcoin_block.next_diff") }}
                                    </p>
                                    <div class="subtitle subtitle-value">
                                        <span
                                            v-value-scroll
                                            v-if="this.btcInfo.btc"
                                            >{{
                                                this.btcInfo.btc.nextDiff.toLocaleString(
                                                    "en-US"
                                                )
                                            }}</span
                                        >
                                        <span v-else>...</span>
                                        <span v-if="this.btcInfo.btc"
                                            >{{ this.btcInfo.btc.diff_change }}
                                            /
                                            {{
                                                (
                                                    (Number(
                                                        this.btcInfo.btc
                                                            .nextDiff
                                                    ) -
                                                        Number(
                                                            this.btcInfo.btc
                                                                .diff
                                                        )) /
                                                    1000000000000
                                                ).toFixed(2)
                                            }}
                                            T</span
                                        >
                                        <span v-else>... / ...</span>
                                    </div>
                                </li>
                                <li class="home-im__content_item">
                                    <p class="text">
                                        {{
                                            $t(
                                                "home.bitcoin_block.date_diff[0]"
                                            )
                                        }}
                                    </p>
                                    <div
                                        class="subtitle subtitle-value"
                                        v-if="this.btcInfo.btc"
                                    >
                                        <span v-if="days !== 0"
                                            >{{ days }}
                                            {{
                                                days === 1
                                                    ? $t(
                                                          "home.bitcoin_block.date_diff[1]"
                                                      )
                                                    : days > 1 && days <= 4
                                                    ? $t(
                                                          "home.bitcoin_block.date_diff[2]"
                                                      )
                                                    : $t(
                                                          "home.bitcoin_block.date_diff[3]"
                                                      )
                                            }}</span
                                        >
                                        <span v-if="hours !== 0"
                                            >{{ hours }}
                                            {{
                                                hours === 1
                                                    ? $t(
                                                          "home.bitcoin_block.date_diff[4]"
                                                      )
                                                    : hours > 1 && hours <= 4
                                                    ? $t(
                                                          "home.bitcoin_block.date_diff[5]"
                                                      )
                                                    : $t(
                                                          "home.bitcoin_block.date_diff[6]"
                                                      )
                                            }}</span
                                        >
                                    </div>
                                    <div class="subtitle subtitle-value" v-else>
                                        ...
                                        {{
                                            $t(
                                                "home.bitcoin_block.date_diff[1]"
                                            )
                                        }}
                                        ...
                                        {{
                                            $t(
                                                "home.bitcoin_block.date_diff[2]"
                                            )
                                        }}
                                    </div>
                                </li>
                            </ul>
                            <blue-button
                                class="big"
                                v-if="viewportWidth >= 991.98 && this.auth_user"
                            >
                                <Link
                                    href="/profile/accounts"
                                    class="all-link"
                                >
                                    {{ $t("home.bitcoin_block.button") }}</Link
                                >
                            </blue-button>
                            <blue-button
                                class="big"
                                v-else-if="
                                    viewportWidth >= 991.98 && !this.auth_user
                                "
                            >
                                <Link
                                    href="/registration"
                                    class="all-link"
                                >
                                    {{ $t("home.bitcoin_block.button") }}</Link
                                >
                            </blue-button>
                        </div>
                    </div>
                    <div class="home-in__row">
                        <div
                            class="home-in__row_item home-inri section__block section__block-light"
                            v-scroll="'left important--delay'"
                        >
                            <div class="home-inri__image mon">
                                <img
                                    src="../../assets/img/home_img-earn.webp"
                                    alt="mon"
                                />
                            </div>
                            <div class="home-inri__content">
                                <main-title tag="h4">
                                    {{ $t("home.promo_blocks.payment.title") }}
                                </main-title>
                                <div class="text">
                                    {{ $t("home.promo_blocks.payment.text") }}
                                </div>
                                <Link
                                    href="/profile/accounts"
                                    v-if="this.auth_user"
                                    class="link link-blue"
                                    >{{ $t("home.promo_blocks.payment.link") }}
                                </Link>
                                <Link
                                    href="/registration"
                                    v-else
                                    class="link link-blue"
                                    >{{ $t("home.promo_blocks.payment.link") }}
                                </Link>
                            </div>
                        </div>
                        <div
                            class="home-in__row_item home-inri section__block section__block-light"
                            v-scroll="'left important--delay--md'"
                        >
                            <div class="home-inri__image asic">
                                <img
                                    src="../../assets/img/home_img-asic.webp"
                                    alt="asic"
                                />
                            </div>
                            <div class="home-inri__content">
                                <main-title tag="h4">
                                    {{ $t("home.promo_blocks.fpps.title") }}
                                </main-title>
                                <div class="text">
                                    {{ $t("home.promo_blocks.fpps.text") }}
                                </div>
                                <Link
                                    href="/faq"
                                    class="link link-blue"
                                    >{{ $t("home.promo_blocks.fpps.link") }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <calculator-view />
    <info-view class="info-home">
        <template v-slot:pc>
            <info-card
                class="sm"
                v-for="(card, i) in cards"
                :key="i"
                :card="card"
            ></info-card>
        </template>
        <template v-slot:mobile>
            <swiper-slide :key="i" v-for="(card, i) in cards">
                <info-card class="sm" :key="i" :card="card"></info-card>
            </swiper-slide>
        </template>
    </info-view>
    <about-panel-view />
    <mining-info-view :auth_user="this.auth_user" />
</template>
<script>
import { Head, Link } from "@inertiajs/vue3";
import MainTitle from "@/Components/UI/MainTitle.vue";
import BlueButton from "@/Components/UI/BlueButton.vue";
import InfoView from "@/Components/technical/views/InfoView.vue";
import InfoCard from "@/Components/technical/blocks/InfoCard.vue";
import AboutPanelView from "@/Components/technical/views/AboutPanelView.vue";
import MiningInfoView from "@/Components/technical/views/MiningInfoView.vue";
import { mapGetters } from "vuex";
import { SwiperSlide } from "swiper/vue";
import lineGraphStatistic from "@/Components/technical/graphs/LineGraphStatistic.vue";
import CalculatorView from "../modules/home_calculator/views/CalculatorView.vue";

export default {
    props: {
        auth_user: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        MiningInfoView,
        AboutPanelView,
        InfoView,
        InfoCard,
        BlueButton,
        MainTitle,
        lineGraphStatistic,
        Head,
        Link,
        SwiperSlide,
        CalculatorView,
    },
    data() {
        return {
            viewportWidth: 0,
            height: 404,
        };
    },
    watch: {
        viewportWidth() {
            this.height = this.getHeight;
        },
    },
    created: function () {
        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
    computed: {
        ...mapGetters(["btcInfo", "btcHistory", "getTheme"]),
        days() {
            if (this.btcInfo.btc)
                return Math.floor(
                    this.btcInfo.btc.time / (1000 * 60 * 60 * 24)
                );
            return "...";
        },
        hours() {
            if (this.btcInfo.btc)
                return Math.floor(
                    (this.btcInfo.btc.time / (1000 * 60 * 60)) % 24
                );
            return "...";
        },
        getHeight() {
            if (this.viewportWidth < 479.98) return 366;
            else if (this.viewportWidth < 767.98) return 370;
            else if (this.viewportWidth < 991.98) return 370;
            else if (this.viewportWidth < 1320.98) return 404;
            else return 366;
        },
        cards() {
            return [
                {
                    title: this.$t("platform.blocks[0].title"),
                    img: "platform-img-1.webp",
                    text: this.$t("platform.blocks[0].text"),
                },
                {
                    title: this.$t("platform.blocks[1].title"),
                    img: "platform-img-2.webp",
                    text: this.$t("platform.blocks[1].text"),
                },
                {
                    title: this.$t("platform.blocks[2].title"),
                    img: "platform-img-3.webp",
                    text: this.$t("platform.blocks[2].text"),
                },
            ];
        },
        graph() {
            let arr = {
                id: 1,
                values: [],
                dates: [],
                unit: [],
            };
            Object.values(this.btcHistory).forEach((el) => {
                arr.values.push(el["y"]);
                arr.dates.push(el["x"] * 1000);
                while (arr.unit.length < this.val) {
                    arr.unit.push("T");
                }
            });
            return arr;
        },
    },
    methods: {
        handleResize() {
            this.viewportWidth = window.innerWidth;
        },
    },
    beforeUpdate() {
        if (this.$refs.image) {
            this.$refs.image.scrollLeft = this.$refs.image.scrollWidth;
        }
    },
    mounted() {
        document.title = this.$t("header.links.home");
        this.height = this.getHeight;

        if (this.$refs.image) {
            this.$refs.image.scrollLeft = this.$refs.image.scrollWidth;
        }
    },
};
</script>

<style lang="scss" scoped>
.home {
    // .home__main
    &__main {
        display: flex;
        @media (min-width: 991.98px) {
            margin-bottom: 295px;
            margin-top: 240px;
        }
    }
    // .home__content
    &__content {
        max-width: 670px;
        @media (max-width: 991.98px) {
            max-width: unset;
        }
        @media (max-width: 479.98px) {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            .button-lg {
                margin-right: 7px;
            }
        }
    }
    // .home__title
    &__title {
        margin-bottom: 20px;
        @media (max-width: 479.98px) {
            font-size: 35px;
            line-height: 107.6%;
        }
    }
    // .home__background
    &__background {
        position: relative;
        top: -25em;
        @media (max-width: 1320.98px) {
            top: -6em;
            left: -21em;
            transform: scale(0.7);
        }
        @media (max-width: 991.98px) {
            transform: scale(1);
            width: calc(100% + 30px);
            top: unset;
            left: unset;
        }
        // .home__background_image
        &_image {
            position: absolute;
            top: 40%;
            @media (min-width: 1500.98px) {
                width: auto !important;
            }
            @media (max-width: 991.98px) {
                top: 0;
                position: relative;
                width: 100%;
                object-fit: cover;
                object-position: center;
                left: 50%;
                transform: translate(-50%, 2%);
            }
            @media (max-width: 767.98px) {
                width: 160%;
            }
        }
        // .home__background_1
        &_1 {
            max-width: 905px;
            @media (min-width: 1320.98px) {
                left: 0;
                top: 0;
                will-change: transform;
                animation-name: keyshow1;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
        }
        // .home__background_2
        &_2 {
            @media (min-width: 1320.98px) {
                top: 24em;
                right: -14em;
                will-change: transform;
                animation-name: keyshow2;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1320.98px) {
                display: none;
            }
        }
        // .home__background_3
        &_3 {
            @media (min-width: 1320.98px) {
                top: 33.8em;
                right: -24.8em;
                will-change: transform;
                animation-name: keyshow3;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1320.98px) {
                display: none;
            }
        }
        // .home__background_4
        &_4 {
            @media (min-width: 1320.98px) {
                top: 36.9em;
                right: -9.8em;
                will-change: transform;
                animation-name: keyshow4;
                animation-duration: 1.7s;
                animation-timing-function: ease;
                animation-fill-mode: forwards;
            }
            @media (max-width: 1320.98px) {
                display: none;
            }
        }
        // .home__background_5
        &_5 {
            top: 19.3em;
            right: -33.9em;
            will-change: transform;
            animation: keyshow5 1.7s ease forwards,
                imag5 12s 1.7s infinite linear;
            @media (max-width: 1320.98px) {
                display: none;
            }
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
    display: flex;
    flex-direction: column;
    gap: 30px;
    @media (max-width: 991.98px) {
        gap: 16px;
    }
    // .home-im__main
    &__main {
        display: flex;
        position: relative;
        padding: 40px;
        gap: 30px;
        justify-content: space-between;
        @media (max-width: 1320.98px) {
            gap: 36px;
            padding: 32px;
        }
        @media (max-width: 991.98px) {
            flex-direction: column-reverse;
            &::before {
                display: none;
            }
        }
        @media (max-width: 767.98px) {
            padding: 32px 32px 12px;
            gap: 25px;
        }
        @media (max-width: 479.98px) {
            padding: 24px 24px 12px;
            gap: 32px;
        }
        .subtitle-value {
            display: inline-flex;
            gap: 6px;
            & span {
                &:last-child {
                    color: #e9c058;
                }
            }
            &_text {
                color: #000034 !important;
            }
        }
        .blue-button {
            min-width: 222px;
            margin-bottom: 0;
            @media (max-width: 991.98px) {
                display: none;
            }
        }
        &::before {
            content: "";
            background-image: url("../../assets/img/bitcoin.webp");
            position: absolute;
            width: 500px;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            height: 390px;
            top: -15em;
            left: 7em;
            animation-name: plane-soaring;
            animation-duration: 5s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
            @media (max-width: 1320.98px) {
                height: 350px;
                width: 300px;
                top: -13.3em;
            }
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
        min-width: 65%;
        object-fit: contain;
        display: flex;
        gap: 15px;
        @media (max-width: 1320.98px) {
            min-width: 55%;
        }
        @media (max-width: 991.98px) {
            object-fit: cover;
        }
        @media (max-width: 767.98px) {
            min-width: 100%;
            overflow-x: scroll;
            overflow-y: visible;
            padding-right: 24px;
            margin: 0 0 0 24px;
            .container-chart {
                padding-bottom: 40px;
            }
        }
    }
    // .home-im__content
    &__content {
        display: flex;
        flex-direction: column;
        flex: 0 1 100%;
        .blue-button {
            min-width: 222px;
            margin-bottom: 0;
            margin-top: 32px;
            @media (max-width: 1320.98px) {
                margin-top: 8px;
            }
            @media (max-width: 767.98px) {
                display: none;
            }
        }
        // .home-im__content_list
        &_list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            @media (max-width: 1320.98px) {
                gap: 8px;
            }
            @media (max-width: 767.98px) {
                gap: 20px;
            }
        }
        // .home-im__content_item
        &_item {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            &:last-child {
                .subtitle-value span:last-child {
                    color: #343434;
                }
            }
        }
        // .home-im__content_date
        &_date {
            flex: 1 1 auto;
        }
    }
    // .home-im__title
    &__title {
        font-family: AmpleSoftPro, serif;
        font-style: normal;
        font-weight: 500;
        font-size: 64.4231px;
        line-height: 107.6%;
        color: #e9c058;
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 39px;
        @media (max-width: 1320.98px) {
            margin-bottom: 8px;
        }
        @media (max-width: 767.98px) {
            margin-bottom: 24px;
        }
        @media (max-width: 479.98px) {
            margin-bottom: 40px;
        }
        &::before {
            content: "";
            width: 51px;
            height: 51px;
            background-image: url("../../assets/img/orange-propeller-icon.svg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            @media (max-width: 479.98px) {
                width: 40px;
                height: 40px;
            }
        }
        span {
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
        }
        @media (max-width: 479.98px) {
            gap: 16px;
        }
    }
}
.home-in {
    // .home-in__row
    &__row {
        display: flex;
        gap: 30px;
        bottom: 100px;
        @media (max-width: 991.98px) {
            flex-direction: column;
            gap: 16px;
        }
        // .home-in__row_item
        &_item {
            //transition: all 0.3s ease 0s;
            padding: 0;
            //@media (any-hover: hover) {
            //    &:hover {
            //        background: #3f65b3;
            //        & .home-inri__title {
            //            color: #ffffff;
            //        }
            //        & .text {
            //            color: rgba(255, 255, 255, 0.68);
            //        }
            //        & .home-inri__link {
            //            color: #ffffff;
            //            & svg path {
            //                stroke: #fff;
            //            }
            //        }
            //    }
            //}
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
        padding: 32px 24px;
    }
    // .home-inri__image
    &__image {
        position: relative;
        width: 30%;
        height: 100%;
        margin: auto 5px;
        @media (max-width: 1320.98px) {
            width: 56%;
        }
        @media (max-width: 991.98px) {
            max-width: 25%;
            min-width: 25%;
            width: auto;
        }
        @media (max-width: 767.98px) {
            max-width: 30%;
            min-width: 30%;
        }
        @media (max-width: 479.98px) {
            display: none !important;
        }
        &.mon {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        &.asic {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            img {
                margin: -70px -70px 0 0;
            }
        }
    }
    // .home-inri__content
    &__content {
        padding: 43px 26px 43px 16px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        max-width: 400px;
        @media (max-width: 1320px) {
            max-width: 300px;
        }
        @media (max-width: 991.98px) {
            max-width: 100%;
        }
        @media (max-width: 767.98px) {
            flex: 0 0 70%;
            padding: 48px 16px 48px 8px;
        }
        @media (max-width: 479.98px) {
            flex: 1 0 100%;
            padding: 0;
        }
        .text {
            min-height: 68px;
            transition: all 0.5s ease 0s;
            @media (max-width: 767.98px) {
                min-height: 70px;
            }
            @media (max-width: 479.98px) {
                min-height: 56px;
            }
        }
    }
}
.all-link {
    position: relative;
    z-index: 5;
}
.info-home {
}
</style>
