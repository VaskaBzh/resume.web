<template>
    <div class="history history__section history__section-wrap" ref="view">
        <landing-headline>История нашего пула</landing-headline>
        <Swiper
            class="history-pool__items"
            :freeMode="true"
            slidesPerView="auto"
            :modules="modules"
            :pagination="{
                clickable: true,
            }"
        >
            <swiper-slide class="history-pool__item-line">
                <div class="history-pool__item-line-block">
                    <div class="history-pool__item-line_cycle"></div>
                </div>
                <div class="history-pool__item-line-block">
                    <div class="history-pool__item-line_cycle"></div>
                </div>
                <div class="history-pool__item-line-block">
                    <div class="history-pool__item-line_cycle"></div>
                </div>
                <div class="history-pool__item-line-block">
                    <div class="history-pool__item-line_cycle"></div>
                </div>
                <div class="history-pool__item-line-block">
                    <div class="history-pool__item-line_cycle"></div>
                </div>
            </swiper-slide>
            <swiper-slide class="history-pool__item-infos">
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2019</h3>
                    <p class="history-pool__item-info-discription">
                        {{ $t("history_pool.texts[0]") }}
                    </p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2020</h3>
                    <p class="history-pool__item-info-discription">
                        {{ $t("history_pool.texts[1]") }}
                    </p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2021</h3>
                    <p class="history-pool__item-info-discription">
                        {{ $t("history_pool.texts[2]") }}
                    </p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2022</h3>
                    <p class="history-pool__item-info-discription">
                        {{ $t("history_pool.texts[3]") }}
                    </p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2023</h3>
                    <p class="history-pool__item-info-discription">
                        {{ $t("history_pool.texts[4]") }}
                    </p>
                </div>
            </swiper-slide>
        </Swiper>
    </div>

    <!--        <connect-with-us-view/>-->
</template>

<script>
import LandingHeadline from "../../../common/Components/UI/LandingHeadline.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { FreeMode } from "swiper";
import "swiper/css";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";

export default {
    name: "HistoryPoolView",
    components: {
        LandingHeadline,
        Swiper,
        SwiperSlide,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    setup() {
        return {
            modules: [FreeMode],
        };
    },
    data() {
        return {
            validScroll: false,
            startY: null,
            touchY: null,
        };
    },
    props: {
        start: Boolean,
    },
    methods: {
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
                setTimeout(this.scroll, 300);
                if (!this.validScroll) {
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
                setTimeout(this.scroll, 300);

                if (this.validScroll) {
                    this.$refs.view.style.transform = `translateY(0px)`;

                    this.validScroll = false;
                } else {
                    this.$emit("prev");
                }
            }
        },
        scroll() {
            if (this.$refs.view) {
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
    watch: {
        start(newStartState) {
            if (newStartState) {
                this.scroll();
            } else {
                this.remove();
            }
        },
    },
    mounted() {
        setTimeout(this.scroll, 500);
    },
    unmounted() {
        this.remove();
    },
};
</script>

<style scoped lang="scss">
.history-pool {
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: flex-start;
    padding: 100px 0 70px 0;

    &__items {
        width: fit-content;
        display: flex;
        flex-flow: column nowrap;
        gap: 38px;
        margin-left: auto;
        .swiper-wrapper {
            flex-flow: column nowrap;
        }
    }

    &__item-line {
        display: flex;
        flex-flow: row nowrap;
        gap: 511px;
        margin-left: auto;
        padding-left: 50vw;
        background: rgba(208, 213, 221, 0.2);

        &-block {
            width: 310px;
        }

        &_cycle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #f5faff;
        }
    }

    &__item-infos {
        display: flex;
        flex-flow: row nowrap;
        gap: 511px;
        margin-left: auto;
        padding-left: 50vw;
        opacity: 1;
    }

    &__item-info {
        width: 310px;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-flow: column nowrap;

        &-year {
            color: #f5faff;
            font-family: Unbounded, serif;
            font-size: 30px;
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
        }

        &-discription {
            color: rgba(245, 250, 255, 0.7);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }
}

.notActive {
    opacity: 1;
}

@media (max-width: 479.98px) {
    .history-pool {
        &__item-line {
            gap: 65px;
            padding-left: 15vw;

            &-block {
                width: 190px;
            }

            &_cycle {
                width: 10px;
                height: 10px;
            }
        }

        &__item-infos {
            gap: 65px;
            padding-left: 15vw;
        }

        &__item-info {
            width: 190px;

            &-year {
                font-size: 14px;
                line-height: 100%;
            }

            &-discription {
                font-size: 14px;
                line-height: 100%;
            }
        }
    }
}
</style>
