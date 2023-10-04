<template>
<div class="about">
    <head-line>Кто мы</head-line>
    <div class="about__wrapper">
        <div class="about__inner">
            <div class="about_item">
                <h2 class="about_item_title">Приватный пул для дата-центров</h2>
                <div class="about_item_cards">
                    <div class="about_item_card">
                        <div class="about_item_card_num">7</div>
                        <div class="about_item_card_description">лет в крипто индустрии</div>
                    </div>
                    <div class="about_item_card">
                        <div class="about_item_card_num">1.7</div>
                        <div class="about_item_card_description">EH/ s хешрейт пула</div>
                    </div>
                    <div class="about_item_card">
                        <div class="about_item_card_num">30</div>
                        <div class="about_item_card_description">BTC добыто всего</div>
                    </div>
                    <div class="about_item_card">
                        <div class="about_item_card_num"><span>до</span>75%</div>
                        <div class="about_item_card_description">больше прибыли за кВт</div>
                    </div>
                </div>
                <button-blue class="about_link">узнать больше</button-blue>
            </div>
            <div class="about_item">
                <h2 class="about_item_title">Комьюнити для частных майнеров</h2>
                <div class="about_item_cards">
                    <div class="about_item_card">
                        <div class="about_item_card_num">№1</div>
                        <div class="about_item_card_description">клиентский сервис</div>
                    </div>
                    <div class="about_item_card">
                        <div class="about_item_card_num">24/7</div>
                        <div class="about_item_card_description">быстрая техподдержка</div>
                    </div>
                    <div class="about_item_card">
                        <div class="about_item_card_num">1</div>
                        <div class="about_item_card_description">экран для статистики</div>
                    </div>
                    <div class="about_item_card">
                        <div class="about_item_card_num">4%</div>
                        <div class="about_item_card_description">комиссия пула</div>
                    </div>
                </div>
                <button-blue class="about_link">узнать больше</button-blue>
            </div>
        </div>
        <div class="about_stiky"></div>
    </div>

    <button-blue class="about_btn">получить персональные условия</button-blue>
</div>
</template>

<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";

export default {
    name: "WhoWeAre",
    components: {ButtonBlue, HeadLine}
}
</script>

<style scoped lang="scss">
.about {
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-flow: column nowrap;
    gap: 30px;
    padding: 100px 0 186px;
    background: #4A96FF;


    &__wrapper {
        display: flex;
        flex-flow: row nowrap;
    }

    &__inner {
        width: 75%;
        display: flex;
        flex-flow: column nowrap;
        margin: 0 auto;
    }

    &_item {
        width: 80%;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        top: 0;
        gap: 30px;
        z-index: 99;

        &_title {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
            width: 50%;
        }

        &_cards {
            display: flex;
            flex-flow: column nowrap;
            align-items: flex-start;
            justify-content: center;
            gap: 50px;

        }

        &_card {
            display: flex;
            flex-flow: column nowrap;

            &_num {
                color: #D0D5DD;
                font-family: Unbounded, serif;
                font-size: 75px;
                font-style: normal;
                font-weight: 600;
                line-height: 100%; /* 75px */
                text-transform: uppercase;

                span {
                    font-family: NunitoSans, serif;
                    font-size: 20px;
                    font-style: normal;
                    font-weight: 400;
                    line-height: 110%;
                    color: rgba(208, 213, 221, 0.60);
                }
            }

            &_description {
                font-family: NunitoSans, serif;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 110%;
                color: rgba(208, 213, 221, 0.60);
            }
        }
    }

    &_stiky {
        width: 700px;
        height: 554px;
        border-radius: 40px;
        border-top: 2px solid #555353;
        border-bottom: 0.5px solid #555353;
        background: rgba(13, 13, 13, 0.5);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        flex-flow: column nowrap;
        justify-content: center;
        position: absolute;
        left: 50%;
        transform: translate(-50%, 50%);
    }

}
</style>
