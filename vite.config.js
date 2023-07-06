import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig(({ command }) => {
    return {
        plugins: [
            laravel({
                input: ["resources/scss/app.scss", "resources/js/app.js"],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        css: {
            preprocessorOptions: {
                scss: {
                    additionalData: `@import "resources/scss/mixins.scss"; @import "resources/scss/consts.scss";`,
                },
            },
        },
        server: {
            cors: {
                origin: "*",
            },
        },
        build: {
            base: command === "build" ? "/" : "/",
            publicDir: "public",
        },
    };
});
