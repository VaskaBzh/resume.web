<template>
<div class="header-land">
    <h1 class="header-land_title">
        <span>Экспертный</span>
        <span class="header-land_title_one">подход</span>
        <span>к майнинг</span>
        <span class="header-land_title_text">Bitcoin <span class="header-land_title_span">Используем передовые технологии
                            для эффективного майнинга биткоина. Максимальная
                            прозрачность майнинга в пару кликов.
                      </span>
        </span>
    </h1>
    <button-blue class="header-land_btn">попробовать демо кабинет</button-blue>
</div>
</template>

<script>
import ButtonBlue from "./ButtonBlue.vue";

export default {
    name: "LandingTitle",
    components: {ButtonBlue}
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

        &_one {
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
}
</style>
