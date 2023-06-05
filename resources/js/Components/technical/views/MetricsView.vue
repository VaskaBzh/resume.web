<template>
    <div class="metric">
        <div class="metric__container">
            <div class="metric__main">
                <main-title tag="h2" class="metric_title">
                    Показатели мониторинга пулов в режиме реального времени:
                </main-title>
                <div class="wrap">
                    <metric-block
                        v-for="option in metrics"
                        :options="option"
                        v-if="viewportWidth > 991.98"
                    ></metric-block>
                    <swiper
                        v-else
                        :modules="modules"
                        :slides-per-view="1"
                        :space-between="24"
                        :pagination="pagination"
                    >
                        <swiper-slide v-for="options in metrics">
                            <metric-block
                                v-for="option in options"
                                :options="option"
                            ></metric-block>
                        </swiper-slide>
                    </swiper>
                    <div class="wrap__block wrap__block-blue">
                        <p class="text text-md text-white">
                            Система учета и мониторинга - это не просто
                            инструмент для контроля работы оборудования, это
                            <b
                                >возможность повысить эффективность майнинга и
                                увеличить доходность бизнеса.</b
                            >
                            Наша система позволяет отслеживать работу каждого
                            устройства в пуле, выявлять возможные проблемы и
                            принимать меры по их устранению.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import MetricBlock from "@/Components/technical/blocks/MetricBlock.vue";
import { Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";

export default {
    name: "metrics-view",
    components: {
        Swiper,
        SwiperSlide,
        MainTitle,
        MetricBlock,
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
    computed: {
        metrics() {
            if (this.viewportWidth > 991.98) {
                return [
                    {
                        number: "01",
                        text:
                            "<b>История</b> перемещений <br>" +
                            "и местоположений устройств",
                    },
                    {
                        number: "02",
                        text: "<b>История</b> ремонтов",
                    },
                    {
                        number: "03",
                        text:
                            "<b>Уведомления</b> о сбоях <br>" +
                            "и отключениях оборудования",
                    },
                    {
                        number: "04",
                        text: "<b>Отслеживание</b> температуры",
                    },
                    {
                        number: "05",
                        text: "<b>Автоматизация</b> часов ПИК",
                    },
                    {
                        number: "06",
                        text: "<b>Отслеживание</b> хэшрейта",
                    },
                    {
                        number: "07",
                        text: "<b>Отслеживание</b> uptime",
                    },
                    {
                        number: "08",
                        text: "<b>Отслеживание</b> статусов устройств",
                    },
                    {
                        number: "09",
                        text: "<b>Автоматическое</b> выставление счетов",
                    },
                ];
            } else {
                return [
                    [
                        {
                            number: "01",
                            text:
                                "<b>История</b> перемещений <br>" +
                                "и местоположений устройств",
                        },
                        {
                            number: "02",
                            text: "<b>История</b> ремонтов",
                        },
                        {
                            number: "03",
                            text:
                                "<b>Уведомления</b> о сбоях <br>" +
                                "и отключениях оборудования",
                        },
                    ],
                    [
                        {
                            number: "04",
                            text: "<b>Отслеживание</b> температуры",
                        },
                        {
                            number: "05",
                            text: "<b>Автоматизация</b> часов ПИК",
                        },
                        {
                            number: "06",
                            text: "<b>Отслеживание</b> хэшрейта",
                        },
                    ],
                    [
                        {
                            number: "07",
                            text: "<b>Отслеживание</b> uptime",
                        },
                        {
                            number: "08",
                            text: "<b>Отслеживание</b> статусов устройств",
                        },
                        {
                            number: "09",
                            text: "<b>Автоматическое</b> выставление счетов",
                        },
                    ],
                ];
            }
        },
    },
};
</script>

<style scoped lang="scss">
.metric {
    margin: 220px 0 94px;
    @media (max-width: 767.98px) {
        margin: 52px 0;
    }
    &_title {
        margin-bottom: 52px;
        @media (max-width: 767.98px) {
            margin-bottom: 23px;
        }
    }
    .wrap {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        @media (max-width: 991.98px) {
            grid-template-columns: 1fr;
        }
        &__block-blue {
            grid-column-start: 1;
            grid-column-end: 4;
            padding: 20px;
            @media (min-width: 991.98px) {
                padding: 62px 57px;
            }
            @media (max-width: 767.98px) {
                padding: 10px;
            }
            @media (max-width: 991.98px) {
                grid-column-end: 1;
            }

            .text {
                line-height: 181.1%;
                @media (max-width: 479.98px) {
                    font-size: 16px;
                }
            }
        }
    }
    .swiper {
        width: 100%;
        &-slide {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
    }
}
</style>
