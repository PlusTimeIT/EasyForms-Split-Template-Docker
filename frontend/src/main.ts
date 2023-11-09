import { createApp } from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import axios from "./plugins/axios";
import router from "./plugins/router";
import FormLoaderPlugin from "laravel-vue-easyforms";

createApp(App)
  .use(FormLoaderPlugin, {
    backend_domain: import.meta.env.VITE_BACKEND_URL,
    axios_prefix: "/axios",
    csrf_endpoint: "/csrf-cookie",
    uses_vue_router: false,
    required_tags_only: false,
    tags_on_placeholder: true,
    tags_on_labels: false,
    axios: axios
  })
  .use(vuetify)
  .use(router)
  .mount("#app");
