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
import store from "@/store";
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
        async onClose() {
            try {
                await api.put("/decrease/token", {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                });
            } catch (error) {
                console.error("Error decreasing token:", error);
            }
        },
    },
    created() {
        this.$store.dispatch("setUser");
        this.$store.dispatch("setToken");

        window.addEventListener("resize", this.handleResize);
        // window.addEventListener("beforeunload", this.onClose);
        this.handleResize();
    },
    async mounted() {
        this.themeService.toggleTheme("light");
    },
    // async unmounted() {
    //     window.removeEventListener("beforeunload", this.onClose);
    // },
};
</script>

<style scoped lang="scss"></style>
