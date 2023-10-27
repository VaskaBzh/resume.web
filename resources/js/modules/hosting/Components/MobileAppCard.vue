<template>
    <div ref="view" class="system__section-wrap">
        <div class="system__section">
            <div class="system-card-inf">
                <p class="system-card-title">{{ $t("mobile_app.title") }}</p>
                <p class="system-card-text">{{ $t("mobile_app.text") }}</p>
            </div>
            <div class="system-card-img">
                <img
                    src="../assets/img/Mockup-iphone.png"
                    class="img-iphone img-system"
                />
                <img
                    src="../assets/img/status-bar.png"
                    class="img-status-bar img-system"
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
                            src="../../../../assets/img/iphone-14-screen1-en.png"
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
                            src="../../../../assets/img/iphone-14-screen2-en.png"
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
                            src="../../../../assets/img/iphone-14-screen3-en.png"
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
                            src="../../../../assets/img/iphone-14-screen4-en.png"
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
                            src="../../../../assets/img/iphone-14-screen5-en.png"
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
    padding-bottom: 150px;
}

@media (max-width: 991.98px) {
    .swiper {
        padding-bottom: 100px !important;
    }
}

.img-content {
    width: 100%;
}

@media (max-width: 767.98px) {
    .swiper {
        padding-bottom: 62px !important;
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

.img-status-bar {
    z-index: 2;
    top: 24px;
    left: 42px;
}

.img-tab-bar {
    z-index: 2;
    bottom: 20px;
    left: 47px;
    width: 77%;
}

.system-card-img {
    position: relative;
    width: 408px;
    height: 722px;
    margin-bottom: clamp(20px, 6vw, 50px);
}

.img-system {
    position: absolute;
}

.img-support {
    left: 39px;
    top: 24px;
    height: auto;
    width: 310px;
    border: 1px solid rgba(255, 0, 0, 0);
    border-radius: 30px;
    margin: 0 10px;
}

.img-iphone {
    /* z-index: 10; */
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
        left: 35px;
        top: 9px;
        margin: auto;
    }

    .img-content {
        width: 208px;
        height: auto;
    }

    .img-status-bar {
        width: 208px;
        top: 13px;
        left: 34px;
    }

    .img-tab-bar {
        width: 208px;
        bottom: 18px;
        left: 36px;
    }
}
</style>
