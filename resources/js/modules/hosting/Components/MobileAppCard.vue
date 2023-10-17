<template>
    <div class="system__section system__section-wrap" ref="view">
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
            <img :src="imgTabBar" class="img-tab-bar img-system"/>
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
</template>
<script>
import {Swiper, SwiperSlide} from "swiper/vue";
import "swiper/css";
import "swiper/css/pagination";
import {Pagination} from "swiper";
import {HostingMessage} from "@/modules/hosting/lang/HostingMessage";

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    i18n: {
        sharedMessages: HostingMessage,
    },
    data() {
        return {
            slide: 1,
            tabBarName: "home",
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    methods: {
        currentSlide(e) {
            this.slide = e.activeIndex;
        },
        handleTouchStart(e) {
            this.startY = e.touches[0].clientY;
        },
        handleTouchMove(e) {
            this.touchY = e.touches[0].clientY;
            this.handleWheel();
        },
        handleWheel(e) {
            if (this.startY ? this.startY - this.touchY > 110 : e.deltaY > 10) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 &&
                    !this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(-${
                        this.$refs.view.offsetHeight -
                        document.scrollingElement.clientHeight
                    }px)`;

                    this.validScroll = true;
                } else {
                    this.$emit("next");
                }
            }
            if (
                this.startY ? this.touchY - this.startY > 110 : e.deltaY < -10
            ) {
                this.remove();
                setTimeout(this.scroll, 650);

                if (
                    this.$refs.view.offsetHeight -
                    document.scrollingElement.clientHeight >
                    20 &&
                    this.validScroll
                ) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
                this.$refs.view.focus();
                this.$refs.view.addEventListener("wheel", this.handleWheel);
                this.$refs.view.addEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.addEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
        remove() {
            if (this.$refs.view) {
                this.$refs.view.removeEventListener("wheel", this.handleWheel);
                this.$refs.view.removeEventListener(
                    "touchstart",
                    this.handleTouchStart
                );
                this.$refs.view.removeEventListener(
                    "touchmove",
                    this.handleTouchMove
                );
            }
        },
    },
    mounted() {
        setTimeout(this.scroll, 500);
    },
    unmounted() {
        this.remove();
    },
    watch: {
        slide(newSlide) {
            switch (newSlide) {
                case 1:
                    this.tabBarName = "home";
                    break;
                case 2:
                    this.tabBarName = "statistic";
                    break;
                case 3:
                    this.tabBarName = "income";
                    break;
                case 4:
                    this.tabBarName = "worker";
                    break;
                case 5:
                    this.tabBarName = "settings";
                    break;
            }
        },
    },
    computed: {
        imgTabBar() {
            return new URL(
                `/resources/js/modules/hosting/assets/img/Tab-bar-${this.tabBarName}-en.png`,
                import.meta.url
            );
        },
    },
    setup() {
        return {
            modules: [Pagination],
        };
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
