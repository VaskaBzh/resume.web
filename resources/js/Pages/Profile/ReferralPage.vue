<template></template>

<script>
import ProfileLayoutView from "@/Shared/ProfileLayoutView.vue";

export default {
    name: "referral-page",
    layout: ProfileLayoutView,
    mounted() {
        document.title = this.$t("header.links.ref");
    },
};
</script>

<style scoped lang="scss"></style>
