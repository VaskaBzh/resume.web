<template>
    <main-popup id="2fac" :wait="wait" :closed="closed">
        <div class="fac__head">
            <main-title tag="h3">Подключение 2FA</main-title>
            <main-description
                >Привяжите аккаунт к Google Authenticator с помощью QR-кода или
                ключа настройки</main-description
            >
        </div>
        <div class="fac_qrcode" v-html="qrcode"></div>
        <main-copy
            class="fac_code"
            :cutValue="-1"
            :code="code"
            label="Ключ настройки"
        />
        <main-button class="button-blue fac_button">Продолжить</main-button>
    </main-popup>
</template>

<script>
import MainPopup from "@/Components/technical/MainPopup.vue";
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";
import MainCopy from "@/modules/common/Components/UI/MainCopy.vue";
import MainButton from "@/modules/common/Components/UI/MainButton.vue";

export default {
    name: "fac-popup",
    props: {
        closed: Boolean,
        wait: Boolean,
        qrcode: String,
        code: String,
    },
    components: {
        MainDescription,
        MainPopup,
        MainTitle,
        MainCopy,
        MainButton,
    },
};
</script>

<style scoped>
.fac__head {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 40px;
}
.fac_qrcode {
    width: 200px;
    height: 160px;
    margin: 0 auto 40px;
}
.fac_code {
    margin-bottom: 80px;
}
</style>
