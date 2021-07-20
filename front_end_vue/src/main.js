import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
// import vuebraintree from "./vue-braintree";

createApp(App)
  .use(store)
  .use(router)
  // .use(vuebraintree)

  .mount("#app", "#v-model-multiple-checkboxes");
