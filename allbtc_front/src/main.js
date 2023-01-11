// styles
import "./styles/main.scss";
//========================================================================================================================================================
import { createApp } from "vue";
import App from "./App.vue";
import components from "@/components/UI";
import scrollAnimation from "@/components/directives/scrollAnimation";
import scrollValueAnimation from "@/components/directives/scrollvalueAnimation";
import router from "./router";
import store from "./store";

const app = createApp(App);
components.forEach((component) => {
  app.component(component.name, component);
});
app
  .directive("scroll", scrollAnimation)
  .directive("value-scroll", scrollValueAnimation)
  .use(store)
  .use(router)
  .mount("#app");
