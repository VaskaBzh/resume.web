import {defineConfig, loadEnv} from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig(({ command , mode}) => {
    const env = loadEnv(mode, process.cwd(), '');

    let serverConf = {
        cors: {
            origin: "*",
        },
    }

    if (loadEnv(mode, process.cwd(), '').APP_ENV === 'local') {
        serverConf = { ...serverConf,
            host: '0.0.0.0',
            port: 5173,
            hmr: {
                host: '127.0.0.1',
                port: 5173,
            },
        }
    }
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

        resolve: {
            alias: {
                "@": path.resolve(__dirname, "./resources/js"),
            },
        },
        css: {
            preprocessorOptions: {
                scss: {
                    additionalData:
                        '@import "resources/scss/mixins.scss"; @import "resources/scss/consts.scss";',
                },
            },
        },
        server: serverConf,
        build: {
            base: command === "build" ? "/" : "/",
            publicDir: "public",
        },
    };
});
