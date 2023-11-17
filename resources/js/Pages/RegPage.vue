<template>
    <registration-form :errors="errors" />
</template>

<script>
import RegistrationForm from "@/modules/auth/Components/blocks/RegistrationForm.vue";

export default {
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
