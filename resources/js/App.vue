<template>
    <keep-alive>
        <component :is="$route.meta.layoutComponent">
            <router-view />
        </component>
    </keep-alive>
</template>

<script>
import { mapGetters } from "vuex";
import api from "@/api/api";

export default {
    name: "app-layout-view",
    computed: {
        ...mapGetters(["isDark", "token"]),
    },
    data() {
        return {
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
    async created() {
        this.$store.dispatch("setUser");
        this.$store.dispatch("setToken");

        await this.$store.dispatch("setCurrency");

        window.addEventListener("resize", this.handleResize);
        document.addEventListener(
            "visibilitychange",
            this.handleVisibilityChange
        );
        window.addEventListener("beforeunload", this.onClose);
        this.handleResize();
    },
    async unmounted() {
        document.removeEventListener(
            "visibilitychange",
            this.handleVisibilityChange
        );
        window.removeEventListener("beforeunload", this.onClose);
    },
};
</script>

<style scoped lang="scss"></style>
