import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import { i18n } from "./lang/vue-translate.js";

import Layout from "./Shared/LayoutView.vue";
import store from "./store/index.js";
import scrollAnimation from "@/Components/directives/animations/scrollAnimation.vue";
import scrollValueAnimation from "@/Components/directives/animations/scrollValueAnimation.vue";
import tippyAnimation from "@/Components/directives/tippyAnimation.vue";
import hideAnimation from "@/Components/directives/hideAnimation.vue";
import hashRender from "@/Components/directives/hashRender.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        const page = pages[`./Pages/${name}.vue`].default;
        page.layout = page.layout || Layout;

        return page;
    },
    title: (title) => `${title}`,
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin)
            .use(store)
            .use(i18n)
            .mixin({ methods: { route: window.route } })
            .directive("scroll", scrollAnimation)
            .directive("value-scroll", scrollValueAnimation)
            .directive("tooltip", tippyAnimation)
            .directive("hide", hideAnimation)
            .directive("hash", hashRender)
            .mount(el);
    },
    progress: {
        // The delay after which the progress bar will appear
        // during navigation, in milliseconds.
        delay: 250,

        // The color of the progress bar.
        color: "#29d",

        // Whether to include the default NProgress styles.
        includeCSS: true,

        // Whether the NProgress spinner will be shown.
        showSpinner: true,
    },
});
