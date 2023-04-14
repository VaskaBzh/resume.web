import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import Layout from "./Shared/LayoutView.vue";
import store from "./store/index.js";
import scrollAnimation from "@/Components/animations/scrollAnimation.vue";
import scrollValueAnimation from "@/Components/animations/scrollValueAnimation.vue";
import tippyAnimation from "@/Components/animations/tippyAnimation.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        const page = pages[`./Pages/${name}.vue`].default;
        page.layout = page.layout || Layout;

        return page;
    },
    title: (title) => `${title}`,
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)
            .mixin({ methods: { route: window.route } })
            .directive("scroll", scrollAnimation)
            .directive("value-scroll", scrollValueAnimation)
            .directive("tooltip", tippyAnimation)
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
