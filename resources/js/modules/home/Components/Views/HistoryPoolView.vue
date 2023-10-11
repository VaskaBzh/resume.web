<template>
    <div class="history-pool">
        <head-line class="history-pool__btn">История нашего пула</head-line>
        <div class="history-pool__items">
            <div class="history-pool__item-line">
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
            </div>
            <div class="history-pool__item-infos">
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2019</h3>
                    <p class="history-pool__item-info-discription">Создаем площадки под
                        размещение дата-центов, хостингов и майнинг-отелей.
                        Сотрудничаем с подрядчиками в РФ и СНГ. Создаем зоны для майнинга «под ключ»: от аренды до введения фермы
                        в эксплуатацию.</p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2020</h3>
                    <p class="history-pool__item-info-discription">Произошел халвинг, сложность майнинга
                        выросла. Появилась команда разработчиков. Наша цель – создание актуальных решений
                        для оптимизации работы промышленных майнеров
                        и дата-центров.</p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2021</h3>
                    <p class="history-pool__item-info-discription">Биткоин значительно подорожал. Мы кратно расширили
                        штат и сформировали систему мониторинга для дата-центров. В этом же году заключили
                        первые договоры на кастомную интеграцию.</p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2022</h3>
                    <p class="history-pool__item-info-discription">Официально зарегистрировали пул для майнинга криптовалют.
                        К системе подключились первые дата-центры. На 50% увеличили их прибыль
                        за каждый потраченный киловатт энергии.</p>
                </div>
                <div class="history-pool__item-info">
                    <h3 class="history-pool__item-info-year">2023</h3>
                    <p class="history-pool__item-info-discription">Перестали работать только лишь как закрытый пул для
                        дата-центров, вышли на международный рынок.
                        К концу 2023 года у нас амбициозные планы.</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import {animeteHistoryView} from "../../Services/AnimateHistoryView";

export default {
    name: "HistoryPoolView",
    components: {HeadLine},
    mounted() {
        animeteHistoryView()
    }
}
</script>


<style scoped lang="scss">
.history-pool {
    display: flex;
    height: 100vh;
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
    }

    &__item-line {
        display: flex;
        flex-flow: row nowrap;
        gap: 511px;
        margin-left: auto;
        padding-left: 50vw;
        background: rgba(208, 213, 221, 0.20);

        &-block {
            width: 310px;
        }
        &_cycle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #F5FAFF;
        }
    }

    &__item-infos {
        display: flex;
        flex-flow: row nowrap;
        gap: 511px;
        margin-left: auto;
        padding-left: 200px;
    }

    &__item-info {
        width: 310px;
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-flow: column nowrap;

        &-year {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: 30px;
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
        }

        &-discription {
            color: rgba(245, 250, 255, 0.70);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }
}

.notActive {
    opacity: .6;
}
</style>
