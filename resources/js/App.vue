<template>
    <app-layout-view>
        <router-view />
    </app-layout-view>
</template>

<script>
import AppLayoutView from "@/layouts/AppLayoutView.vue";

export default {
    name: "app",
    components: {
        AppLayoutView,
    },
    created() {
        this.$store.dispatch("setUser");
        this.$store.dispatch("setToken");
    },
};
</script>

<style scoped lang="scss"></style>
