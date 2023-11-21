<template>
    <login-form :errors="errors" />
</template>

<script>
import LoginForm from "@/modules/auth/Components/blocks/LoginForm.vue";

export default {
    name: "LoginPage",
    components: {
        LoginForm,
    },
    props: { errors: Object },
    mounted() {
        document.title = this.$t("auth.login.head");
    },
};
</script>

<style scoped lang="scss"></style>
