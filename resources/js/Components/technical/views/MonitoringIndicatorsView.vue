<template>
    <div class="indicators">
        <div class="indicators__container">
            <div class="indicators__main">
                <main-title tag="h2" class="indicators__title">
                    Скриншоты показателей мониторинга:
                </main-title>
                <indicators-slider :options="options"></indicators-slider>
            </div>
        </div>
    </div>
</template>

<script>
import IndicatorsSlider from "@/Components/technical/IndicatorsSlider.vue";
import MainTitle from "@/Components/UI/MainTitle.vue";

export default {
    name: "monitoring-indicators-view",
    components: {
        IndicatorsSlider,
        MainTitle,
    },
    computed: {
        options() {
            return [
                [
                    {
                        title:
                            "1. История перемещений\n" +
                            "и местоположений устройств",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-1.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "История перемещений и местоположений устройств может помочь определить, где находятся майнеры в любое время, что может быть полезно для обеспечения безопасности и защиты от несанкционированного доступа.",
                        "Помимо безопасности, обеспечивается оптимизация работы майнеров, что позволяет операторам сети определить, какие майнеры работают наиболее эффективно и где их можно разместить для максимальной производительности.",
                    ],
                ],
                [
                    {
                        title: "2. История ремонтов",
                        text: "Отслеживание истории ремонтов асик-майнеров может быть полезно по нескольким причинам:",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-2.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "1. Гарантия: .........\n" +
                            "2. Улучшение качества: отслеживание ремонта может помочь выявить проблемы, которые могут возникнуть в будущем. \n" +
                            "3. Устранение проблем: отслеживая историю ремонтов, мы получаем информацию о том, какие проблемы возникали в прошлом и как они были решены.",
                    ],
                ],
                [
                    {
                        title:
                            "3. Уведомления о сбоях\n" +
                            "и отключениях оборудования",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-3.png`,
                            import.meta.url
                        ),
                    },
                    [],
                ],
                [
                    {
                        title: "4. Отслеживание температуры",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-4.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "Отслеживать показатели температуры важно для того, чтобы майнер работал эффективно, не перегревался и не выходил из строя.",
                    ],
                ],
                [
                    {
                        title: "5. Автоматизация часов ПИК",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-5.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "Используя часы ПИК, мы обеспечиваем грамотное энергоэффективное использование оборудования, которое снижает общие затраты клиента на свет.",
                    ],
                ],
                [
                    {
                        title: "6. Отслеживание хэшрейта",
                        text: "Хешрейт (hashrate) - это показатель производительности майнинга, скорость, с которой майнер находит хеш-функцию.",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-6.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "Отслеживание устройств в реальном времени и соотношение текущего хешрейта \n" +
                            "с плановым нужно для того, чтобы исключить просадки хешрейта по оборудованию.",
                    ],
                ],
                [
                    {
                        title: "7. Отслеживание uptime",
                        text: "Аптайм (uptime) в майнинге - это время, в течение которого майнер работает без сбоев и остановок.",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-7.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "Отслеживание аптайма в режиме реального времени позволяет оценить стабильность и производительность работы майнинг-оборудования.",
                        "Также показатель аптайма используют для оценки  эффективности использования майнингового оборудования: чем выше аптайм, тем больше времени используется для майнинга, что может привести к увеличению прибыли.",
                    ],
                ],
                [
                    {
                        title: "8. Отслеживание статусов устройств",
                        text: "В работе, выключен, неисправен, архивирован, перемещение",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-8.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "Благодаря статусам мы можем понять, какие аппараты находятся в работе, а какие в процессе установки и изменять статусы в соответствии с текущим состоянием устройства.",
                        "Отслеживание статуса майнинг-оборудования помогает управлять работой ASIC-майнеров и оптимизировать их использование, что может привести к увеличению прибыли и повышению эффективности майнинга.",
                    ],
                ],
                [
                    {
                        title: "9. Автоматическое выставление счетов",
                        img: new URL(
                            `/resources/assets/img/indicators_img-skew-9.png`,
                            import.meta.url
                        ),
                    },
                    [
                        "Система автоматического выставления счетов проверяет правильность данных и не допускает ошибок, связанных с человеческим фактором.",
                    ],
                ],
            ];
        },
    },
};
</script>

<style scoped lang="scss">
.indicators {
    margin: 0 0 94px;
    background-image: url("/resources/assets/img/about-panel-bg.png");
    background-position: 20% 30%;
    background-size: contain;
    background-repeat: no-repeat;
    @media (max-width: 991.98px) {
        background-position: 20% 280px;
    }
    @media (max-width: 767.98px) {
        background-position: 20% 200px;
    }
    &__main {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
}
</style>
