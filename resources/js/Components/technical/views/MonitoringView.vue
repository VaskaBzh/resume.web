<template>
    <div class="monitoring">
        <div class="monitoring__container">
            <div class="monitoring__main">
                <div class="monitoring__content">
<!--                    v-scroll="'left delay&#45;&#45;md'"-->
                    <main-title
                        tag="h2"
                        class="monitoring__title"
                    >
                        Мониторинг пулов
                    </main-title>
                    <div class="wrap">
                        <div class="wrap__block wrap__block-blue">
                            <!--                            v-scroll="'left delay&#45;&#45;lg'"-->
                            <div class="text text-md text-ligth">
                                <span>Мониторинг пулов</span>
                                Мониторинг пулов – это процесс отслеживания и
                                контроля состояния майнингового оборудования,
                                подключенного к пулу. Это позволяет получать
                                информацию о работе своих устройств, а также о
                                состоянии сети в целом.<br /><br />
                                Система мониторинга пулов дата-центров – это
                                незаменимый инструмент для обеспечения надежной
                                и бесперебойной работы вашего бизнеса.
                            </div>
                        </div>
                    </div>
                </div>
                <img :src="img" alt="" class="monitoring__image" />
                <!--                v-scroll="'left'"-->
            </div>
        </div>
    </div>
</template>

<script>
import MainTitle from "@/Components/UI/MainTitle.vue";
export default {
    name: "monitoring-view",
    components: {
        MainTitle,
    },
    computed: {
        img() {
            return new URL(
                `/resources/assets/img/monitoring_img.png`,
                import.meta.url
            );
        },
    },
};
</script>

<style scoped lang="scss">
.monitoring {
    //background-image: url("/resources/assets/img/about-panel-bg.png");
    //background-position: center 30%;
    //background-size: contain;
    //background-repeat: no-repeat;
    margin-bottom: 64px;
    @media (max-width: 991.98px) {
        margin-bottom: 32px;
    }
    @media (max-width: 767.98px) {
        background-position: center 45%;
    }
}
.monitoring {
    &__main {
        display: flex;
        align-items: center;
        gap: 65px;
        @media (max-width: 991.98px) {
            flex-direction: column;
            gap: 20px;
        }
    }
    // .monitoring__content
    &__content {
        flex: 0 0 510px;
        .wrap {
            .text {
                display: flex;
                flex-direction: column;
                gap: 24px;
            }
        }
    }
    // .monitoring__title
    &__title {
        font-family: "AmpleSoftPro", serif;
        font-style: normal;
        font-weight: 500;
        font-size: 40px;
        line-height: 132.6%;
        color: #000034;
        margin-bottom: 24px;
        @media (max-width: 991.98px) {
            text-align: center;
        }
        @media (max-width: 767.98px) {
            font-size: 27px;
            line-height: 107.6%;
            margin-bottom: 16px;
        }
    }
    // .monitoring__text
    .text {
        @media (max-width: 991.98px) {
            text-align: center;
        }
    }
    // .monitoring__image
    &__image {
        max-width: 1120px;
        margin: -15pc 0 -13pc -12pc;
        @media (max-width: 1270px) {
            max-width: 930px;
            margin: -10pc 0 -13pc -12pc;
        }
        @media (max-width: 991.98px) {
            max-height: 700px;
            max-width: unset;
            margin: -9pc 0 -8pc;
        }
        @media (max-width: 767.98px) {
            max-height: unset;
            max-width: 510px;
            margin: -6pc 0;
        }
    }
}
</style>
