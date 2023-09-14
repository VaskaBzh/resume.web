<template>
    <div class="__container">
        <h2>Настройка двухфакторной аутентификации</h2>
        <p>
            Отсканируйте следующий QR-код с помощью вашего приложения для
            аутентификации:
        </p>
        <div v-html="qrCode"></div>

        <p>Или введите этот секретный ключ вручную:</p>
        <code>{{ secret }}</code>

        <form @submit.prevent="submit">
            <label for="verification_code">Введите код подтверждения:</label>
            <input
                type="text"
                id="verification_code"
                v-model="secretKey"
                required
            />
            <button type="submit">Подтвердить</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "TwoFactorVerify",
    props: ["qrCode", "secret"],
    data() {
        return {
            secretKey: "",
        };
    },
    methods: {
        submit() {
            axios
                .post("/2fac/verify", {
                    twoFactorSecret: this.secretKey,
                })
                .then((response) => {
                    console.log(response.data);
                })
                .then((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped lang="scss"></style>
