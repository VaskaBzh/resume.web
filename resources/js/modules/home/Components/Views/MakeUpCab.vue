<template>
<div class="make-up-cab">
    <div class="make-up-cab__container">
        <head-line class="make-up-cab_title">личный кабинет</head-line>
        <h3 class="make-up-cab_subtitle">
            <span class="make-up-cab_subtitle_one">удобный</span>
            <span  class="make-up-cab_subtitle_two">личный</span>
            <span>кабинет</span>
        </h3>
        <p class="make-up-cab_description">Удобный личный кабинет со всей
            необходимой статистикой и интуитивно понятной
            навигацией. Только нужные функции для конечного пользователя.
        </p>
        <div class="make-up-cab_picture">
            <img src="../../../../../assets/img/land-makeup.png" alt="all-btc" >
        </div>
        <button-blue class="make-up-cab_link">посмотреть личный кабинет</button-blue>
    </div>
</div>
</template>



<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";

export default {
    name: "MakeUpCab",
    components: {ButtonBlue, HeadLine}
}
</script>

<style scoped lang="scss">
.make-up-cab {
    width: 100vw;
    display: flex;
    padding-top: 100px;
    justify-content: center;
    flex-flow: column nowrap;

    &__container {
        margin: 0 auto;
    }

    &_subtitle {
        width: fit-content;
        color: #F5FAFF;
        display: flex;
        flex-flow: column nowrap;
        margin: 0 auto 40px;
        justify-content: center;
        text-shadow: 0px 4.897561073303223px 8.570732116699219px rgba(14, 14, 14, 0.05);
        font-family: Unbounded, serif;
        font-size: 46px;
        font-style: normal;
        font-weight: 600;
        line-height: 100%;
        text-transform: uppercase;

        &_one {
            position: relative;
            left: 50px;
        }

        &_two {
            position: relative;
            left: -50px;
        }
    }

    &_description {
        width: 440px;
        margin: 0 auto 70px;
        color: rgba(245, 250, 255, 0.70);
        text-shadow: 0px 4px 7px rgba(14, 14, 14, 0.05);
        font-family: NunitoSans, serif;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: 110%;
    }

    &_picture {
        width: 100%;
        margin: 0 auto 50px;
        display: flex;
        align-items: center;
        justify-content: center;

        img {
            max-width: 100%;
            height: 100%;
            object-fit: cover;
        }

    }

}
</style>
