import { router } from "@/router";

import { createApp } from "vue";

import App from "@/App.vue";

import { i18n } from "@/lang/vue-translate.js";

import store from "./store/index.js";
import scrollAnimation from "@/Components/directives/animations/scrollAnimation.vue";
import scrollValueAnimation from "@/Components/directives/animations/scrollValueAnimation.vue";
import tippyAnimation from "@/Components/directives/tippyAnimation.vue";
import hideAnimation from "@/Components/directives/hideAnimation.vue";
import hashRender from "@/Components/directives/HashRender.vue";

const app = createApp(App);

app.use(router)
    .use(store)
    .use(i18n)
    .mixin({ methods: { route: window.route } })
    .directive("scroll", scrollAnimation)
    .directive("value-scroll", scrollValueAnimation)
    .directive("tooltip", tippyAnimation)
    .directive("hide", hideAnimation)
    .directive("hash", hashRender)
    .mount('#app');
