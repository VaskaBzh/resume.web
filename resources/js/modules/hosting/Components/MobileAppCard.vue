<template>
    <div ref="view" class="system__section-wrap">
        <div class="system__section">
            <div class="system-card-inf">
                <p class="system-card-title">{{ $t("mobile_app.title") }}</p>
                <p class="system-card-text">{{ $t("mobile_app.text") }}</p>
            </div>
            <div class="system-card-img">
                <img
                    src="@img/iphone-14.png"
                    class="img-iphone img-system"
                />
                <img :src="imgTabBar" class="img-tab-bar img-system" />
                <div class="system__buttons">
                    <div
                        class="system_button system_button-prev"
                    >
                        <main-icon name="landing-arrow_left" class="system_icon" />
                    </div>
                    <div
                        class="system_button system_button-next"
                    >
                        <main-icon name="landing-arrow_right" class="system_icon" />
                    </div>
                </div>
                <swiper
                    :slides-per-view="1"
                    :space-between="0"
                    :pagination="{
                        clickable: false,
                        el: '.system__pagination',
                    }"
                    loop
                    :modules="modules"
                    :navigation="{ nextEl: '.system_button-next', prevEl: '.system_button-prev' }"
                    class="img-support img-system"
                    @slideChange="currentSlide"
                >
                    <swiper-slide>
                        <!--                    <img-->
                        <!--                        src="../../../../assets/img/iphone-14-screen1-ru.png"-->
                        <!--                        class="img-content"-->
                        <!--                        v-show="$i18n.locale === 'ru'"-->
                        <!--                    />-->
                        <img
                            src="@img/iphone-14-screen1-en.png"
                            class="img-content"
                        />
                    </swiper-slide>
                    <swiper-slide>
                        <!--                    <img-->
                        <!--                        src="../../../../assets/img/iphone-14-screen2-ru.png"-->
                        <!--                        class="img-content"-->
                        <!--                        v-show="$i18n.locale === 'ru'"-->
                        <!--                    />-->
                        <img
                            src="@img/iphone-14-screen2-en.png"
                            class="img-content"
                        />
                    </swiper-slide>
                    <swiper-slide>
                        <!--                    <img-->
                        <!--                        src="../../../../assets/img/iphone-14-screen3-ru.png"-->
                        <!--                        class="img-content"-->
                        <!--                        v-show="$i18n.locale === 'ru'"-->
                        <!--                    />-->
                        <img
                            src="@img/iphone-14-screen3-en.png"
                            class="img-content"
                        />
                    </swiper-slide>
                    <swiper-slide>
                        <!--                    <img-->
                        <!--                        src="../../../../assets/img/iphone-14-screen4-ru.png"-->
                        <!--                        class="img-content"-->
                        <!--                        v-show="$i18n.locale === 'ru'"-->
                        <!--                    />-->
                        <img
                            src="@img/iphone-14-screen4-en.png"
                            class="img-content"
                        />
                    </swiper-slide>
                    <swiper-slide>
                        <!--                    <img-->
                        <!--                        src="../../../../assets/img/iphone-14-screen5-ru.png"-->
                        <!--                        class="img-content"-->
                        <!--                        v-show="$i18n.locale === 'ru'"-->
                        <!--                    />-->
                        <img
                            src="@img/iphone-14-screen5-en.png"
                            class="img-content"
                        />
                    </swiper-slide>
                </swiper>
                <div class="system__pagination swiper swiper-pagination"></div>
            </div>
        </div>
    </div>
</template>
<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import { Navigation, Pagination } from "swiper";
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";
import MainIcon from "@/modules/common/icons/MainIcon.vue";

export default {
    components: {
        MainIcon,
        Swiper,
        SwiperSlide,
    },
    i18n: {
        sharedMessages: HostingMessage,
    },
    setup() {
        return {
            modules: [
                Pagination,
                Navigation,
            ],
        };
    },
    data() {
        return {
            slide: 1,
            tabBarName: "home",
        };
    },
    computed: {
        imgTabBar() {
            return new URL(
                `/resources/js/modules/hosting/assets/img/Tab-bar-${this.tabBarName}-en.png`,
                import.meta.url
            );
        },
    },
    watch: {
        slide(newSlide) {
            this.tabBarName = {
                0: "settings",
                1: "home",
                2: "statistic",
                3: "income",
                4: "worker",
                5: "settings",
                6: "home",
            }[newSlide ?? 0];
        },
    },
    methods: {
        currentSlide(e) {
            this.slide = e.activeIndex;
        },
    },
};
</script>
<style scoped lang="scss">
.img-content {
    width: 100%;
}

.system {
    &__buttons {
        position: absolute;
        left: 50%;
        top: 50%;
        min-width: adaptive-value(688px, 785px, 768.98px);
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: space-between;
        @media (max-width: 768.98px) {
            display: none;
        }
    }
    &_button {
        cursor: pointer;
    }
    &__pagination {
        position: absolute;
        bottom: -32px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
        @media (min-width: 768.98px) {
            display: none;
        }
    }
}

.system-card-inf {
    width: 399px;
    margin-bottom: 50px;
}

.system-card-title {
    color: var(--gray-1100, #f5faff);
    font-family: Unbounded;
    font-size: 36px;
    font-style: normal;
    font-weight: 600;
    line-height: 120%; /* 43.2px */
    text-transform: uppercase;
    margin-bottom: 20px;
}

.system-card-text {
    color: var(--gray-170, rgba(245, 250, 255, 0.7));
    font-family: NunitoSans;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%; /* 19.8px */
}

.img-tab-bar {
    z-index: 2;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% - 48px);
    @media (max-width: 470.98px) {
        bottom: 18px;
        width: calc(100% - 34px);
    }
}

.system-card-img {
    position: relative;
    max-width: 429px;
    width: 100%;
    min-height: 875px;
    @media (max-width: 470.98px) {
        height: adaptive-value(590px, 875px, 320px, 470.98px);
        min-height: 0;
    }
}

.img-system {
    position: absolute;
}

.img-support {
    min-height: 100%;
    width: calc(100% - 48px);
    top: 18px;
    left: 50%;
    transform: translateX(-50%);
    border-radius: 50px;
    overflow: hidden;
    @media (max-width: 470.98px) {
        top: adaptive-value(10px, 18px, 320px, 470.98px);
        width: calc(100% - 34px);
    }
}

.img-iphone {
    z-index: 10;
    pointer-events: none;
    width: 100%;
}

@media (max-width: 768px) {
    .system-card-title {
        font-size: 24px;
    }
}

@media (max-width: 460px) {
    .system-card-title {
        font-size: 18px;
    }

    .system-card-text {
        font-size: 14px;
    }

    .system-card-inf {
        width: 244px;
    }

    .img-status-bar {
        width: 208px;
        top: 13px;
        left: 34px;
    }
}
</style>
