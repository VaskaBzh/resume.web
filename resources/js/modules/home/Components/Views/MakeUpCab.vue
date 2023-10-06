<template>
<div class="make-up-cab scroll-section">
    <div class="make-up-cab__container">
        <head-line class="make-up-cab_title">{{ $t("personal_account.button[0]") }}</head-line>
        <h3 class="make-up-cab_subtitle">
            <span class="make-up-cab_subtitle_one">{{ $t("personal_account.title[0]") }}</span>
            <span  class="make-up-cab_subtitle_two">{{ $t("personal_account.title[1]") }}</span>
            <span>{{ $t("personal_account.title[2]") }}</span>
        </h3>
        <p class="make-up-cab_description">{{ $t("personal_account.text") }}
        </p>
        <div class="make-up-cab_picture">
            <img src="../../../../../assets/img/land-makeup.png" alt="all-btc" >
        </div>
        <button-blue class="make-up-cab_link">{{ $t("personal_account.button[1]") }}</button-blue>
    </div>
</div>
</template>



<script>
import HeadLine from "../../../common/Components/UI/HeadLine.vue";
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import { HomeMessage } from "@/modules/home/lang/HomeMessage";


export default {
    name: "MakeUpCab",
    components: {ButtonBlue, HeadLine},
    i18n: {
            sharedMessages: HomeMessage,
    },
}
</script>

<style scoped lang="scss">
.make-up-cab {
    width: 100vw;
    display: flex;
    padding-top: 100px;
    padding-bottom: 100px;
    justify-content: center;
    flex-flow: column nowrap;
    border-radius: 70px;
    border-top: 1px solid #585757;
    border-bottom: 1px solid #585757;
    background: #0D0D0D;
    box-shadow: 0px -4px 4px 0px rgba(18, 31, 78, 0.25), 0px 4px 4px 0px rgba(0, 0, 0, 0.25);

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
