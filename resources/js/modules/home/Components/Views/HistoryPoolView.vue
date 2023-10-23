<template>
    <div class="history history__section-wrap" ref="view">
        <div class="history__section">
            <landing-headline class="history-pool_headline"
                >История нашего пула
            </landing-headline>
            <Swiper
                class="history-pool__items"
                slides-per-view="auto"
                :modules="modules"
                :slides-per-view="
                    viewportWidth > 1200 ? 2.5 : viewportWidth > 800 ? 1.5 : 1
                "
                :pagination="{
                    clickable: true,
                }"
                :navigation="{ nextEl: '.next', prevEl: '.prev' }"
            >
                <swiper-slide class="history-pool__item-line">
                    <div class="history-pool__item-line-block">
                        <div class="history-pool__item-line_cycle"></div>
                    </div>
                    <div class="history-pool__item-info">
                        <h3 class="history-pool__item-info-year">2019</h3>
                        <p class="history-pool__item-info-discription">
                            {{ $t("history_pool.texts[0]") }}
                        </p>
                    </div>
                </swiper-slide>
                <swiper-slide class="history-pool__item-line">
                    <div class="history-pool__item-line-block">
                        <div class="history-pool__item-line_cycle"></div>
                    </div>
                    <div class="history-pool__item-info">
                        <h3 class="history-pool__item-info-year">2020</h3>
                        <p class="history-pool__item-info-discription">
                            {{ $t("history_pool.texts[1]") }}
                        </p>
                    </div>
                </swiper-slide>
                <swiper-slide class="history-pool__item-line">
                    <div class="history-pool__item-line-block">
                        <div class="history-pool__item-line_cycle"></div>
                    </div>
                    <div class="history-pool__item-info">
                        <h3 class="history-pool__item-info-year">2021</h3>
                        <p class="history-pool__item-info-discription">
                            {{ $t("history_pool.texts[2]") }}
                        </p>
                    </div>
                </swiper-slide>
                <swiper-slide class="history-pool__item-line">
                    <div class="history-pool__item-line-block">
                        <div class="history-pool__item-line_cycle"></div>
                    </div>
                    <div class="history-pool__item-info">
                        <h3 class="history-pool__item-info-year">2022</h3>
                        <p class="history-pool__item-info-discription">
                            {{ $t("history_pool.texts[3]") }}
                        </p>
                    </div>
                </swiper-slide>
                <swiper-slide class="history-pool__item-line">
                    <div class="history-pool__item-line-block">
                        <div class="history-pool__item-line_cycle"></div>
                    </div>
                    <div class="history-pool__item-info">
                        <h3 class="history-pool__item-info-year">2023</h3>
                        <p class="history-pool__item-info-discription">
                            {{ $t("history_pool.texts[4]") }}
                        </p>
                    </div>
                </swiper-slide>
            </Swiper>
            <div class="history__buttons">
                <button-blue
                    class="mobile-view_prev prev"
                    v-if="viewportWidth > 1200"
                ></button-blue>
                <button-blue
                    class="mobile-view_prev next"
                    v-if="viewportWidth > 1200"
                ></button-blue>
            </div>
        </div>
    </div>
</template>

<script>
import LandingHeadline from "../../../common/Components/UI/LandingHeadline.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation } from "swiper";
import "swiper/css";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import { mapGetters } from "vuex";

export default {
    name: "HistoryPoolView",
    components: {
        ButtonBlue,
        LandingHeadline,
        Swiper,
        SwiperSlide,
    },
    i18n: {
        sharedMessages: HomeMessage,
    },
    setup() {
        return {
            modules: [Navigation],
        };
    },
    computed: {
        ...mapGetters(["viewportWidth"]),
    },
};
</script>

<style scoped lang="scss">
.history__buttons {
    display: flex;
    gap: 50px;
    align-items: center;
    margin-top: 50px;
    margin-right: auto;
}

.history-pool {
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: flex-start;
    padding: 100px 0 70px 0;

    &_headline {
        margin-bottom: clamp(50px, 15vw, 250px);
    }

    &__items {
        display: flex;
        width: 100vw;
        margin: 0 clamp(-16px, 5vw, -100px);
    }

    &__item-line {
        display: flex;
        margin-left: auto;
        flex-direction: column;
        position: relative;
        gap: clamp(30px, 10vw, 35px);
        padding-left: clamp(16px, 5vw, 100px);

        &:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 20px;
            background: rgba(208, 213, 221, 0.2);
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

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

    &__item-info {
        width: 310px;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-flow: column nowrap;
        gap: clamp(10px, 10vw, 20px);

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
