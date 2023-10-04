<template>
    <div class="security-view">
        <div class="security-view__container">
            <head-line class="security-view_btn">Безопасность</head-line>
            <div class="security-view__wrapper">
                <div class="security-view__left">
                    <div class="security-view__left__item__wrapper">
                        <div class="security-view_item">
                            <h3 class="security-view_item_title">Шифрование данных майнера</h3>
                            <p class="security-view_item_text">Шифрование данных, передаваемых между пользователями и
                                сервером
                                пула, помогает предотвратить подслушивание или перехват злоумышленниками. Используя
                                безопасные каналы, такие как
                                SSL/TLS, Allbtc Pool гарантирует,
                                что данные остаются конфиденциальными и безопасными во время передачи и защищенными от
                                несанкционированного доступа.</p>
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
                            <p class="security-view_item_text">Когда майнинг-пул подвержен DDoS-атакам, это может
                                привести
                                к перебоям в майнинг операциях, что приводит к снижению выплат клиентам пула. Защита от
                                DDoS-атак
                                гарантирует, что Allbtc Pool всегда будет работоспособным и обеспечит непрерывное
                                надежное обслуживание своих пользователей.</p>
                        </div>
                    </div>
                </div>
                <div class="security-view_right">
                    <div class="security-view_right_item"></div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import {gsap} from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";


export default {

    name: "SecurityView",
    components: {HeadLine},
    mounted() {
        gsap.registerPlugin(ScrollTrigger)

        ScrollTrigger.create({
            trigger:".security-view__wrapper",
            start:"top top",
            end:"bottom bottom",
            pin:".security-view_right",
            pinSpacing: false
        })
    }

}
</script>


<style scoped lang="scss">
.security-view {
    width: 100vw;
    padding: 100px 0;

    &__container {
        margin: 0 auto;
    }

    &__wrapper {
        display: flex;
        position: relative;
    }

    &__left {
        position: relative;
        left: 20%;
        z-index: 99999;

        &__item__wrapper {
            width: 100%;
        }
    }

    &_item {
        height: 100vh;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: center;
        gap: 30px;


        &_title {
            color: #F5FAFF;
            font-family: Unbounded, serif;
            font-size: clamp(14px, 5vw, 65px);
            font-style: normal;
            font-weight: 400;
            line-height: 120%;
            text-transform: uppercase;
        }

        &_text {
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-family: NunitoSans, serif;
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
        }
    }

    &_right {
        width:50%;
        height:100vh;
        display:flex;
        flex-direction:column;
        justify-content:center;
        position: absolute;
        right: 0;
        top: 0;

        &_item {
            width: 100%;
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
        }

    }


}
</style>
