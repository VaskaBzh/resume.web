<template>
    <login-form :errors="errors" />
</template>

<script>
import authLayoutView from "@/Shared/AuthLayoutView.vue";
import LoginForm from "@/modules/auth/Components/blocks/LoginForm.vue";

export default {
    layout: authLayoutView,
    name: "login-page",
    props: { errors: Object },
    components: {
        LoginForm,
    },
    mounted() {
        document.title = this.$t("auth.login.head");
    },
};
</script>

<style scoped lang="scss"></style>
