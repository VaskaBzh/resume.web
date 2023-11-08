<template>
    <div ref="view" class="system__section-wrap">
        <div class="system__section">
            <div class="system-card-inf">
                <p class="system-card-title">{{ $t("mobile_app.title") }}</p>
                <p class="system-card-text">{{ $t("mobile_app.text") }}</p>
            </div>
            <div class="system-card-img">
                <img
                    src="@img/Iphone-14.png"
                    class="img-iphone img-system"
                />
                <img :src="imgTabBar" class="img-tab-bar img-system" />
                <swiper
                    :slides-per-view="1"
                    :space-between="0"
                    :pagination="{
                        clickable: true,
                    }"
                    :loop="true"
                    :modules="modules"
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
            </div>
        </div>
    </div>
</template>
<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import { Pagination } from "swiper";
import { HostingMessage } from "@/modules/hosting/lang/HostingMessage";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    i18n: {
        sharedMessages: HostingMessage,
    },
    setup() {
        return {
            modules: [Pagination],
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
<style scoped>
.swiper {
    padding-bottom: 72px !important;
}
.img-content {
    width: 100%;
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
}

.system-card-img {
    position: relative;
    max-width: 429px;
    width: 100%;
    min-height: 875px;
}

.img-system {
    position: absolute;
}

.img-support {
    min-height: 100%;
    width: calc(100% - 48px);
    left: 24px;
}

.img-iphone {
    z-index: 10;
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

    .system-card-img,
    .img-iphone {
        width: 281px;
        height: 497px;
    }

    .img-support {
        width: 224px;
        left: 30px;
        top: 9px;
        margin: 0 auto;
    }

    .img-content {
        width: 100%;
        margin: 0 auto;
        display: inline-block;
        height: 450px;
    }

    .img-status-bar {
        width: 208px;
        top: 13px;
        left: 34px;
    }

    .img-tab-bar {
        width: 222px;
        bottom: 18px;
        left: 30px;
    }
}
</style>
