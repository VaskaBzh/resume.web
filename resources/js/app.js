import { router } from "@/router";

import { createApp } from "vue";

import App from "@/App.vue";

import i18n from "@/lang/vue-translate.js";

import "virtual:svg-icons-register";

import store from "@/store/index.js";

import TranslateTabulation from "@/directives/TranslateTabulation.vue";

import tooltipDirective from "@/directives/TooltipDirective.vue";

const app = createApp(App);

app.use(store)
    .use(router)
    .use(i18n)
    .mixin({ methods: { route: window.route } })
    .directive("i18n", TranslateTabulation)
    .directive("tooltip", tooltipDirective)
    .mount("#app");
