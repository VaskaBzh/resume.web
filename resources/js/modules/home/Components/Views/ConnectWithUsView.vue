<template>
    <div class="connect-withus connect-withus__section" ref="view">
        <a
            href="https://t.me/allbtc_support"
            class="connect-withus__content"
            target="_blank"
        >
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
        </a>
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
    min-height: 300px;
    justify-content: flex-end;

    &__content {
        display: flex;
        align-items: center;
        font-size: 0;
        justify-content: center;
        flex-direction: row;
        animation: scroll 4s linear 0s infinite;
        outline: none;
        border: none;
    }

    @keyframes scroll {
        0% {
            transform: translateX(0%);
        }
        100% {
            transform: translateX(12.5%);
        }
    }

    &_text {
        color: #f5faff;
        font-family: Unbounded, serif;
        font-size: clamp(30px, 2.8vw, 55px);
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

@media (max-width: 445px) {
    .connect-withus_btn{
        width: 40px;
        height: 40px;
    }
}
</style>
