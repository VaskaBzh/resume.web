import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import Layout from "./Shared/LayoutView.vue";
import scrollAnimation from "@/Components/animations/scrollAnimation.vue";
import scrollValueAnimation from "@/Components/animations/scrollValueAnimation.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        const page = pages[`./Pages/${name}.vue`].default;
        page.layout = Layout;

        return page;
    },
    title: (title) => `${title}`,
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route: window.route } })
            .directive("scroll", scrollAnimation)
            .directive("value-scroll", scrollValueAnimation)
            .mount(el);
    },
});
