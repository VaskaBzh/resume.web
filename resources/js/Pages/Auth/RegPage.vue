<template>
    <registration-form :errors="errors" />
</template>

<script>
import authLayoutView from "@/Shared/AuthLayoutView.vue";
import RegistrationForm from "@/modules/auth/Components/blocks/RegistrationForm.vue";

export default {
    layout: authLayoutView,
    name: "reg-page",
    props: ["errors"],
    components: {
        RegistrationForm,
    },
    mounted() {
        document.title = this.$t("auth.reg.head");
    },
};
</script>

<style lang="scss"></style>
