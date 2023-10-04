<template>
    <div class="header-land">
        <div class="header-land_title">
            <div class="header-land__block">
                <span class="header-land_title_expert-one">Экспер</span>
                <span class="header-land_title_expert-two">тный</span>
            </div>
            <div class="header-land__block-two">
                <span class="header-land_title_approach">подход</span>
            </div>
            <div class="header-land__block-three">
                <span class="header-land_title_mining-one">к майн<span class="header-land_title_mining-two">инг</span></span>
            </div>
            <div class="header-land__block-four">
            <span class="header-land_title_text">
                Bitcoin
                <span class="header-land_title_span">
                    Используем передовые технологии
                    для эффективного майнинга биткоина. Максимальная
                    прозрачность майнинга в пару кликов.
                </span>
            </span>
            </div>
        </div>
        <button-blue class="header-land_btn">попробовать демо кабинет</button-blue>
    </div>
</template>

<script>
import ButtonBlue from "./ButtonBlue.vue";


export default {
    name: "LandingTitle",
    components: {ButtonBlue},
    setup() {

    }
}
</script>


<style scoped lang="scss">
.header-land {
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;


    &_title {
        color: #F5FAFF;
        display: flex;
        flex-flow: column nowrap;
        position: absolute;
        text-shadow: 0px 4.897561073303223px 8.570732116699219px rgba(14, 14, 14, 0.05);
        font-family: Unbounded, serif;
        font-size: 110px;
        font-style: normal;
        font-weight: 600;
        line-height: 100%;
        text-transform: uppercase;



        &_expert-one,
        &_expert-two,
        &_approach,
        &_mining-one,
        &_mining-two,
        &_text,
        &_span {
            display: flex;
            opacity: 1;
        }

        &_approach {
            position: relative;
            left: -100px;
            top: 0;
        }

        &_text {
            display: block;
            position: relative;
        }

        &_span {
            position: absolute;
            top: 0;
            font-family: NunitoSans, serif;
            color: rgba(245, 250, 255, 0.70);
            text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 110%;
            padding-left: 10px;
        }
    }

    &__block,
    &__block-two,
    &__block-three,
    &__block-four {
        display: flex;
        flex-flow: row nowrap;
        overflow: hidden;
    }
}
</style>
