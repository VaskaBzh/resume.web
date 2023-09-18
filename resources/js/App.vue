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
    methods: {
        handleResize() {
            this.$store.dispatch("getViewportWidth", window.innerWidth);
        },
    },
    created() {
        this.$store.dispatch("setUser");
        this.$store.dispatch("setToken");

        window.addEventListener("resize", this.handleResize);
        this.handleResize();
    },
};
</script>

<style scoped lang="scss"></style>
