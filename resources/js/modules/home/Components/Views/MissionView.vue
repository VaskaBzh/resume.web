<template>
<div class="mission-view">
    <div class="mission-view__container">
        <head-line class="mission-view_btn">Главное</head-line>
        <div class="mission-view_items">
            <div class="mission-view_item">
                <h3 class="mission-view_item_title">Ценности</h3>
                <p class="mission-view_item_text">Мы поддерживаем честность, прозрачность и
                    постоянное развитие во всем, что мы делаем. Поощряем
                    творчество, принимаем перемены и постоянно ищем новые способы улучшения
                    наших предложений и процессов.</p>
            </div>
            <div class="mission-view_item">
                <h3 class="mission-view_item_title">Миссия</h3>
                <p class="mission-view_item_text">Сделать майнинг биткоина
                    максимально эффективным и удобным, обеспечивая
                    высокую безопасность данных клиентов и их цифровых активов.</p>
            </div>
            <div class="mission-view_item">
                <h3 class="mission-view_item_title">Цели</h3>
                <p class="mission-view_item_text">Мы стремимся создать максимально безопасную среду для
                    управления своими цифровыми активами и
                    объединить майнеров в большое комьюнити единомышленников.</p>
            </div>
        </div>
    </div>
</div>
</template>



<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";

export default {
    name: "MissionView",
    components: {HeadLine}
}
</script>



<style scoped lang="scss">

.mission-view {
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: center;

    &_items {
        width: 50vw;
        height: 40vh;
        border-radius: 40px;
        border-top: 2px solid #555353;
        border-bottom: 0.5px solid #555353;
        background: rgba(13, 13, 13, 0.5);
        backdrop-filter: blur(10px);
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        gap: 10px;
    }

    &_item {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;


        &:nth-child(1) &_title {
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            font-weight: bold;
            font-size: 126px;
            font-family: NunitoSans, serif;
            text-align: center;
            -webkit-text-stroke: 0.5px rgb(255,255,255, 0.5);
            color: transparent;
        }

        &_title {
            color: #F5FAFF;
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: Unbounded, serif;
            font-size: 110px;
            font-style: normal;
            font-weight: 600;
            line-height: 100%;
            text-transform: uppercase;
            width: 50%;
            position: relative;
            left: -327px;
            top: 0;
        }

        &_text {
            width: 380px;
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }
}

</style>
