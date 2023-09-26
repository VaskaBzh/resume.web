<template>
    <div class="confirm">
        <main-title tag="h3" class="title-base">
            Подтверждение регистрации
        </main-title>
        <main-description class="description-base">
            На почту {{ this.$route.query?.email }} было отправлено письмо со ссылкой для подтверждения регистрации. Проверьте папку “Спам“, если не обнаружили письмо в списке входящих.
        </main-description>
    </div>
</template>

<script>
import MainTitle from "@/modules/common/Components/UI/MainTitle.vue";
import MainDescription from "@/modules/common/Components/UI/MainDescription.vue";

export default {
    name: "confirm-block",
    components: {
        MainTitle,
        MainDescription,
    },
    mounted() {
        if (!this.$route.query?.email) {
            this.$router.push({
                name: "home",
            })
        }
    }
}
</script>

<style scoped lang="scss">
.confirm {
    display: flex;
    flex-direction: column;
    gap: 32px;
    @media (max-width: $pc) {
        gap: 24px;
    }
    @media (max-width: $mobile) {
        gap: 16px;
    }
}
</style>
