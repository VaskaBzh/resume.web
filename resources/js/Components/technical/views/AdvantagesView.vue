<template>
    <div class="advantages">
        <div class="advantages__container">
            <main-title tag="h2" class="advantages_title"
                >Преимущества нашей платформы</main-title
            >
            <div class="wrap" v-show="viewportWidth >= 767.98">
                <div class="wrap__block">
                    <div class="">
                        <main-title tag="h3" class="wrap_title"
                            >1. Оптимизация использования ресурсов:</main-title
                        >
                        <p class="text text-md">
                            Платформа позволяет управлять ресурсами
                            майнинг-оборудования, оптимизировать их
                            использование и минимизировать затраты на
                            электроэнергию и охлаждение.
                        </p>
                    </div>
                    <div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >2. Улучшение безопасности:
                        </main-title>
                        <p class="text text-md">
                            Платформа обеспечивает безопасность майнингового
                            оборудования, предотвращая возможные сбои в работе.
                        </p>
                    </div>
                    <div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >3. Мониторинг и управление:</main-title
                        >
                        <p class="text text-md">
                            Платформа предоставляет возможность мониторинга
                            состояния оборудования, управления его работой и
                            предотвращения возможных проблем.
                        </p>
                    </div>
                    <div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >4. Автоматизация процессов:</main-title
                        >
                        <p class="text text-md">
                            Платформа позволяет автоматизировать многие
                            процессы, связанные с управлением майнинговым
                            оборудованием, что упрощает работу оператора и
                            снижает вероятность ошибок.
                        </p>
                    </div>
                    <div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >5. Снижение затрат:</main-title
                        >
                        <p class="text text-md">
                            Использование платформы управления хостингом
                            позволяет снизить затраты на оборудование и его
                            обслуживание, так как оператор может эффективно
                            управлять оборудованием и оптимизировать его
                            использование.
                        </p>
                    </div>
                </div>
            </div>
            <swiper
                class="wrap"
                loop
                v-if="viewportWidth < 767.98"
                :modules="modules"
                :slides-per-view="1"
                :space-between="25"
                :pagination="pagination"
                :autoHeight="false"
                @swiper="heightChange"
                @slideChangeTransitionStart="heightChange"
            >
                <swiper-slide class="wrap__block"
                    ><div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >1. Оптимизация использования ресурсов:</main-title
                        >
                        <p class="text text-md">
                            Платформа позволяет управлять ресурсами
                            майнинг-оборудования, оптимизировать их
                            использование и минимизировать затраты на
                            электроэнергию и охлаждение.
                        </p>
                    </div></swiper-slide
                >
                <swiper-slide class="wrap__block"
                    ><div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >2. Улучшение безопасности:
                        </main-title>
                        <p class="text text-md">
                            Платформа обеспечивает безопасность майнингового
                            оборудования, предотвращая возможные сбои в работе.
                        </p>
                    </div></swiper-slide
                >
                <swiper-slide class="wrap__block"
                    ><div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >3. Мониторинг и управление:</main-title
                        >
                        <p class="text text-md">
                            Платформа предоставляет возможность мониторинга
                            состояния оборудования, управления его работой и
                            предотвращения возможных проблем.
                        </p>
                    </div></swiper-slide
                >
                <swiper-slide class="wrap__block"
                    ><div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >4. Автоматизация процессов:</main-title
                        >
                        <p class="text text-md">
                            Платформа позволяет автоматизировать многие
                            процессы, связанные с управлением майнинговым
                            оборудованием, что упрощает работу оператора и
                            снижает вероятность ошибок.
                        </p>
                    </div></swiper-slide
                >
                <swiper-slide class="wrap__block"
                    ><div class="wrap__column">
                        <main-title tag="h3" class="wrap_title"
                            >5. Снижение затрат:</main-title
                        >
                        <p class="text text-md">
                            Использование платформы управления хостингом
                            позволяет снизить затраты на оборудование и его
                            обслуживание, так как оператор может эффективно
                            управлять оборудованием и оптимизировать его
                            использование.
                        </p>
                    </div></swiper-slide
                >
            </swiper>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
import { Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";

export default {
    name: "advantages-view",
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
        heightChange(swiper) {
            // при свайпе к первому или последнему слайду, изменить высоту слайдера вручную
            swiper.$el[0].style.height = `${
                swiper.slides[swiper.activeIndex].scrollHeight + 53
            }px`;
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

<style scoped lang="scss">
.advantages {
    margin: 124px 0;
    @media (max-width: 767.98px) {
        margin: 52px 0;
    }
    &_title {
        margin-bottom: 52px;
        font-weight: 500;
        font-size: 53px;
        line-height: 107.6%;
        color: #000034;
        @media (max-width: 767.98px) {
            margin-bottom: 40px;
            font-weight: 500;
            font-size: 35px;
            line-height: 107.6%;
            text-align: center;
        }
    }
    .swiper {
        padding: 10px 10px 43px !important;
        transition: all 0.3s ease 0s;
        &-slide {
            height: fit-content;
        }
    }
    .text-md {
        @media (max-width: 479.98px) {
            font-size: 16px;
        }
    }
    .wrap {
        &__block {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px 25px;
            padding: 40px;
            @media (max-width: 991.98px) {
                grid-template-columns: repeat(2, 1fr);
            }
            @media (max-width: 767.98px) {
                grid-template-columns: repeat(1, 1fr);
                padding: 20px;
            }
            @media (max-width: 478.98px) {
                padding: 16px;
            }
        }
        &__column {
            display: flex;
            min-height: 180px;
            gap: 16px;
            @media (min-width: 767.98px) {
                max-width: 380px;
            }
            .text {
                text-align: center;
            }
        }
        &_title {
            color: #3f7bde;
            text-align: center;
            font-size: 31px;
            line-height: 116%;
            font-weight: 500;
        }
    }
}
</style>
