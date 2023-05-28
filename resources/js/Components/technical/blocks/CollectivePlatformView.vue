<template>
    <div class="platform-c">
        <div class="platform-c__container">
            <div class="platform-c__main">
                <div class="platform-c__logo_con">
                    <img
                        class="platform-c__logo"
                        src="../../../../assets/img/logo_icon.png"
                        alt=""
                    />
                </div>
                <main-title tag="h2" class="platform-c__title">
                    {{ $t("platform.title") }}
                </main-title>
                <ul v-if="viewportWidth >= 767.98" class="platform-c__list">
                    <li class="platform-c__item">
                        <div class="platform-c__item_image_con">
                            <img
                                class="platform-c__item_image n-1"
                                src="../../../../assets/img/platform-img-1.png"
                                alt=""
                                v-scroll="'left delay'"
                            />
                        </div>
                        <div class="platform-c__item_title">
                            {{ $t("platform.blocks[0].title") }}
                        </div>
                        <div class="text">
                            {{ $t("platform.blocks[0].text") }}
                        </div>
                    </li>
                    <li class="platform-c__item">
                        <div class="platform-c__item_image_con">
                            <img
                                class="platform-c__item_image n-2"
                                src="../../../../assets/img/platform-img-2.png"
                                alt=""
                                v-scroll="'left delay--md'"
                            />
                        </div>
                        <div class="platform-c__item_title">
                            {{ $t("platform.blocks[1].title") }}
                        </div>
                        <div class="text">
                            {{ $t("platform.blocks[1].text") }}
                        </div>
                    </li>
                    <li class="platform-c__item">
                        <div class="platform-c__item_image_con">
                            <img
                                class="platform-c__item_image n-3"
                                src="../../../../assets/img/platform-img-3.png"
                                alt=""
                                v-scroll="'left delay--lg'"
                            />
                        </div>
                        <div class="platform-c__item_title">
                            {{ $t("platform.blocks[2].title") }}
                        </div>
                        <div class="text">
                            {{ $t("platform.blocks[2].text") }}
                        </div>
                    </li>
                </ul>
                <swiper
                    class="sjj"
                    v-else
                    :modules="modules"
                    :slides-per-view="1"
                    :space-between="15"
                    :pagination="pagination"
                >
                    <swiper-slide class="platform-c__item">
                        <div class="platform-c__item_image_con">
                            <img
                                class="platform-c__item_image n-1"
                                src="../../../../assets/img/platform-img-1.png"
                                alt=""
                            />
                        </div>
                        <div class="platform-c__item_title">
                            Безопасный и прозрачный
                        </div>
                        <div class="text">
                            Хешрейт отображается в режиме реального времени,
                            пока команда безопасности Allbtc защищает ваши
                            активы
                        </div>
                    </swiper-slide>
                    <swiper-slide class="platform-c__item">
                        <div class="platform-c__item_image_con">
                            <img
                                class="platform-c__item_image n-2"
                                src="../../../../assets/img/platform-img-2.png"
                                alt=""
                            />
                        </div>
                        <div class="platform-c__item_title">
                            Стабильный заработок
                        </div>
                        <div class="text">
                            Используя модель FPPS+ и мгновенные расчеты, вы
                            можете избежать колебаний заработка
                        </div>
                    </swiper-slide>
                    <swiper-slide class="platform-c__item">
                        <div class="platform-c__item_image_con">
                            <img
                                class="platform-c__item_image n-3"
                                src="../../../../assets/img/platform-img-3.png"
                                alt=""
                            />
                        </div>
                        <div class="platform-c__item_title">
                            Комплексное обслуживание
                        </div>
                        <div class="text">
                            Наше комплексное обслуживание направлено на
                            повышение доходов майнеров, сокращение разрыва между
                            добычей полезных ископаемых и трейдингом, а также
                            обеспечение универсальной экосистемы майнинга.
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>
    </div>
</template>

<script>
import { Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";

import "swiper/css";
import "swiper/css/pagination";
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
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
    components: {
        Swiper,
        SwiperSlide,
        MainTitle,
    },
    setup() {
        return {
            pagination: {
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' + "</span>";
                },
            },
            modules: [Pagination],
        };
    },
};
</script>

<style lang="scss" scoped>
.platform-c {
    // .platform-c__main
    &__main {
        margin-bottom: 48px;
    }
    // .platform-c__logo
    &__logo {
        max-width: 95px;
        margin-bottom: 18px;
        @media (max-width: 767.98px) {
            max-width: 67px;
            margin-bottom: 32px;
        }
        &_con {
            display: flex;
            justify-content: center;
        }
    }
    // .platform-c__title
    &__title {
        font-family: "AmpleSoftPro";
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 132.6%;
        text-align: center;
        color: #000034;
        margin-bottom: 36px;
        @media (max-width: 767.98px) {
            font-size: 27px;
            line-height: 107.6%;
            margin-bottom: 19px;
        }
    }
    // .platform-c__list
    &__list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 80px;
        @media (max-width: 991.98px) {
            gap: 36px;
        }
    }
    // .platform-c__item
    &__item {
        display: flex;
        flex-direction: column;
        align-items: center;
        // .platform-c__item_image
        &_image {
            &_con {
                height: 190px;
                display: flex;
                align-items: end;
            }
            &.n-1 {
                max-height: 190px;
            }
            &.n-2 {
                max-height: 145px;
            }
            &.n-3 {
                max-height: 137px;
            }
        }
        // .platform-c__item_title
        &_title {
            font-family: "AmpleSoftPro";
            font-style: normal;
            font-weight: 500;
            font-size: 27px;
            line-height: 107.6%;
            color: #000034;
            margin-bottom: 24px;
            align-self: start;
            text-align: center;
            width: 100%;
            @media (min-width: 1270.98px) {
                white-space: nowrap;
            }
            @media (max-width: 991.98px) {
                align-self: center;
                text-align: center;
            }
            @media (max-width: 767.98px) {
                font-size: 22px;
                line-height: 107.6%;
                margin-bottom: 20px;
            }
        }
        // .platform-c__item_text
        .text {
            text-align: center;
            @media (max-width: 767.98px) {
                align-self: center;
            }
        }
    }
}
</style>
