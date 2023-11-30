<template>
    <component :is="$route.meta.layoutComponent">
        <router-view />
    </component>
</template>

<script>
import { mapGetters } from "vuex";
import { ProfileApi } from "@/api/api";

export default {
    name: "AppLayoutView",
    computed: {
        ...mapGetters(["isDark", "token", "user"]),
    },
    data() {
        return {
            isPageHidden: false,
        };
    },

    async mounted() {
        this.$store.dispatch("setToken");
        await this.$store.dispatch("setCurrency");

        window.addEventListener("resize", this.handleResize);
        // window.addEventListener(
        //     "visibilitychange",
        //     this.handleVisibilityChange
        // );
        // window.addEventListener("beforeunload", this.onClose);
        this.handleResize();

        document.addEventListener("validationError", (event) =>
            this.$store.dispatch("setFullErrors", event.detail)
        );
    },
    async unmounted() {
        window.removeEventListener("resize", this.handleResize);
        // window.removeEventListener(
        //     "visibilitychange",
        //     this.handleVisibilityChange
        // );
        // window.removeEventListener("beforeunload", this.onClose);

        document.removeEventListener("validationError", (event) =>
            this.$store.dispatch("setFullErrors", event.detail)
        );
    },
    methods: {
        handleResize() {
            this.$store.dispatch("getViewportWidth", window.innerWidth);
        },
        async onClose() {
            try {
                if (this.token && !this.$route?.query?.access_key)
                    await ProfileApi.put("/decrease/token");
            } catch (error) {
                console.error("Error decreasing token:", error);
            }
        },
        handleVisibilityChange() {
            this.isPageHidden = document.hidden;
        },
    },
};
</script>

<style scoped lang="scss">
</style>
