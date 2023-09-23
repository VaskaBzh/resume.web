<template>
    <keep-alive>
        <component :is="route.meta.layoutComponent">
            <router-view />
        </component>
    </keep-alive>
</template>

<script>
import { useRoute } from "vue-router";
import ThemeService from "@/modules/interface/Services/ThemeService";
import { mapGetters } from "vuex";
import api from "@/api/api";
export default {
    name: "app-layout-view",
    computed: {
        ...mapGetters(["isDark"]),
        route() {
            return useRoute();
        },
    },
    data() {
        return {
            themeService: new ThemeService(),
        };
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
    mounted() {
        this.themeService.toggleTheme("light");
    },
    async unmounted() {
        await api.put("/decrease/token");
    },
};
</script>

<style scoped lang="scss"></style>
