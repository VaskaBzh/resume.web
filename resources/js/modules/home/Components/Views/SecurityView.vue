<template>
<div class="security-view">
    <div class="security-view__container">
        <head-line class="security-view_btn">Безопасность</head-line>
        <div class="security-view_items">
            <div class="security-view_item">
                <h3 class="security-view_item_title">Шифрование данных майнера</h3>
                <p class="security-view_item_text">Шифрование данных, передаваемых между пользователями и сервером
                    пула, помогает предотвратить подслушивание или перехват злоумышленниками. Используя безопасные каналы, такие как
                    SSL/TLS, Allbtc Pool гарантирует,
                    что данные остаются конфиденциальными и безопасными во время передачи и защищенными от несанкционированного доступа.</p>
            </div>
            <div class="security-view_item">
                <h3 class="security-view_item_title">регулярные обновления ПО</h3>
                <p class="security-view_item_text">Регулярные обновления обеспечивают
                    улучшение системы безопасности:
                    обнаружение уязвимостей, их закрытие, и, как следствие, повышение надежности. Также
                    регулярные обновления программного
                    обеспечения пула обеспечивают совместимость с последними изменениями, вызванными
                    динамикой развития криптоиндустрии.</p>
            </div>
            <div class="security-view_item">
                <h3 class="security-view_item_title">защита от DDOS-атак</h3>
                <p class="security-view_item_text">Когда майнинг-пул подвержен DDoS-атакам, это может привести
                    к перебоям в майнинг операциях, что приводит к снижению выплат клиентам пула. Защита от DDoS-атак
                    гарантирует, что Allbtc Pool всегда будет работоспособным и обеспечит непрерывное
                    надежное обслуживание своих пользователей.</p>
            </div>
        </div>
    </div>
</div>
</template>



<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";

export default {
    name: "SecurityView",
    components: {HeadLine}
}
</script>



<style scoped lang="scss">
.security-view {
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    justify-content: center;

    &__container {
        margin: 0 auto;
    }

    &_items {
        width: 50vw;
        border-radius: 40px;
        border-top: 2px solid #555353;
        border-bottom: 0.5px solid #555353;
        background: rgba(13, 13, 13, 0.5);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        flex-flow: column nowrap;
        justify-content: flex-start;
        /*padding: 360px 0;*/
        /*gap: 560px;*/
    }

        &_item {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            justify-content: space-between;
            left: -200px;
            top: 0;


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
