<template>
    <keep-alive>
        <component :is="route.meta.layoutComponent">
            <router-view />
        </component>
    </keep-alive>
</template>

<script>
import { useRoute } from "vue-router";

export default {
    name: "app-layout-view",
    computed: {
        route() {
            return useRoute();
        },
    },
    created() {
        this.$store.dispatch("setUser");
        this.$store.dispatch("setToken");
    },
};
</script>

<style scoped lang="scss"></style>
