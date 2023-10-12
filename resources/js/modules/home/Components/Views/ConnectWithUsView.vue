<template>
    <div class="connect-withus">
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
        <div class="connect-withus__run">
            <p class="connect-withus_text">{{ $t("connect_with_us") }}</p>
            <button-blue class="connect-withus_btn"/>
        </div>
    </div>
</template>

<script>
import ButtonBlue from "../../../common/Components/UI/ButtonBlue.vue";
import {HomeMessage} from "@/modules/home/lang/HomeMessage";

export default {
    name: "ConnectWithUsView",
    components: {ButtonBlue},
    i18n: {
        sharedMessages: HomeMessage,
    },
};
</script>

<style scoped lang="scss">
.connect-withus {
    height: 20vh;
    display: flex;
    align-items: center;
    font-size: 0;
    justify-content: center;
    animation: scroll 7s linear 1s infinite;

    @keyframes scroll {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(35%);
        }
    }

    &_text {
        color: #f5faff;
        font-family: Unbounded, serif;
        font-size: 55px;
        font-style: normal;
        font-weight: 600;
        line-height: 120%;
        text-transform: uppercase;
        white-space: nowrap;
    }
}

.connect-withus__run {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-left: 70px;
}
</style>
