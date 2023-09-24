<template>
    <keep-alive>
        <component :is="$route.meta.layoutComponent">
            <router-view />
        </component>
    </keep-alive>
</template>

<script>
import ThemeService from "@/modules/interface/Services/ThemeService";
import { mapGetters } from "vuex";
import api from "@/api/api";

export default {
    name: "app-layout-view",
    computed: {
        ...mapGetters(["isDark", "token"]),
    },
    data() {
        return {
            themeService: new ThemeService(),
            isPageHidden: false,
        };
    },
    methods: {
        handleResize() {
            this.$store.dispatch("getViewportWidth", window.innerWidth);
        },
        async onClose() {
            try {
                if (this.token && !this.$route?.query?.access_key)
                    await api.put(
                        "/decrease/token",
                        {},
                        {
                            headers: {
                                Authorization: `Bearer ${this.token}`,
                            },
                        }
                    );
            } catch (error) {
                console.error("Error decreasing token:", error);
            }
        },
        handleVisibilityChange() {
            this.isPageHidden = document.hidden;
        },
    },
    created() {
        this.$store.dispatch("setUser");
        this.$store.dispatch("setToken");

        window.addEventListener("resize", this.handleResize);
        window.addEventListener("beforeunload", this.onClose);
        document.addEventListener(
            "visibilitychange",
            this.handleVisibilityChange
        );
        this.handleResize();
    },
    async mounted() {
        this.themeService.toggleTheme("light");
    },
    async unmounted() {
        window.removeEventListener("beforeunload", this.onClose);
        document.removeEventListener(
            "visibilitychange",
            this.handleVisibilityChange
        );
    },
};
</script>

<style scoped lang="scss"></style>
